<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images extends CI_Controller {
    var $auth;
    
    public function __construct(){
        parent::__construct();
        $this->authen->check_login();
        $this->auth = $this->session->userdata('session_login');
        $this->authen->check_permission($this->router->fetch_class().'/'.$this->router->fetch_method());
        
        
        $this->load->model('backend/model_image', 'Mimages');
    }
    
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
            
    		if($this->Mimages->delete($id_arr)){
    			$this->mycommonlib->redir_alert('Xóa thành công!',CMS_DEFAULT_BACKEND_URL.'/images/');
    		}else{
    			$this->mycommonlib->redir_alert('Xóa thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/images/':base64_decode($redir));
    		}
    	}
		
		
        //Main Data
        $order_by = $this->input->get('field').' '.$this->input->get('direction');
        if($order_by == ' '){
            $order_by = 'ID DESC';
        }
        
        //Pagination
		$config = $this->mypagination->get_config();
		$config['base_url'] = base_url(CMS_DEFAULT_BACKEND_URL.'/images/index/');
		$config['first_url'] = base_url(CMS_DEFAULT_BACKEND_URL.'/images/index/').'?'.$_SERVER['QUERY_STRING'];
		$config['total_rows'] = $this->Mimages->CountRow($keyword);
		$config['cur_page'] = ($page >= 0) ? $page : 0;
        $config['per_page'] = 5;
		$config['suffix'] = '?'.$_SERVER['QUERY_STRING'];
		$this->pagination->initialize($config);

        $perpage = $config['per_page'];

        //$this->output->cache(3);

		//Data to transport
        $data['input_data']= $this->Mimages->SelectByX(null, $keyword, $order_by, $page, $perpage);
        $data['pagination'] = $this->pagination->create_links();
		$data['keyword'] = $keyword;
        $data['auth'] = $this->auth;
        $data['tpl'] = 'backend/images/home';
		$this->load->view('backend/layout/home', $data);
	}
    
    public function del($id = 0){
        if($this->input->get('redir')){
            $redir = $this->input->get('redir');
        }
        
        if(is_numeric($id)){
            if($this->Mimages->SelectByID($id)){
                $this->Mimages->delete($id);
                $this->mycommonlib->redir_alert('Xóa người dùng thành công.', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/images/');
            }else{
                $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/images/');
            }
                
        }else{
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.', CMS_DEFAULT_BACKEND_URL.'/images/');
        }
    }
    
    public function add(){
    	
    	if($this->input->post()){
    		$data['post_data'] = $this->input->post();
    		
    		$this->form_validation->set_rules('title', 'Tiêu đề', 'required');
            $this->form_validation->set_rules('image_link', 'Hình ảnh', 'required');
            $this->form_validation->set_rules('FK_id', 'Sản phẩm', 'reuired|numeric');
            
    		$this->form_validation->set_message('required', '%s không được để trống.');
            $this->form_validation->set_message('numeric', '%s bạn nhập sai định dạng.');
            
    		if($this->form_validation->run() == TRUE){
                $data['post_data'] = $this->mycommonlib->Filter_Field($data['post_data'], array('title', 'image_link', 'FK_id', 'main_image', 'featured_images'));
    			$this->Mimages->InsertNewItem($data['post_data'], $this->auth['id']);
    			$this->mycommonlib->redir_alert('Thêm thành công.',CMS_DEFAULT_BACKEND_URL.'/images');
    		}
    	} 
        
    	$data['auth'] = $this->auth;
        $data['tpl'] = 'backend/images/add';
		$this->load->view('backend/layout/home', $data);
    }
    
    public function edit($id = null){
        if($this->input->get('redir')){
            $redir = $this->input->get('redir');
        }
        
        $raw_data = $this->Mimages->SelectByID($id);
        
        if(!is_numeric($id) || !$raw_data)
        {
        	$this->mycommonlib->redir_alert('Trang bạn vừa nhập không đúng.',isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/images/');
        }
        
        $data['post_data'] = (array)$raw_data;
        
        if($this->input->post()){
    		$data['post_data'] = $this->input->post();
    		
    		$this->form_validation->set_rules('title', 'Tiêu đề', 'required');
            $this->form_validation->set_rules('image_link', 'Hình ảnh', 'required');
            $this->form_validation->set_rules('FK_id', 'Sản phẩm', 'reuired|numeric');
            
    		$this->form_validation->set_message('required', '%s không được để trống.');
            $this->form_validation->set_message('numeric', '%s bạn nhập sai định dạng.');
            
    		if($this->form_validation->run() == TRUE){
                $data['post_data'] = $this->mycommonlib->Filter_Field($data['post_data'], array('title', 'image_link', 'FK_id', 'main_image', 'featured_images'));
    			$this->Mimages->ModifyRow($data['post_data'], $id);
    			$this->mycommonlib->redir_alert('Sửa thành công.',isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/images/');
    		}
    	}
        
    	$data['auth'] = $this->auth;
        $data['tpl'] = 'backend/images/edit';
		$this->load->view('backend/layout/home', $data);
    }
    
    public function ajax_search(){
        $this->load->model('backend/model_product', 'Mproduct');
        $query = $this->input->get('query');
        
        $query = strip_tags($query);
        
        $output = $this->Mproduct->SelectDataWithFilter($query, null, null, null, null, '`title` ASC', 0, 5);
        
        if(count($output > 0) && is_array($output)){
            foreach($output as $key => $val){
                echo '<li class="list-group-item SelectProduct" rel="'.$val['id'].'">'.$val['title'].'</li>';
            } 
        }
    }
    
    public function ajax_selected_item(){
        $this->load->model('backend/model_product', 'Mproduct');
        $FK_id = $this->input->get('FK_id');
        
        $output = $this->Mproduct->SelectByID($FK_id);
        
        if($output){    
            echo $output->title;
        }
    }
}