<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {
    var $auth;
    
    public function __construct(){
        parent::__construct();
        $this->authen->check_login();
        $this->auth = $this->session->userdata('session_login');
        $this->authen->check_permission($this->router->fetch_class().'/'.$this->router->fetch_method());
        
        
        $this->load->model('backend/model_product', 'Mproduct');
        $this->load->model('backend/model_brand', 'Mbrand');
        $this->load->model('backend/model_category', 'Mcategory');
        $this->load->model('backend/model_image', 'Mimage');
        $this->load->model('backend/model_product_cate', 'MPCLink');
    }
    
	public function index($page = 0)
	{   	
    	//Define default value
        $keyword        = $this->input->get('keyword');
        $redir          = $this->input->get('redir');
        $category_id    = $this->input->get('category_id');
        $brand_id       = $this->input->get('brand_id');
        $price_from     = $this->input->get('price_from');
        $price_to       = $this->input->get('price_to');
        $perpage        = CMS_ITEM_PER_PAGE;
        
        $order_by = $this->input->get('field').' '.$this->input->get('direction');
        $field = $this->input->get('field');
        $direction = $this->input->get('direction');
        if($order_by == ' '){
            $order_by = 'ID DESC';
        }
                
        //Sorting a list Items
        if($this->input->post('cmd') == 'sort'){
    		$id_arr = $this->input->post('order');
            
    		if($this->Mproduct->SortItems($id_arr)){
    			$this->mycommonlib->redir_alert('Sắp xếp thành công!',CMS_DEFAULT_BACKEND_URL.'/products/');
    		}else{
    			$this->mycommonlib->redir_alert('Sắp xếp thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/products/':base64_decode($redir));
    		}
    	}
        
    	//Process Delete a list
    	if($this->input->post('cmd') == 'delete'){
    		$id_arr = $this->input->post('id');
            
    		if($this->Mproduct->delete($id_arr)){
    			$this->mycommonlib->redir_alert('Xóa thành công!',CMS_DEFAULT_BACKEND_URL.'/products/');
    		}else{
    			$this->mycommonlib->redir_alert('Xóa thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/products/':base64_decode($redir));
    		}
    	}
    	
    	//Process to show a list
    	if($this->input->post('cmd') == 'show'){
    		$id_arr = $this->input->post('id');
    		
    		if($this->Mproduct->toggle_item('publish', $id_arr)){
    			$this->mycommonlib->redir_alert('Thao tác thành công!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/products/':base64_decode($redir));
    		}else{
    			$this->mycommonlib->redir_alert('Thao tác thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/products/':base64_decode($redir));
    		}
    		
    	}
        
        $this->load->model('backend/model_category', 'Mcategory');
        $this->load->model('backend/model_brand', 'Mbrand');
        $data['list_category']  = $this->Mcategory->SelectByX(null, null, 'lft ASC');
        $data['list_brand']     = $this->Mbrand->SelectByX(null, null, 'brand_name ASC');
        
        
        //Pagination
		$config = $this->mypagination->get_config();
		$config['base_url']     = base_url(CMS_DEFAULT_BACKEND_URL.'/products/index');
		$config['first_url']    = base_url(CMS_DEFAULT_BACKEND_URL.'/products/index').'?'.$_SERVER['QUERY_STRING'];
		$config['total_rows']   = $this->Mproduct->CountRowWithFilter($keyword, $category_id, $brand_id, 
                                                                    $price_from, $price_to);
        $config['per_page']     = CMS_ITEM_PER_PAGE;
        $page                   = ($page < 0) ? $page = 0 : $page;
        $page                   = ($page >= $config['total_rows']) ? 0 : $page;
		$config['cur_page'] = $page;
		$config['suffix'] = '?'.$_SERVER['QUERY_STRING'];
		$this->pagination->initialize($config);
         
		//Data to transport
        $data['input_data'] = $this->Mproduct->SelectDataWithFilter($keyword, $category_id, $brand_id, 
                                                                    $price_from, $price_to, $order_by, 
                                                                    $page, $perpage);
        $data['pagination'] = $this->pagination->create_links();
		$data['keyword']            = $keyword;
        $data['brand_id']           = $brand_id;
        $data['category_id']        = $category_id;
        $data['price_from']         = $price_from;
        $data['price_to']           = $price_to;
        $data['field']              = $field;
        $data['direction']          = $direction;
        $data['auth']               = $this->auth;
        $data['tpl']                = 'backend/products/home';
		$this->load->view('backend/layout/home', $data);
	}
    
    public function del($id = 0){
        if($this->input->get('redir')){
            $redir = $this->input->get('redir');
        }
        
        if(is_numeric($id)){
            if($this->Mproduct->SelectByID($id)){
                $this->Mproduct->delete($id);
                $this->mycommonlib->redir_alert('Xóa product thành công.', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/products/');
            }else{
                $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.', isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/products/');
            }
                
        }else{
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.', CMS_DEFAULT_BACKEND_URL.'/products/');
        }
    }
    
    public function products_toogle($field = 'publish', $id = 1){
        $allow_arr = array('publish');
        $redir = $this->input->get('redir');
        
        if(!in_array($field, $allow_arr)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/products/':base64_decode($redir));
        }
        
        if(!$this->Mproduct->toggle_item($field, $id)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/products/':base64_decode($redir));
        }else{
            $this->mycommonlib->redir_alert('Thay đổi trạng thái thành công!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/products/':base64_decode($redir));
        }
    }
    
    public function add(){
    	if($this->input->post()){
    		$data['post_data'] = $this->input->post();
            
            //FORM VALIDATION RULES
            $this->form_validation->set_rules('title', 'Tên sản phẩm', 'required');
            $this->form_validation->set_rules('brand_id', 'Thương hiệu', 'required|is_natural_no_zero');
            $this->form_validation->set_rules('price', 'Giá sản phẩm', 'required|is_natural_no_zero');
            $this->form_validation->set_rules('sale_price', 'Giá khuyến mại', 'is_natural_no_zero');
            $this->form_validation->set_rules('description', 'Chi tiết sản phẩm', 'required');
            $this->form_validation->set_rules('alias', 'Alias', 'callback__exist_alias');
            
            //FORM VALIDATION MESSAGE
            $this->form_validation->set_message('required', '%s cần có một giá trị cụ thể.');
            $this->form_validation->set_message('is_natural_no_zero', '%s phải được nhập đúng định dạng.');
            
            
    		if($this->form_validation->run() == TRUE){
                $data['post_data'] = $this->mycommonlib->Filter_Field($data['post_data'], array('title', 'alias', 'image', 'parentid', 'description', 'meta_keyword', 'meta_description', 'meta_title', 'price', 'sale_price', 'brand_id', 'publish', 'is_featured'));
                
                $this->Mproduct->InsertNewItem($data['post_data'], $this->auth['id']);
                
                $image_list = $this->input->post('image', true);
                $type       = $this->input->post('type', true);
                $featured_images = $this->input->post('featured_images', true);
                $inserted_id = $this->Mproduct->inserted_id();
                
                
                //THEM PRODUCT VAO CATEGORY
                $categories_list = $this->input->post('category_id');
                if(count($categories_list)){
                    foreach($categories_list as $k => $v){
                        $arr['product_id']  = $inserted_id;
                        $arr['category_id'] = $v;
                        $this->MPCLink->InsertNewItem($arr);
                    }
                }
                
    			$this->mycommonlib->redir_alert('Thêm thành công.',CMS_DEFAULT_BACKEND_URL.'/products/');
    		}
    	} 
        
        $data['category_list']      = $this->Mcategory->SelectByX();
        $data['brand_list']         = $this->Mbrand->SelectByX(null, '', '`brand_name` ASC');
    	$data['auth'] = $this->auth;
        $data['tpl'] = 'backend/products/add';
		$this->load->view('backend/layout/home', $data);
    }
    
    public function edit($id = null){
        
        if($this->input->get('redir')){
            $redir = $this->input->get('redir');
        }
        
        if(!$this->Mproduct->SelectByID($id) || !is_numeric($id)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không đúng.',isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/products/');
        }
        
        $raw_data = (array)$this->Mproduct->SelectByID($id);
        
        if($this->input->post()){
    		$data['post_data'] = $this->input->post();
            
            //FORM VALIDATION RULES
            $this->form_validation->set_rules('title', 'Tên sản phẩm', 'required');
            $this->form_validation->set_rules('brand_id', 'Thương hiệu', 'required|is_natural_no_zero');
            $this->form_validation->set_rules('price', 'Giá sản phẩm', 'required|is_natural_no_zero|greater_than[0]');
            $this->form_validation->set_rules('sale_price', 'Giá khuyến mại', 'greater_than[0]');
            $this->form_validation->set_rules('description', 'Chi tiết sản phẩm', 'required');
            $this->form_validation->set_rules('alias', 'Alias', 'callback__exist_alias['.$raw_data['alias'].']');
            
            //FORM VALIDATION MESSAGE
            $this->form_validation->set_message('required', '%s cần có một giá trị cụ thể.');
            $this->form_validation->set_message('is_natural_no_zero', '%s phải được nhập đúng định dạng.');
            
            if($this->form_validation->run() == TRUE){
                $data['post_data'] = $this->mycommonlib->Filter_Field($data['post_data'], array('title', 'alias', 'image', 'parentid', 'description', 'meta_keyword', 'meta_description', 'meta_title', 'price', 'sale_price', 'brand_id', 'publish', 'is_featured'));
                $this->Mproduct->ModifyRow($data['post_data'], $id);
                
                //GET FURTHER ITEMS
                $image_list  = $this->input->post('image', true);
                $type        = $this->input->post('type', true);
                $featured_images = $this->input->post('featured_images', true);
                $inserted_id = $id;
                
                
                //THEM PRO VAO CATE
                $this->MPCLink->DeleteByProID($id);
                $categories_list = $this->input->post('category_id');
                if(count($categories_list) > 0 && is_array($categories_list)){
                    foreach($categories_list as $k => $v){
                        $arr['product_id']  = $inserted_id;
                        $arr['category_id'] = $v;
                        $this->MPCLink->InsertNewItem($arr);
                    }
                }
                
                $this->mycommonlib->redir_alert('Thay đổi thông tin sản phẩm thành công.',isset($redir) ? base64_decode($redir) : CMS_DEFAULT_BACKEND_URL.'/products/');
            }
        }else{
            $data['post_data'] = $raw_data;
        }
        
        
        $data['selected_image']     = $this->Mimage->SelectByX(array('FK_id' => $id));
        
        //Lay du lieu category tu POST hoac Mysql
        $data['post_data']['category_id']  = (isset($data['post_data']['category_id'])) ? 
            $data['post_data']['category_id'] : 
            ProcessCategory($this->MPCLink->SelectByX(array('product_id' => $id)));
        
        //Lay du lieu tu server hoac cua nguoi dung gui len tuy thuoc vao su kien POST
        $data['post_data']['image'] = (isset($data['post_data']['image'])) ? 
            $data['post_data']['image'] : 
            ProcessImage($this->Mimage->SelectByX(array('FK_id' => $id)));
        
        $data['image']['thumbnail'] = $this->Mimage->SelectByX(array('FK_id' => $id, 'main_image' => 1));
        $data['image']['thumbnail'] = isset($data['image']['thumbnail'][0]) ? $data['image']['thumbnail'][0] : null;
         
        $data['category_list']      = $this->Mcategory->SelectByX();
        $data['brand_list']         = $this->Mbrand->SelectByX(null, '', '`brand_name` ASC');
    	$data['auth']               = $this->auth;
        $data['tpl'] = 'backend/products/edit';
		$this->load->view('backend/layout/home', $data);
    }
    
    public function ajax_alias($str = ''){  //MODE == 1 -> Return Bool   == 0 echo OUTPUT
        $mode = 1;
        
        if($str == ''){
            $mode = 0;
            $str = $this->input->post('str');
            $str = $this->mycommonlib->vn2latin($str, true);
        }
        
        $count = $this->db->like('alias', "$str", 'none')->get('products')->num_rows() + 1;
        if($count > 1)
            $output =  $str . '-' . $count;
        else{
            $output = $str;
        }
        
        if($mode)
            return $output;
        
        echo $output;
    }
    
    public function _exist_alias($str, $oldAlias = null){
        
        if($oldAlias != null){
            if($str == $oldAlias)
                return true;
        }
                
        if($str != '')
            return true;
        
        $data = $this->Mproduct->SelectByX(array('alias' => $str));
        if(count($data) > 0){
            $this->form_validation->set_message('_exist_alias', 'Alias bạn nhập đã có trong CSDL.');
            return false;
        }else{
            return true;
        }
    }
}

