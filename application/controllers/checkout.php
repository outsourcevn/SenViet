<?php

class Checkout extends CI_Controller{
    var $configs = null;
    
    public function __construct(){
        parent::__construct();
        
        $this->load->model('frontend/model_category', 'Mcategory');
        $this->load->model('frontend/model_products', 'Mproduct');
        $this->load->model('frontend/model_slide', 'Mslide');
        $this->load->model('frontend/model_configs', 'Mconfigs');
        $this->load->model('frontend/model_order', 'Morder');
        $this->load->model('frontend/model_orderdetail', 'Morderdetail');
        $this->configs = $this->Mconfigs->get_Configs();
    }
    
    public function updateCart(){
        $quantity = $this->input->post('quantity');
            
        //FORM VALIDATION RULES
        $this->form_validation->set_rules('quantity[]', 'Quantity', 'required|is_natural_no_zero');
        
        if($this->form_validation->run() == TRUE){
            $cart = $this->session->userdata('cart');
            //$cart = $this->input->post('quantity');
            $count = 0;
            
            if(isset($cart) && count($cart) && is_array($cart)) {
                foreach($cart as $k => $v){
                    $cart[$k] = $quantity[$count];
                    
                    if($cart[$k] == 0){
                        unset($cart[$k]);
                    }
                    
                    $count++;
                }
                $this->session->set_userdata(array('cart' => $cart));
            }
        }
    }
    
    /**
     * Adding Order Detail into Database
     **/
    public function proceedOrderDetail($order_id = 0){
        $cart = $this->session->userdata('cart');
        $temp = array();
        
        if(count($cart) && is_array($cart)){
            foreach($cart as $k => $v){
                //K = ID && V = QUANTITY
                $product = get_product_by_id($k);
                
                if($product->sale_price > 0 && $product->sale_price < $product->price)
                    $product->price = $product->sale_price;
                
                $temp = array('order_id' => $order_id, 'product_id' => $k, 'quantity' => $v, 'price' => $product->price);
                
                $this->Morderdetail->InsertNewItem($temp);
            }
        }
    }
    
    /**
     * Process to Empty Cart
     **/
    public function emptyCart(){
        $cart = null;
        $this->session->set_userdata(array('cart' => $cart));
    }
    
    /**
     * Process to CheckOut
     **/
    public function checkout(){
        //Truong hop neu nguoi mua hang sua doi lai Quantity
        $this->updateCart();
        
        $this->form_validation->set_rules('first_name', 'Frist Name', 'required|min_length[2]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|min_length[2]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric');
        $this->form_validation->set_rules('address', 'Address', 'required|min_length[10]');
        
        
        if($this->form_validation->run()){
            $order_id = $this->Morder->InsertNewItem($this->input->post() , 0);
            
            $this->proceedOrderDetail($order_id);
            $this->emptyCart();
            
            redirect('checkout/successful/'.$order_id);
        }
    }
    
    public function index($page = 0){
        
        
        /*
        Process EMPTY CART FUNCTION
        */
        
        if($this->input->post('cmd') == 'empty'){
            $this->emptyCart();
        }
        
        /*
        Process Update Cart FUNCTION
        */
        if($this->input->post('cmd') == 'update'){
            $this->updateCart();
        }
        
        
        /*
            CHECKOUT FUNCTION
        */
        if($this->input->post('cmd') == 'checkout'){
            $this->checkout();
        }
        
        //Configs
        $data['configs'] = $this->configs;
        
        //Flash Message
        $data['showed_flash_message']   = $this->session->userdata('showed_flash');
        $data['flas_message']           = $data['configs']->flash_message;
        $this->session->set_userdata(array('showed_flash' => 1));
        
        //Category List
        $data['category_list']          = $this->Mcategory->All(2);
        
        //BreadCrumb
        $data['breadcrumb']             = array('Home' => CMS_BASE_URL, 'Shop' => 'shop', 'Thanh Toán' => 'checkout');
        
        //DATA LIST BRAND
        $data['cart']                   = $this->session->userdata('cart');
        
        //SEO
        $data['seo']['title']           = (isset($this->configs->meta_title) ? 'Thanh toán - '. $this->configs->meta_title : 'Thanh toán');
        
        
        
        //View
        $data['tpl']                    = 'frontend/checkout/checkout';
        if($this->configs->is_active){
            $this->load->view('frontend/layout/1-column', $data);
        }else{
            $this->load->view('frontend/home/maintain', $data);
        }
    }
    
    public function del($id = null){
        if(!$id || !is_numeric($id)){
            show_404();
        } else {
            $cart = $this->session->userdata('cart');
            
            if(isset($cart[$id])){
                unset($cart[$id]);
                $this->session->set_userdata(['cart' => $cart]);
            } else {
                show_404();
            }
            
            redirect('checkout');
        }
    }
    
    public function successful($order_id = 0){
        //Configs
        $data['configs'] = $this->configs;
        
        //Flash Message
        $data['showed_flash_message']   = $this->session->userdata('showed_flash');
        $data['flas_message']           = $data['configs']->flash_message;
        $this->session->set_userdata(array('showed_flash' => 1));
        
        //Category List
        $data['category_list']          = $this->Mcategory->All(2);
        
        //BreadCrumb
        $data['breadcrumb']             = array('Home' => CMS_BASE_URL, 'Shop' => 'shop', 'Thanh Toán' => 'checkout');
        
        //DATA LIST BRAND
        $data['cart']                   = $this->session->userdata('cart');
        
        //SEO
        $data['seo']['title']           = (isset($this->configs->meta_title) ? 'Thanh toán - '. $this->configs->meta_title : 'Thanh toán');
        
        $data['order_id']               = $order_id;
        
        //View
        $data['tpl']                    = 'frontend/checkout/success';
        if($this->configs->is_active){
            $this->load->view('frontend/layout/1-column', $data);
        }else{
            $this->load->view('frontend/home/maintain', $data);
        }
    }
    
    public function order($order_id = 0){
        
        $raw_data = $this->Morder->SelectByID($order_id); 
        
        if($raw_data){
            $products = $this->Morderdetail->SelectByOrderID($order_id);
            
            $this->load->view('frontend/checkout/vieworder', array('order' => $raw_data, 'order_id' => $order_id, 'products' => $products));
        } else {
            show_404();
        }
    }
}