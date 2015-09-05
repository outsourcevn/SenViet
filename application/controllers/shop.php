<?php
class Shop extends CI_Controller{
    var $configs = null;
    
    public function __construct(){
        parent::__construct();
        
        $this->load->model('frontend/model_category', 'Mcategory');
        $this->load->model('frontend/model_products', 'Mproduct');
        $this->load->model('frontend/model_slide', 'Mslide');
        $this->load->model('frontend/model_configs', 'Mconfigs');
        $this->configs = $this->Mconfigs->get_Configs();
    }
    
    public function index($page = 0){
        //Define Defalt Var
        $category_id    = 0;
        $keyword        = $this->input->get('keyword');
        $brand_id       = $this->input->get('brands_id');
        $price_from     = $this->input->get('price_from');
        $price_to       = $this->input->get('price_to');
        $order_by       = $this->input->get('order_by');
        $perpage        = $this->configs->perpage;
        
        //Configs
        $data['configs'] = $this->configs;
        
        //Flash Message
        $data['showed_flash_message']   = $this->session->userdata('showed_flash');
        $data['flas_message']           = $data['configs']->flash_message;
        $this->session->set_userdata(array('showed_flash' => 1));
        
        //Category List
        $data['category_list']          = $this->Mcategory->All(2);
        
        //BreadCrumb
        $data['breadcrumb']             = array('Home' => CMS_BASE_URL, 'Shop' => 'shop');
        
        //DATA LIST BRAND
        $data['list_brand']             = $this->db->get('brand')->result_object();
        
        //Pagination
		$config = $this->mypagination->get_config();
		$config['base_url']     = base_url('/shop/index');
		$config['first_url']    = base_url('/shop/index').'?'.$_SERVER['QUERY_STRING'];
		$config['total_rows']   = $this->Mproduct->CountRowWithFilter($keyword, $category_id, $brand_id, 
                                                                    $price_from, $price_to);
        $config['per_page']     = $perpage;
        $page                   = ($page < 0) ? $page = 0 : $page;
        $page                   = ($page >= $config['total_rows']) ? 0 : $page;
		$config['cur_page']     = $page;
		$config['suffix'] = '?'.$_SERVER['QUERY_STRING'];
		$this->pagination->initialize($config);
         
		//Data to transport
        $data['products'] = $this->Mproduct->SelectDataWithFilter($keyword, $category_id, $brand_id, 
                                                                    $price_from, $price_to, $order_by, 
                                                                    $page, $perpage);
        $data['pagination'] = $this->pagination->create_links(); 
        
        
        //SEO
        $data['seo']['title']           = (isset($this->configs->meta_title) ? $this->configs->meta_title : 'Shop Online');
        
        //View
        $data['tpl']                    = 'frontend/home/shop';
        if($this->configs->is_active){
            $this->load->view('frontend/layout/2-columns', $data);
        }else{
            $this->load->view('frontend/home/maintain', $data);
        }
    }
    
    public function category($alias, $page = 0){
        
        //Xu ly link khi co ki tu /
        $link = $this->uri->segment_array();
        if(is_numeric($link[count($link)])){
            $page = $link[count($link)];
            unset($link[count($link)]);
        }
        unset($link[1]);
        $alias = implode('/', $link);
        
        $raw_data = $this->Mcategory->FindByAlias($alias);
        
        if(!$raw_data){
            show_404();
        }
        
        //Define Defalt Var
        $category_id    = $raw_data->id;
        $keyword        = $this->input->get('keyword');
        $brand_id       = $this->input->get('brands_id');
        $price_from     = $this->input->get('price_from');
        $price_to       = $this->input->get('price_to');
        $order_by       = $this->input->get('order_by');
        $perpage        = $this->configs->perpage;
        
        //Configs
        $data['configs'] = $this->configs;
        
        //Flash Message
        $data['showed_flash_message']   = $this->session->userdata('showed_flash');
        $data['flas_message']           = $data['configs']->flash_message;
        $this->session->set_userdata(array('showed_flash' => 1));
        
        //Category List
        $data['category_list']          = $this->Mcategory->All(2);
        
        //BreadCrumb
        $data['breadcrumb']             = array('Home' => CMS_BASE_URL, 'Shop' => 'shop', $raw_data->title => $raw_data->alias);
        
        //DATA LIST BRAND
        $data['list_brand']             = $this->db->get('brand')->result_object();
        
        //Pagination
		$config = $this->mypagination->get_config();
		$config['base_url']     = base_url('/category/'.$raw_data->alias);
		$config['first_url']    = base_url('/category/'.$raw_data->alias).'?'.$_SERVER['QUERY_STRING'];
		$config['total_rows']   = $this->Mproduct->CountRowWithFilter($keyword, $category_id, $brand_id, 
                                                                    $price_from, $price_to);
        $config['per_page']     = $perpage;
        $page                   = ($page < 0) ? $page = 0 : $page;
        $page                   = ($page >= $config['total_rows']) ? 0 : $page;
		$config['cur_page']     = $page;
		$config['suffix'] = '?'.$_SERVER['QUERY_STRING'];
		$this->pagination->initialize($config);
         
		//Data to transport
        $data['products'] = $this->Mproduct->SelectDataWithFilter($keyword, $category_id, $brand_id, 
                                                                    $price_from, $price_to, $order_by, 
                                                                    $page, $perpage);
        $data['pagination'] = $this->pagination->create_links(); 
        
        
        //SEO
        $data['seo']['title']           = (isset($raw_data->title) ? $raw_data->title . ' - ' .$this->configs->meta_title : 'Shop Online');
        
        //View
        $data['tpl']                    = 'frontend/home/shop';
        if($this->configs->is_active){
            $this->load->view('frontend/layout/2-columns', $data);
        }else{
            $this->load->view('frontend/home/maintain', $data);
        }
    }
    
