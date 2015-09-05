<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {
    var $auth;
    
    public function __construct(){
        parent::__construct();
        $this->authen->check_login();
        $this->auth = $this->session->userdata('session_login');
        $this->authen->check_permission($this->router->fetch_class().'/'.$this->router->fetch_method());
        
        
        $this->load->model('backend/model_category', 'Mcategory');
        $this->load->library('my_nestedset');
    }
    
	public function index()
	{
        if($this->input->post('cmd') == 'search'){
    		$keyword = $this->input->post('keyword');
    		redirect(current_url().'/?keyword='.$keyword);
    	}
    	
    	//Define default value
    	$keyword = $this->input->get('keyword');
    	$redir   = $this->input->get('redir');
        
        //Sorting a list Items
        if($this->input->post('cmd') == 'sort'){
    		$id_arr = $this->input->post('order');
            
    		if($this->Mcategory->SortItems($id_arr)){
    			$this->mycommonlib->redir_alert('Sắp xếp thành công!',CMS_DEFAULT_BACKEND_URL.'/category/');
    		}else{
    			$this->mycommonlib->redir_alert('Sắp xếp thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/category/':base64_decode($redir));
    		}
    	}
        
    	//Process Delete a list
    	if($this->input->post('cmd') == 'delete'){
    		$id_arr = $this->input->post('id');
            
    		if($this->Mcategory->delete($id_arr)){
    			$this->mycommonlib->redir_alert('Xóa thành công!',CMS_DEFAULT_BACKEND_URL.'/category/');
    		}else{
    			$this->mycommonlib->redir_alert('Xóa thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/category/':base64_decode($redir));
    		}
    	}
    	
    	//Process to show a list
    	if($this->input->post('cmd') == 'show'){
    		$id_arr = $this->input->post('id');
    		
    		if($this->Mcategory->toggle_item('publish', $id_arr)){
    			$this->mycommonlib->redir_alert('Thao tác thành công!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/category/':base64_decode($redir));
    		}else{
    			$this->mycommonlib->redir_alert('Thao tác thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/category/':base64_decode($redir));
    		}
    		
    	}
		
		
        //Main Data
        $order_by = $this->input->get('field').' '.$this->input->get('direction');
        if($order_by == ' '){
            $order_by = 'lft ASC';
        }
        
        $data['input_data']= $this->Mcategory->SelectByX(array('id'=> '>1'), $keyword, $order_by);
		$data['tree_data'] = $this->my_nestedset->dropdown(); 
		//Data to transport
		$data['keyword'] = $keyword;
        $data['auth'] = $this->auth;
        $data['tpl'] = 'backend/category/home';
		$this->load->view('backend/layout/home', $data);
	}
    
    public function del($id = 0){
        if($this->input->get('redir')){
            $redir = $this->input->get('redir');
        }
        
        if(is_numeric($id)){
            if($this->Mcategory->SelectByID($id)){
                $this->Mcategory->delete($id);
                $this->mycommonlib->redir_alert('Xóa category thành công.', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/category/');
            }else{
                $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/category/');
            }
                
        }else{
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.', CMS_DEFAULT_BACKEND_URL.'/category/');
        }
    }
    
    public function category_toggle($field = 'publish', $id = 1){
        $allow_arr = array('publish');
        $redir = $this->input->get('redir');
        
        if(!in_array($field, $allow_arr)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/products/':base64_decode($redir));
        }
        
        if(!$this->Mcategory->toggle_item($field, $id)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/category/':base64_decode($redir));
        }else{
            $this->mycommonlib->redir_alert('Thay đổi trạng thái thành công!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/category/':base64_decode($redir));
        }
    }
    
    public function add(){
    	
    	if($this->input->post()){
    		$data['post_data'] = $this->input->post();
            
            $this->form_validation->set_rules('title', 'Category Name', 'required');
            $this->form_validation->set_rules('parentid', 'Thư mục cha', 'required|numeric');
            $this->form_validation->set_rules('alias', 'Alias', 'callback__exist_alias');
            $this->form_validation->set_rules('description', 'Miêu tả', 'required');
            
            $this->form_validation->set_message('required', '%s không được để trống');
            $this->form_validation->set_message('numeric', '%s nhập sai dữ liệu');
            
    		if($this->form_validation->run() == TRUE){
                $data['post_data'] = $this->mycommonlib->Filter_Field($data['post_data'], array('title', 'alias', 'image', 'parentid', 'description', 'meta_keyword', 'meta_description'));
                
                if($data['post_data']['alias'] == ''){
                    $data['post_data']['alias'] = $this->ajax_alias($data['post_data']['title']);
                }
                
    			$this->Mcategory->InsertNewItem($data['post_data'], $this->auth['id']);
    			$this->mycommonlib->redir_alert('Thêm thành công.',CMS_DEFAULT_BACKEND_URL.'/category');
    		}
    	}
        
        $data['list_category'] = $this->my_nestedset->dropdown(); 
        
    	$data['auth'] = $this->auth;
        $data['tpl'] = 'backend/category/add';
		$this->load->view('backend/layout/home', $data);
    }
    
    public function edit($id){
        if(!$this->Mcategory->SelectByID($id) || !is_numeric($id)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.',isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/category/');
        }
        
        $data['post_data'] = (array)$this->Mcategory->SelectByID($id);
        
        if($this->input->post()){
    		$data['post_data'] = $this->input->post();
            
            $this->form_validation->set_rules('title', 'Category Name', 'required');
            $this->form_validation->set_rules('parentid', 'Thư mục cha', 'required|numeric|callback__valid_parent['.$id.']');
            $this->form_validation->set_rules('description', 'Miêu tả', 'required');
            $this->form_validation->set_message('required', '%s không được để trống');
            $this->form_validation->set_message('numeric', '%s nhập sai dữ liệu');
            
    		if($this->form_validation->run() == TRUE){
                $data['post_data'] = $this->mycommonlib->Filter_Field($data['post_data'], array('title', 'alias', 'image', 'parentid', 'description', 'meta_keyword', 'meta_description'));
                if($data['post_data']['alias'] == ''){
                    $data['post_data']['alias'] = $this->ajax_alias($data['post_data']['title']);
                }
                
    			$this->Mcategory->ModifyRow($data['post_data'], $id);
    			$this->mycommonlib->redir_alert('Sửa thành công.',CMS_DEFAULT_BACKEND_URL.'/category');
    		}
    	}
        
        $data['list_category'] = $this->my_nestedset->dropdown(); 
        
    	$data['auth'] = $this->auth;
        $data['tpl'] = 'backend/category/edit';
		$this->load->view('backend/layout/home', $data);
    }
    
    public function _valid_parent($parent_id, $id){
        $curent_data    = (array)$this->Mcategory->SelectByID($id);
        $new_parent_id  = (array)$this->Mcategory->SelectByID($parent_id);
        
        if($curent_data['lft'] <= $new_parent_id['lft'] && $curent_data['rgt'] >= $new_parent_id['rgt']){
            $this->form_validation->set_message('_valid_parent', 'Lỗi trong quá trình chuyển thư mục cha.');
            return false;
        }else{
            return true;
        }
    }
    
    public function ajax_alias($str = ''){  //MODE == 1 -> Return Bool   == 0 echo OUTPUT
        $mode = 1;
        
        if($str == ''){
            $mode = 0;
            $str = $this->input->post('str');
            $str = $this->mycommonlib->vn2latin($str, true);
        }
        
        $count = $this->db->like('alias', "$str", 'none')->get('category')->num_rows() + 1;
        
        if($count > 1)
            $output =  $str . '-' . $count;
        else{
            $output = $str;
        }
        
        if($mode)
            return $output;
        
        echo $output;
    }
    
    public function _exist_alias($str){
        if($str == '')
            return true;
        
        $data = $this->Mcategory->SelectByX(array('alias' => $str));
        if(count($data) > 0){
            $this->form_validation->set_message('_exist_alias', 'Alias bạn nhập đã có trong CSDL.');
            return false;
        }else{
            return true;
        }
    }
}