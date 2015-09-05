<?php

class Orders extends CI_Controller{
    var $auth;
    
    public function __construct(){
        parent::__construct();
        $this->authen->check_login();
        $this->auth = $this->session->userdata('session_login');
        if(!$this->authen->check_permission($this->router->fetch_class().'/'.$this->router->fetch_method())){
            
            die();
        }
        
        
        $this->load->model('backend/model_order', 'Morder');
        $this->load->model('backend/model_orderdetail', 'Morderdetail');
    }
    
    public function index($page = 0){
        //Define default value
        $keyword        = $this->input->get('keyword');
        $redir          = $this->input->get('redir');
        $date_from      = $this->input->get('date_from');
        $date_to        = $this->input->get('date_to');
        $status         = $this->input->get('status');
        $perpage        = CMS_ITEM_PER_PAGE;
        
        $order_by = $this->input->get('field').' '.$this->input->get('direction');
        $field = $this->input->get('field');
        $direction = $this->input->get('direction');
        if($order_by == ' '){
            $order_by = 'ID DESC';
        }
        
    	//Process Delete a list
    	if($this->input->post('cmd') == 'delete'){
    		$id_arr = $this->input->post('id');
            
    		if($this->Morder->delete($id_arr)){
                $this->Morderdetail->DeleteByOrderID($id_arr);
    			$this->mycommonlib->redir_alert('Xóa thành công!',CMS_DEFAULT_BACKEND_URL.'/orders/');
    		}else{
    			$this->mycommonlib->redir_alert('Xóa thất bại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/orders/':base64_decode($redir));
    		}
    	}
        
        $this->load->model('backend/model_category', 'Mcategory');
        $this->load->model('backend/model_brand', 'Mbrand');
        
        
        //Pagination
		$config = $this->mypagination->get_config();
		$config['base_url']     = base_url(CMS_DEFAULT_BACKEND_URL.'/orders/index');
		$config['first_url']    = base_url(CMS_DEFAULT_BACKEND_URL.'/orders/index').'?'.$_SERVER['QUERY_STRING'];
		$config['total_rows']   = $this->Morder->CountRowWithFilter($keyword, $date_from, $date_to, $status);
        $config['per_page']     = CMS_ITEM_PER_PAGE;
        $page                   = ($page < 0) ? $page = 0 : $page;
        $page                   = ($page >= $config['total_rows']) ? 0 : $page;
		$config['cur_page'] = $page;
		$config['suffix'] = '?'.$_SERVER['QUERY_STRING'];
		$this->pagination->initialize($config);
         
		//Data to transport
        $data['input_data'] = $this->Morder->SelectDataWithFilter($keyword, $date_from, $date_to, $status, $order_by, $page, $perpage);
        $data['pagination'] = $this->pagination->create_links();
        $data['status']             = $status;
		$data['keyword']            = $keyword;
        $data['date_from']          = $date_from;
        $data['date_to']            = $date_to;
        $data['field']              = $field;
        $data['direction']          = $direction;
        $data['auth']               = $this->auth;
        $data['tpl']                = 'backend/orders/home';
		$this->load->view('backend/layout/home', $data);
    }
    
    public function del($id = null){
        $redir = $this->input->get('redir');
        
        if(!$this->Morder->SelectByID($id)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không tồn tại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/orders/':base64_decode($redir));
        }else{
            $this->Morder->delete($id);
            $this->Morderdetail->DeleteByOrderID($id);
            
            $this->mycommonlib->redir_alert('Xóa hóa đơn thành công!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/orders/':base64_decode($redir));
        }
    }
    