    public function detail($alias){
        $alias = substr(uri_string(), 0, strpos(uri_string(), '.html'));
        
        if(!$product = $this->Mproduct->FindByAlias($alias)){
            show_404();
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
        $data['breadcrumb']             = array('Home' => CMS_BASE_URL, 'Shop' => 'shop', $product->title => $alias.'.html');
        
        //Featured Products Data
        $data['featured_product_list']  = $this->Mproduct->SelectFeaturedProducts();
        
        //SEO
        $data['seo']['title']           = (($product->meta_title) ? $product->meta_title  . ' - '. $this->configs->meta_title: $product->title . ' - '. $this->configs->meta_title);
        
        $data['product']                = $product;
        $data['tpl']                    = 'frontend/shop/detail';
        if($this->configs->is_active){
            $this->load->view('frontend/layout/product_detail', $data);
        }else{
            $this->load->view('frontend/home/maintain', $data);
        }
    }
    
    public function ajax_add_to_cart(){
        $product_id = (int)$this->input->post('product_id');
        $quantity   = (int)$this->input->post('quantity');
        
        if(($product_id && $quantity) && $product_id > 0 && $quantity > 0){
            $cart = $this->session->userdata('cart');
            
            if(isset($cart[$product_id])){
                $cart[$product_id] += $quantity;
            }else{
                $cart[$product_id] = $quantity;
            }
            
            $this->session->set_userdata(array('cart'=> $cart));
            
            $data['msg'] = "Thêm sản phẩm vào giỏi hàng thành công";
            $data['items_on_cart']  = count($cart);
            
            $data['products'] = $this->db->where_in('id', array_keys($cart))->get('products')->result_array();
        } else {
            $data['msg'] = "Lỗi trong quá trình thêm sản phẩm vào giỏ hàng";
        }
        
        echo json_encode($data); 
    }
    
    public function ajax_get_cart(){
        $cart = $this->session->userdata('cart');
        
        echo '<table class="table table-bordered">';
        echo '<tr><th>Tên Sản Phẩm</th><th>Số lượng</th><th>Thành Tiền</th><th>Action</th></tr>';
        if(count($cart) > 0 && is_array($cart)){
            $total = 0;
            
            foreach($cart as $k => $v){
                $pro = get_product_by_id($k);
                
                if($pro->price > $pro->sale_price && $pro->sale_price > 0){
                    $pro->price = $pro->sale_price;
                }
                
                $total += $pro->price * $v;
                
                $str  = '<tr id="cart_'.$k.'">';
                $str .= '   <td><a href ="'.$pro->alias.'.html'.'">'.$pro->title.'</a></td>
                            <td>'.$v.'</td>
                            <td>'.number_format($pro->price * $v).' VNĐ</td>
                            <td><span class="delete_cart_item" rel ="cart_'.$k.'">Remove</a></td>';
                $str .= '</tr>';
                
                echo $str;
            }
            echo '<tr><td colspan="4" class="text-right">'.number_format($total).' VNĐ</td></tr>';
        } else {
                echo '<tr><td colspan="4" class="text-center">Chưa có sản phẩm nào trong giỏ.</td></tr>';
            }
        echo '<tr><td colspan="4"><a href="shop" class="btn btn-info">Continue To Shop</a></td></tr>';
        echo '</table>';
    }
    
    public function ajax_del_item($id = null){
        if(is_numeric($id)) {
            $cart = $this->session->userdata('cart');
            
            if(isset($cart[$id])){
                unset($cart[$id]);
                
                $this->session->set_userdata(array('cart' => $cart));
            }
            
            echo '<table class="table table-bordered">';
            echo '<tr><th>Tên Sản Phẩm</th><th>Số lượng</th><th>Thành Tiền</th><th>Action</th></tr>';
            if(count($cart) > 0 && is_array($cart)){
                $total = 0;
                
                foreach($cart as $k => $v){
                    $pro = get_product_by_id($k);
                    
                    if($pro->price > $pro->sale_price && $pro->sale_price > 0){
                        $pro->price = $pro->sale_price;
                    }
                    
                    $total += $pro->price * $v;
                    
                    $str  = '<tr id="cart_'.$k.'">';
                    $str .= '   <td>'.$pro->title.'</td>
                                <td>'.$v.'</td>
                                <td>'.number_format($pro->price * $v).' VNĐ</td>
                                <td><span class="delete_cart_item" rel ="cart_'.$k.'">Remove</a></td>';
                    $str .= '</tr>';
                    
                    echo $str;
                }
                echo '<tr><td colspan="4" class="text-right">'.number_format($total).' VNĐ</td></tr>';
            } else {
                echo '<tr><td colspan="4" class="text-center">Chưa có sản phẩm nào trong giỏ.</td></tr>';
            }
            echo '<tr><td colspan="4"><a href="shop" class="btn btn-info">Continue To Shop</a></td></tr>';
            echo '</table>';
        }
    }
}