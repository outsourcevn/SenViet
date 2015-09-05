<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Configs extends CI_Controller {
    
    var $auth;
    
    public function __construct(){
        parent::__construct();
        
        $this->authen->check_login();
        
        $this->auth = $this->session->userdata('session_login');
        
        if(!$this->authen->check_permission($this->router->fetch_class().'/'.$this->router->fetch_method()))
        	return false;
    }
	
    public function index()
	{
        
        if($this->input->post()){
            $data['post_data'] = $this->input->post();
            
            $data['post_data'] = $this->mycommonlib->Filter_Field($data['post_data'], array('homepage', 'is_active', 'perpage', 'maintain_message', 'flash_message', 'meta_title', 'meta_keyword', 'meta_description'));
            
            $this->db->update('configs', $data['post_data']);
            
            $this->mycommonlib->redir_alert('Thay đổi website thành công!',CMS_DEFAULT_BACKEND_URL.'/configs/');
            
        }else{
            $data['post_data'] = $this->db->get('configs')->row_array();
        }
        
        //Data to transport
        $data['auth'] = $this->auth;
        $data['tpl'] = 'backend/configs/home';
        $this->load->view('backend/layout/home', $data);
	}
    
    public function permlist(){
        //Define default variable
        $redir   = $this->input->get('redir');

        //Process Delete a list
    	if($this->input->post('cmd') == 'delete'){
            if(!$this->authen->check_permission($this->router->fetch_class().'/del_permission')){
        	   $this->mycommonlib->redir_alert('Bạn không có quyền truy nhập vào đây!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/configs/':base64_decode($redir));
               return false;
            }
            
    		$id_arr = $this->input->post('id');
            
    		if(count($id_arr) > 0){
    			$this->db->where_in('id', $id_arr)->delete('permlist');
                
                $this->mycommonlib->redir_alert('Thao tác thành công!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/configs/':base64_decode($redir));
    		}else{
                $this->mycommonlib->redir_alert('Thao tác thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/configs/':base64_decode($redir));
    		}
    	}
        
        //Main Data
        $order_by = $this->input->get('field').' '.$this->input->get('direction');
        if($order_by == ' '){
            $order_by = 'ID DESC';
        }
        
        $data['input_data'] = $this->db->order_by($order_by)->get('permlist')->result_array();
        
        
        //Data to transport
        $data['auth'] = $this->auth;
        $data['tpl'] = 'backend/configs/permlist';
        $this->load->view('backend/layout/home', $data);
    }
    
    public function add_permlist(){
        if($this->input->post()){
    		$data['post_data'] = $this->input->post();
            
            $this->form_validation->set_rules('title', 'Tiêu đề', 'required');
            $this->form_validation->set_rules('uri', 'URI', 'required');
            $this->form_validation->set_rules('group', 'Nhóm quyền', 'required');
            
            $this->form_validation->set_message('required', '%s không được để trống');
            
    		if($this->form_validation->run() == TRUE){
                $data['post_data'] = $this->mycommonlib->Filter_Field($data['post_data'], array('title', 'uri', 'group'));
                
                $this->db->insert('permlist', $data['post_data']);
                
    			$this->mycommonlib->redir_alert('Thêm thành công.',CMS_DEFAULT_BACKEND_URL.'/configs/permlist');
    		}
    	}
        
    	$data['auth'] = $this->auth;
        $data['tpl'] = 'backend/configs/add_permlist';
		$this->load->view('backend/layout/home', $data);
    }
    
    public function del_permission($id = null){
        $raw_data = $this->db->where('id', $id)->get('permlist')->row_array();
        
        if(!is_numeric($id) || !$raw_data){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không tồn tại.',CMS_DEFAULT_BACKEND_URL.'/configs/permlist');
            return false;
        }else{
            
        }
    }
}