    /**
     * Function view order
     * @author minhducck;
     * @param Integer;
     * @return Void;
     **/
    public function view($id = null){
        
        $redir = $this->input->get('redir');
        
        if(!is_numeric($id)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không tồn tại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/orders/':base64_decode($redir));
        }else{
            $raw_data = $this->Morder->SelectByID($id);
            if($raw_data){
                if($raw_data->is_viewed != 1){
                    $raw_data->is_viewed = 1;
                    $this->Morder->ModifyRow((array)$raw_data, $id);
                }
                //Approve a Order
                if($this->input->post('cmd') == 'approve'){
                    $raw_data->status = 2;
                    $this->Morder->ModifyRow((array)$raw_data, $id);
                }else{
                    //Reject a Order
                    if($this->input->post('cmd') == 'reject'){
                        $raw_data->status = 3;
                        $this->Morder->ModifyRow((array)$raw_data, $id);
                    }else{
                        if($this->input->post('cmd') == 'pending'){
                            $raw_data->status = 1;
                            $this->Morder->ModifyRow((array)$raw_data, $id);
                        }else if($this->input->post('cmd') == 'processing'){
                            $raw_data->status = 4;
                            $this->Morder->ModifyRow((array)$raw_data, $id);
                        }
                    }
                }
                
                
                $data['order']          = (array)$raw_data;
                $data['order']['id']    = $id;
                $data['order_detail']   = $this->Morderdetail->SelectByOrderID($id);
                
                
                
                $data['auth']               = $this->auth;
                $data['tpl']                = 'backend/orders/view';
        		$this->load->view('backend/layout/home', $data);
                
            }else{
                $this->mycommonlib->redir_alert('Trang bạn yêu cầu không tồn tại!',($redir == null) ? CMS_DEFAULT_BACKEND_URL.'/orders/':base64_decode($redir));
            }
        }
    }
    
    //Xoa mot san pham trong Hóa đơn
    public function del_detail($order_id = null, $product_id = null){
        if(!is_numeric($order_id) || !is_numeric($product_id)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không tồn tại!', CMS_DEFAULT_BACKEND_URL.'/orders/');
            return false;
        }
        
        if($this->Morderdetail->SelectByOrderIDAndProID($order_id, $product_id)){
            $this->Morderdetail->DeleteByOrderIDAndProID($order_id, $product_id);
            $this->mycommonlib->redir_alert('Xóa thành công!', CMS_DEFAULT_BACKEND_URL.'/orders/view/'.$order_id);
        } else {
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không tồn tại!', CMS_DEFAULT_BACKEND_URL.'/orders/');
        }
    }
    
    //Sua san pham trong hoa don
    public function edit_detail($order_id = null, $product_id = null){
        if(!is_numeric($order_id) || !is_numeric($product_id)){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không tồn tại!', CMS_DEFAULT_BACKEND_URL.'/orders/');
            return false;
        }

        if($this->Morderdetail->SelectByOrderIDAndProID($order_id, $product_id)){
            $data['post_data']  = $this->Morderdetail->SelectByProID($product_id);
            $sale_price         =   $data['post_data']['sale_price'];
            $ori_price          =   $data['post_data']['ori_price'];
            
            if($this->input->post()){
                //FORM_VALIDATION
                $this->form_validation->set_rules('quantity', 'Quantity', 'required|greater_than[0]');
                $this->form_validation->set_rules('price', 'Price', 'greater_than[0]|callback__check_valid_price['.$product_id.']');
                
                //Form_Rules
                $this->form_validation->set_message('greater_than', '%s Phải là một giá trị lớn hơn 0.');
                if($this->form_validation->run() == TRUE){
                    $data['post_data'] = $this->mycommonlib->Filter_Field($this->input->post(), ['quantity', 'title', 'price']);
                    $data['post_data']['sale_price'] = $sale_price;
                    $data['post_data']['ori_price'] = $sale_price;
                    
                    $data['post_data']['order_id']  = $order_id;
                    $data['post_data']['product_id']  = $order_id;
                    
                    $this->Morderdetail->ModifyRow($data['post_data'], $order_id, $product_id);
                    $this->mycommonlib->redir_alert('Sửa thành công!', CMS_DEFAULT_BACKEND_URL.'/orders/view/'.$order_id);
                }
            }
        } else {
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không tồn tại!', CMS_DEFAULT_BACKEND_URL.'/orders/');
        }
        
        $data['auth'] = $this->auth;
        $data['tpl']    = 'backend/orders/editdetail';
        $this->load->view('backend/layout/home', $data);
    }
    
    public function _check_valid_price($price, $pro_id){
        return true;
        
        $data = $this->db->select('price, sale_price')->where('id', $pro_id)->get('products')->row_array();
        
        if($data['price'] == $price || $data['sale_price'] == $price){
            return true;
        }else{
            $this->form_validation->set_message('_check_valid_price', 'Bạn đã nhập sai giá sản phẩm');
            return false;
        }
    }
    
