<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Authen {
    
    var $CI;
    
    public function __construct(){
        $this->CI =& get_instance();
    }
    
    /**
     * Checking login status & compare curent login session
     **/
    public function check_login(){
        if($userdata = $this->CI->session->userdata('session_login')){
            
            if($ServerUserData = $this->CI->db->where('id', $userdata['id'])->get('username')->row_array()){
                if($ServerUserData != $userdata){
                    $this->logout();
                    redirect(CMS_LOGIN_BACKEND_URL.'?redir='.base64_encode(current_url()));
                }
            }
            else
            {
                $this->logout();
                redirect(CMS_LOGIN_BACKEND_URL.'?redir='.base64_encode(current_url()));
            }
        }
        else{
            redirect(CMS_LOGIN_BACKEND_URL.'?redir='.base64_encode(current_url()));
        }
    }
    
    /**
     * Tao ra chuoi mat khau da duoc ma hoa
     * @param string
     * @param string
     * @return string
     **/
    public function password_algorithm($password = '', $salt){
        return sha1($password.md5($salt));
    }
    
    /**
     * Login function
     * Su dung de login va tao session.
     * @param string
     * @param string
     * @return void
     * @author Ta Minh Duc
     * @access Global
     **/
    public function login($username = '', $password = ''){
        if($userdata = $this->CI->db->where('username', $username)->where('active', 1)->get('username')->row_array()){
            
            if($userdata['password'] == $this->password_algorithm($password, $userdata['salt'])) {
                //Generate a random token string. 
                $rand_str = random_string('alpha', 20);
                
                //Update to MySQL
                $this->CI->db->update('username', array('token' => $rand_str), array('id' => $userdata['id']));
                
                //Inserting to Session
                $userdata['token'] = $rand_str;
                $this->CI->session->set_userdata(array('session_login' => $userdata));
                return true;
            }else {
                return false;
            }
        }else {
            return false;
        }
    }
    
    /**
     * Kiem tra quyen truy cap
     * @param string
     * @return bool
     **/
    public function check_permission($key = ''){
        $userdata = $this->CI->session->userdata('session_login');
        
        if(preg_match('/(\d+)$/', $key)){
            for($i = strlen($key)-1; $i >= 0; $i--){
                if($key[$i] === '/'){
                    $key = substr($key, 0, $i);
                    break;
                }
            }
        }
        
        if(CMS_SUPER_ADMIN_ID == $userdata['id']){
            return true;
        }
        else{
            if($usergroup = $this->CI->db->where('id', $userdata['usergroupid'])->where('status', 1)->get('usergroup')->row_array()){
                if($group_perm = (array)json_decode($usergroup['permission_key'])){
                    if(in_array($key, $group_perm)){
                        return true;
                    }else{
                        $this->CI->mycommonlib->redir_alert('Bạn không có đủ quyền truy cập vào khu vực này!', CMS_DEFAULT_BACKEND_URL);
                        die();
                    }
                }
                else{
                    //Mac dinh Perm trong la full quyen
                    return true;
                }
            }
            else{
                $this->CI->mycommonlib->redir_alert('Bạn không có đủ quyền truy cập vào khu vực này!', CMS_DEFAULT_BACKEND_URL);
                die();
                return false;
            }
        }
        die();
        return false;
        /** Tested OK **/
    }
    
    /**
     * Function Request Mail for Reset password
     **/
     public function forgot($email = ''){
        if($userdata = $this->CI->db->where('email', $email)->get('username')->row_array()){
            $this->CI->load->library('Mymail');
            
            $reset_code = random_string('alpha', 20);
            
            $content = '<strong>Hi '.$userdata['username'].'</strong><br />Here your reset code : '.$reset_code.'<br /> or <a href="'.base_url(CMS_DEFAULT_BACKEND_URL.'/auth/reset/?username='.$userdata['username'].'&code='.$reset_code).'">click here</a><br />Thank You.';
            
            $this->CI->db->update('username', array('resetcode' => $reset_code), array('email' => $email));
            
            $this->CI->mymail->send_mail(CMS_ADMINISTRATOR_EMAIL, $email, 'Reset password of user '.$userdata['username'].'', $content);
            
            redirect(base_url(CMS_DEFAULT_BACKEND_URL.'/auth/reset/'));
            return true;
        }
        else{
            return false;
        }
     }
    
    /**
     * Function Reset Password
     * @param String
     * @param String
     * @param String
     * 
     * False - User not found or Wrong code
     * True - Success
     **/
    public function reset_password($username, $resetcode, $new_password){
        if($userdata = $this->CI->db->where('username', $username)->where('resetcode', $resetcode)->get('username')->row_array()){
            $this->CI->db->update('username', array('password' => $this->password_algorithm($new_password, $userdata['salt']), 'resetcode' => random_string('unique', 20)), array('username' => $username));
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * Create a new username
     * @param string
     * @param string
     * @param string
     * @param int
     * @param int
     * @return Row Affected
     **/
    
    public function register($username, $password, $email, $usercreatedid, $usergroupid = CMS_DEFAULT_USERGROUP_ID){
        $userdata = array();
        
        $salt = random_string('alpha', 20);
        
        $userdata['username']       = $username;
        $userdata['password']       = $this->password_algorithm($password, $salt);
        $userdata['salt']           = $salt;
        $userdata['email']          = $email;
        $userdata['created_date']   = gmdate('Y-m-d H:i:s');
        $userdata['usergroupid']    = $usergroupid;
        $userdata['usercreatedid']  = $usercreatedid;
        
        $this->CI->db->insert('username', $userdata);
        
        return $this->CI->db->affected_rows();
    }
    
    public function logout(){
        $this->CI->session->unset_userdata('session_login');
    }
}