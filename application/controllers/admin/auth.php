<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
Class Auth extends CI_Controller{
    public function login(){
        
        $data = array('login_error' => false);  //Checking login status
        
        //echo random_string('alpha', 100);
        
        if($this->input->post()){
            $data['post_data'] = $this->input->post();
            $this->form_validation->set_rules('username', 'Tên Đăng Nhập', 'required');
            $this->form_validation->set_rules('password', 'Mật Khẩu', 'required');
            $this->form_validation->set_message('required', '%s không được để trống.');
            
            if($this->form_validation->run() == TRUE){
                //Getting username and password from summiting data
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                //Sending login data to processor
                $redir = $this->input->get('redir');
                if($this->authen->login($username, $password, $redir)){
                    //Redir to last action
                    if($this->input->post('redir') != ''){
                        if(strpos($this->input->post('redir'), '.html')){
                            redirect(base64_decode(substr($this->input->post('redir'), 0, strlen($this->input->post('redir'))-5)));
                        }
                        
                        redirect(base64_decode($this->input->post('redir')));
                    }
                    else{
                        redirect(CMS_DEFAULT_BACKEND_URL);
                    }
                }
                else{
                    $data['login_error'] = true;
                }
            }
        }
        
        $this->load->view('backend/auth/login', $data);
    }
    
    public function forgot(){
        
        $data = array('email_error' => false);
        
        if($this->input->post()){
            $data['post_data'] = $this->input->post();
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_message('required', '%s không được để trống.');
            $this->form_validation->set_message('valid_email', 'Bạn phải điền đúng địa chỉ mail.');
            
            if($this->form_validation->run() == TRUE){
                //Getting Email from summiting data
                $email = $this->input->post('email');
                if(!$this->authen->forgot($email)){
                    $data['email_error'] = true;
                }
            }
        }
        
        $this->load->view('backend/auth/forgot', $data);
    }
    
    public function reset(){
        
        $data = array('valid' => 1);
        $data['post_data'] = $this->input->get();
        
        if($this->input->post()){
            $data['post_data'] = $this->input->post();
            $this->form_validation->set_rules('username', 'Tài khoản', 'required');
            $this->form_validation->set_rules('code', 'Reset Code', 'required');
            $this->form_validation->set_rules('newpass', 'Password', 'required');
            $this->form_validation->set_rules('repass', 'Repass', 'required');
            $this->form_validation->set_message('required', '%s không được để trống.');
            
            if($this->form_validation->run() == TRUE){
                if($data['post_data']['newpass'] != $data['post_data']['repass']){
                    $data['valid'] = 0;
                }
                else{
                    if($this->authen->reset_password($data['post_data']['username'], $data['post_data']['code'], $data['post_data']['newpass'])){
                        $this->mycommonlib->redir_alert('Password đã được thay đổi.', CMS_LOGIN_BACKEND_URL);
                    }
                    else{
                        $data['valid'] = -1;
                    }
                }
            }
        }
        
        $this->load->view('backend/auth/reset_password', $data);
    }
    
    //Logout function
    public function logout(){
        $this->authen->logout();
        redirect(CMS_LOGIN_BACKEND_URL);
    }
}