    //Them san pham vao hoa don
    public function addProduct($order_id = null){
        $data['order_id']   = $order_id;
        $raw_data = $this->Morder->SelectByID($order_id);
        
        if(!is_numeric($order_id) || !$raw_data){
            $this->mycommonlib->redir_alert('Trang bạn yêu cầu không tồn tại!', CMS_DEFAULT_BACKEND_URL.'/orders/');
        } else {
            
            //FORM_VALIDATION
            $this->form_validation->set_rules('product_id', 'Sản phẩm', 'required|numeric|greater_than[0]');
            $this->form_validation->set_rules('quantity', 'Số lượng', 'required|numeric|greater_than[0]');
            $this->form_validation->set_rules('price', 'Giá', 'required|numeric|greater_than[0]');
            
            //FORM_VALIDATION_MESSAGES
            $this->form_validation->set_message('required', 'Xin bạn nhập sản phẩm');
            $this->form_validation->set_message('numeric', 'Xin bạn nhập sản phẩm');
            $this->form_validation->set_message('greater_than', '%s nhập sai dữ liệu');
            
            if($this->form_validation->run() == TRUE){
                $data['post_data'] = $this->input->post();
                                
                $data['post_data']['order_id']   = $order_id;
                $this->Morderdetail->InsertNewItem($data['post_data']);
                
                $this->mycommonlib->redir_alert('Thêm mới thành công!', CMS_DEFAULT_BACKEND_URL.'/orders/view/'.$order_id);
            }
            
            $data['auth'] = $this->auth;
            $data['tpl']  = 'backend/orders/add_product';
            $this->load->view('backend/layout/home', $data);
        }
    }
    
    //Cập nhật dữ liệu sử dụng Ajax
    public function ajax_update($id = null){
        
        $raw_data = $this->Morder->SelectByID($id);
        
        $field = $this->input->post('field');
        $value = $this->input->post('value');
        foreach($_POST as $k => $v){
            if(is_string($v)){
                $_POST[$k] = strip_tags($v);
            }
        }
        
        if($raw_data){
            //VALIDATION RULES
            if($field == 'email') {
                $this->form_validation->set_rules('value', 'Email', 'required|valid_email');
            }
            
            if($field == 'first_name' || $field == 'last_name' || $field == 'address') {
                $this->form_validation->set_rules('value', $field, 'required');
            }
            
            if($field == 'phone') {
                $this->form_validation->set_rules('value', $field, 'required|numeric');
            }
            
            //Xử lí dữ liệu
            if($this->form_validation->run() == TRUE) {
                if(property_exists(get_class($raw_data), $field)){
                
                    $raw_data->{$field} = $value;
                    
                    $this->Morder->ModifyRow((array)$raw_data, $id);
                } else {
                    echo "Error"; 
                }
            } else {
                echo "Error";
            }
            
        }else{
            echo "Error";
        }
    }
    
    //CHON SAN PHAM MAC DINH DE FILL VAO FORM
    public function ajax_selected_item(){
        $this->load->model('backend/model_product', 'Mproduct');
        $FK_id = $this->input->get('FK_id');
        
        $output = $this->Mproduct->SelectByID($FK_id);
        
        if($output){    
            echo $output->title;
        }
    }
    
    //SEARCH PRODUCT FORM AJAX
    public function ajax_search(){
        $this->load->model('backend/model_product', 'Mproduct');
        $query = $this->input->get('query');
        
        $query = strip_tags($query);
        
        $output = $this->Mproduct->SelectDataWithFilter($query, null, null, null, null, '`title` ASC', 0, 5);
        
        if(count($output > 0) && is_array($output)){
            foreach($output as $key => $val){
                echo '<li class="list-group-item SelectProduct" rel="'.$val['id'].'">'.$val['title'].' | '.number_format($val['price']).' VNĐ</li>';
                if($val['sale_price'] > 0){
                    echo '<li class="list-group-item SelectProduct" rel="'.$val['id'].'">'.$val['title'].' | '.number_format($val['sale_price']).' VNĐ</li>';
                }
            } 
        }
    }
}