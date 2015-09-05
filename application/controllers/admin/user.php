<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
    
    var $auth;
    
    public function __construct(){
        parent::__construct();
        
        $this->authen->check_login();
        
        $this->auth = $this->session->userdata('session_login');
        
        if(!$this->authen->check_permission($this->router->fetch_class().'/'.$this->router->fetch_method()))
        	return false;
        
        $this->load->model('backend/model_user', 'Muser');
        $this->load->model('backend/model_usergroup', 'Musergroup');
    }
	
    public function info(){
        if($this->input->post('cmd')){
            
            $data['post_data'] = $this->input->post();
            
            $repass = $this->input->post('repassword');
            $this->form_validation->set_rules('oldpassword', 'Mật khẩu cũ', 'callback_check_valid_password');
            $this->form_validation->set_rules('password', 'Password', 'callback_compare_password['.$repass.']');
            $this->form_validation->set_rules('email', 'Email', 'required|callback_check_exist_email|valid_email');
            
            $this->form_validation->set_rules('valid_email', '%s của bạn không đúng định dạng.');
            
            if($this->form_validation->run() == TRUE){
                //Code sau khi valid input data
                $data_input = $this->input->post();
                
                $data_input = $this->mycommonlib->Filter_Field($data_input, array('password', 'email', 'fullname'));
                
                $data_input['updated_date'] = gmdate('Y-m-d H:i:s');
                $data_input['userupdatedid'] = $this->auth['id'];
                
                $flag = $this->Muser->ModifyRow($data_input, $this->auth['username']);
                
                
                //Tranh hien tuong doi xong bi kick ra ngoai
                $this->auth = (array)$this->Muser->SelectByID($this->auth['id']);
                $this->session->set_userdata('session_login', $this->auth);
                
                if($flag == 1)
                    $this->mycommonlib->redir_alert('Sửa thông tin thành công', uri_string());
            }
        }
        
        $data['auth'] = $this->auth;
        $data['tpl'] = 'backend/user/info';
		$this->load->view('backend/layout/home', $data);
    }
    
    //Phuc vu cho viec validation password neu xay ra truong hop doi pass
    public function check_valid_password($str_password = ''){
        if($str_password == '')
            return true;
        
        $encrypt_pass = $this->authen->password_algorithm($str_password, $this->auth['salt']);
        if($encrypt_pass == $this->auth['password']){
            return true;
        }
        
        $this->form_validation->set_message('check_valid_password', 'Bạn đã điền không đúng Pass hiện tại');
        return false;
    }
    
    //Kiem tra 2 gia tri password trung
    public function compare_password($str1, $str2){
        //Khong muon doi pass hoặc pass đúng
        if($str1 == $str2)
            return true;
        
        if($str1 != '' && !$this->input->post('oldpassword')){
            $this->form_validation->set_message('compare_password', 'Xin mời nhập pass hiện tại.');
            return false;
        }
        
        $this->form_validation->set_message('compare_password', 'Hai pass bạn nhập không trùng.');
        return false;
    }
    
    //Check exist email
    public function check_exist_email($email, $type = 0){
        if($email == $this->auth['email'] && $type == 0){
            return true;
        }
        
        $count = $this->db->where('email', $email)->get('username')->num_rows();
        if($count >= 1)
        {
            $this->form_validation->set_message('check_exist_email', 'Đã có người sử dụng Email này.');
            return false;
        }
        
        return true;
    }
    
    
    //User
    public function index($page = 0)
	{
		if($this->input->post('cmd') == 'search'){
    		$keyword = $this->input->post('keyword');
    		redirect(current_url().'/?keyword='.$keyword);
    	}
    	
    	//Define default value
    	$keyword = $this->input->get('keyword');
    	$redir   = $this->input->get('redir');
    	
    	//Process Delete a list
    	if($this->input->post('cmd') == 'delete'){
    		$id_arr = $this->input->post('id');
            
    		if($this->Muser->delete($id_arr)){
    			$this->mycommonlib->redir_alert('Xóa thành công!',CMS_DEFAULT_BACKEND_URL.'/user/');
    		}else{
    			$this->mycommonlib->redir_alert('Xóa thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/user/':base64_decode($redir));
    		}
    	}
    	
    	//Process to show a list
    	if($this->input->post('cmd') == 'show'){
    		$id_arr = $this->input->post('id');
    		
    		if($this->Muser->toggle_item('active', $id_arr)){
    			$this->mycommonlib->redir_alert('Thao tác thành công!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/user/':base64_decode($redir));
    		}else{
    			$this->mycommonlib->redir_alert('Thao tác thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/user/':base64_decode($redir));
    		}
    		
    	}
		
		
		//Pagination
		$config = $this->mypagination->get_config();
		$config['base_url'] = base_url(CMS_DEFAULT_BACKEND_URL.'/user/index/');
		$config['first_url'] = base_url(CMS_DEFAULT_BACKEND_URL.'/user/index/').'?'.$_SERVER['QUERY_STRING'];
		$config['total_rows'] = $this->Muser->CountRow($keyword);
		$config['cur_page'] = $page;
		$config['suffix'] = '?'.$_SERVER['QUERY_STRING'];
		$this->pagination->initialize($config);
		
        //Main Data
        $order_by = $this->input->get('field').' '.$this->input->get('direction');
        if($order_by == ' '){
            $order_by = 'id DESC';
        }
        
        $data['input_data'] = $this->Muser->SelectByX(null, $keyword, $order_by , $page);
		
		//Data to transport
		$data['pagination'] = $this->pagination->create_links();
		$data['keyword'] = $keyword;
        $data['auth'] = $this->auth;
        $data['tpl'] = 'backend/user/user';
		$this->load->view('backend/layout/home', $data);
	}
    
    public function user_toggle($field = 'active', $id = 1){
    	$allow_arr = array('active');
        $redir = $this->input->get('redir');
        
        if(!in_array($field, $allow_arr)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/products/':base64_decode($redir));
        }
        if(!$this->Muser->toggle_item($field, $id)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/user/usergroup':base64_decode($redir));
        }else{
            $this->mycommonlib->redir_alert('Thay đổi trạng thái thành công!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/user/usergroup':base64_decode($redir));
        }
    }
    
    
    public function del($id = 0){
        if($this->input->get('redir')){
            $redir = $this->input->get('redir');
        }
        
        if(is_numeric($id)){
            if($this->Muser->SelectByID($id)){
                $this->Muser->delete($id);
                $this->mycommonlib->redir_alert('Xóa người dùng thành công.', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/user/');
            }else{
                $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/user/');
            }
                
        }else{
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.', CMS_DEFAULT_BACKEND_URL.'/user/');
        }
    }
    
    public function user_not_exist($username = ''){
    	if($this->Muser->SelectByX(array('username' => $username)))
    	{
    		$this->form_validation->set_message('user_not_exist', 'User này đã có người sử dụng');
    		return false;
    	}
    	
    	return true;
    }
    
    public function compare_password_user($str1, $str2){
        //Khong muon doi pass hoặc pass đúng
        if($str1 == $str2)
            return true;
        
        $this->form_validation->set_message('compare_password_user', 'Hai pass bạn nhập không trùng.');
        return false;
    }
    
    public function add(){
    	
    	if($this->input->post()){
    		$data['post_data'] = $this->input->post();
    		
    		$this->form_validation->set_rules('username', 'Tài khoản', 'required|callback_user_not_exist');
    		$this->form_validation->set_rules('password', 'Password', 'required|callback_compare_password_user['.$data['post_data']['repassword'].']');
    		$this->form_validation->set_rules('email', 'Email', 'required|callback_check_exist_email[1]|valid_email');
    		$this->form_validation->set_message('required', '%s không được để trống.');
    		$this->form_validation->set_message('valid_email', 'Email bạn nhập không đúng định dạng.');
    		
    		if($this->form_validation->run() == TRUE){
                $data['post_data'] = $this->mycommonlib->Filter_Field($data['post_data'], array('username', 'password', 'email', 'usergroupid'));
    			$this->Muser->register($data['post_data']['username'], $data['post_data']['password'], $data['post_data']['email'], $this->auth['id'], $data['post_data']['usergroupid']);
    			$this->mycommonlib->redir_alert('Thêm thành công.',CMS_DEFAULT_BACKEND_URL.'/user');
    		}
    	}
    	
    	$data['usergroup_list'] = $this->Musergroup->SelectByX(array('status' => 1), '', 'title ASC');
    	$data['auth'] = $this->auth;
        $data['tpl'] = 'backend/user/add';
		$this->load->view('backend/layout/home', $data);
    }
    
    public function edit($id = 0){
    	if($this->input->get('redir')){
            $redir = $this->input->get('redir');
        }
        
        $raw_data = $this->Muser->SelectByID($id);
        
        if(!is_numeric($id) || !$raw_data || ($id == 1 && $this->auth['id'] != 1))
        {
        	$this->mycommonlib->redir_alert('Trang bạn vừa nhập không đúng hoặc tài khoản của bạn không đủ quyền truy cập vào đây.',isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/user/');
        }
        
        $raw_data = (array)$raw_data;
        
        if(!isset($data['post_data'])){
        	$data['post_data'] = $raw_data;
        }
        
        if($this->input->post()){
    		$data['post_data'] = $this->input->post();
    		
    		$this->form_validation->set_rules('password', 'Password', 'callback_compare_password_edit['.$data['post_data']['repassword'].']');
    		
    		if($raw_data['email'] != $data['post_data']['email']){
    			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_exist_email[1]|valid_email');
    		}
    		
    		$this->form_validation->set_message('required', '%s không được để trống.');
    		$this->form_validation->set_message('valid_email', 'Email bạn nhập không đúng định dạng.');
    		
    		$New_data = $this->mycommonlib->Filter_Field($data['post_data'], array('password', 'email', 'fullname'));
    		
    		if($this->form_validation->run() == TRUE){
    			$this->Muser->ModifyRow($New_data, $raw_data['username']);
    			$this->mycommonlib->redir_alert('Thay đổi thông tin người dùng thành công.',isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/user/');
    		}
    	}
    	
    	$data['usergroup_list'] = $this->Musergroup->SelectByX(array('status' => 1), '', 'title ASC');
    	$data['auth'] = $this->auth;
        $data['tpl'] = 'backend/user/edit';
		$this->load->view('backend/layout/home', $data);
    }
    
    public function compare_password_edit($str1, $str2){
    	if($str1 == '' || $str1 == null){
    		return true;
    	}else{
    		if($str1 != $str2){
    			
    			$this->form_validation->set_message('compare_password_edit', 'Hai password bạn nhập vào không khớp.');
    			return false;
    		}else{
    			return true;
    		}
    	}
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    /** For Usergroup Zone **/
    public function usergroup($page = 0){
    	if($this->input->post('cmd') == 'search'){
    		$keyword = $this->input->post('keyword');
    		redirect(current_url().'/?keyword='.$keyword);
    	}
    	
    	//Define default value
    	$keyword = $this->input->get('keyword');
    	$redir   = $this->input->get('redir');
    	
    	//Process Delete a list
    	if($this->input->post('cmd') == 'delete'){
    		$id_arr = $this->input->post('id');
            
            foreach($id_arr as $key => $val){
                if(count_user_in_group($val)){
                    $this->mycommonlib->redir_alert('Vẫn còn user trong nhóm!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/user/usergroup':base64_decode($redir));
                    return false;
                }
            }
            
    		if($this->Musergroup->delete($id_arr)){
    			$this->mycommonlib->redir_alert('Xóa thành công!',CMS_DEFAULT_BACKEND_URL.'/user/usergroup');
    		}else{
    			$this->mycommonlib->redir_alert('Xóa thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/user/usergroup':base64_decode($redir));
    		}
    	}
    	
    	//Process to show a list
    	if($this->input->post('cmd') == 'show'){
    		$id_arr = $this->input->post('id');
    		
    		if($this->Musergroup->toggle_item('status', $id_arr)){
    			$this->mycommonlib->redir_alert('Thao tác thành công!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/user/usergroup':base64_decode($redir));
    		}else{
    			$this->mycommonlib->redir_alert('Thao tác thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/user/usergroup':base64_decode($redir));
    		}
    		
    	}
    	
		//Pagination
		$config = $this->mypagination->get_config();
		$config['base_url'] = base_url(CMS_DEFAULT_BACKEND_URL.'/user/usergroup');
		$config['first_url'] = base_url(CMS_DEFAULT_BACKEND_URL.'/user/usergroup').'?'.$_SERVER['QUERY_STRING'];
		$config['total_rows'] = $this->Musergroup->CountRow($keyword);
		$config['cur_page'] = $page;
		$config['suffix'] = '?'.$_SERVER['QUERY_STRING'];
		$this->pagination->initialize($config);
		
        //Main Data
        $order_by = $this->input->get('field').' '.$this->input->get('direction');
        if($order_by == ' '){
            $order_by = 'id DESC';
        }
        
        $data['input_data'] = $this->Musergroup->SelectByX(null, $keyword, $order_by , $page);
		
		//Data to transport
		$data['pagination'] = $this->pagination->create_links();
    	$data['page'] = $page;
    	$data['keyword'] = $keyword;
    	$data['auth'] = $this->auth;
        $data['tpl'] = 'backend/user/usergroup';
		$this->load->view('backend/layout/home', $data);
    }
    
    /**
     * Function for toggle item
     * @param string field name
     * @param int id of item
     **/
    public function group_toggle($field = 'status', $id = 1){
        $allow_arr = array('publish');
        $redir = $this->input->get('redir');
        
        if(!in_array($field, $allow_arr)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/products/':base64_decode($redir));
        }
        if(!$this->Musergroup->toggle_item($field, $id)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/user/usergroup':base64_decode($redir));
        }else{
            $this->mycommonlib->redir_alert('Thay đổi trạng thái thành công!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/user/usergroup':base64_decode($redir));
        }
    }
    
    public function add_group(){
        //Luu gia tri post khi có dữ liệu POST gửi về.
        $data['post_data'] = $this->input->post();
        
        if($this->input->post('cmd') == 'submit'){
            $this->form_validation->set_rules('title', 'Tên nhóm người dùng', 'required');
            
            $this->form_validation->set_message('required', '%s không được để trống.');
            
            if($this->form_validation->run() == TRUE){
                $input_data = $this->mycommonlib->Filter_Field($data['post_data'], array('title', 'permission_key'));
                if(!isset($input_data['permission_key'])){
                    $input_data['permission_key'] = array();
                }
                
                if($this->Musergroup->InsertNewItem($input_data['title'], $this->auth['id'], $input_data['permission_key']))
                {
                    $this->mycommonlib->redir_alert('Thêm mới thành công', CMS_DEFAULT_BACKEND_URL.'/user/usergroup');
                }else{
                    $this->mycommonlib->redir_alert('Thêm mới thất bại', CMS_DEFAULT_BACKEND_URL.'/user/usergroup');
                }
            }
        }
        
        
        $data['perm_list'] = $this->db->order_by('group')->get('permlist')->result_array();
        $data['auth'] = $this->auth;
        $data['tpl'] = 'backend/user/addgroup';
		$this->load->view('backend/layout/home', $data);
    }
    
    public function editgroup($id = 0){
        if(!is_numeric($id) || $id <= 0){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không có', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/user/usergroup');
        }
        
        if($this->input->get('redir')){
            $redir = $this->input->get('redir');
        }
        
        
        if($data['post_data'] = $this->Musergroup->SelectByID($id)){
            $data['post_data'] = (array)$data['post_data'];
            if($data['post_data']['permission_key'] != ''){
                $data['post_data']['permission_key'] = json_decode($data['post_data']['permission_key']);
            }
        }
        else{
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không có', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/user/usergroup');
        }
        
        if($this->input->post('cmd') == 'submit'){
            $this->form_validation->set_rules('title', 'Tên nhóm người dùng', 'required');
            
            $this->form_validation->set_message('required', '%s không được để trống.');
            
            $data['post_data'] = $this->input->post();
            
            if($this->form_validation->run() == TRUE){
                $input_data = $this->mycommonlib->Filter_Field($data['post_data'], array('title', 'permission_key'));
                if(!isset($input_data['permission_key'])){
                    $input_data['permission_key'] = array();
                }
                
                if($this->Musergroup->ModifyRow($input_data, $id))
                {
                    $this->mycommonlib->redir_alert('Sửa thành công.', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/user/usergroup');
                }
                else{
                    $this->mycommonlib->redir_alert('Bản khi không bị thay đổi.', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/user/usergroup');
                }
            }
        }
        
        $data['perm_list'] = $this->db->order_by('group')->get('permlist')->result_array();
        $data['auth'] = $this->auth;
        $data['tpl'] = 'backend/user/editgroup';
		$this->load->view('backend/layout/home', $data);
    }
    
    public function delgroup($id = 0){
        if($this->input->get('redir')){
            $redir = $this->input->get('redir');
        }
        
        if(is_numeric($id)){
            if(count_user_in_group($id) == 0){
                if($this->Musergroup->SelectByID($id)){
                    $this->Musergroup->delete($id);
                    $this->mycommonlib->redir_alert('Xóa nhóm thành công.', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/user/usergroup');
                }else{
                    $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/user/usergroup');
                }
            }else{
                $this->mycommonlib->redir_alert('Vẫn còn user trong nhóm.', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/user/usergroup');
            }
                
        }else{
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.', CMS_DEFAULT_BACKEND_URL.'/user/usergroup');
        }
    }
}