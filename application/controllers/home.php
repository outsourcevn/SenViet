<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    
    var $configs = null;
    
    public function __construct(){
        parent::__construct();
        
        $this->load->model('frontend/model_category', 'Mcategory');
        $this->load->model('frontend/model_products', 'Mproduct');
        $this->load->model('frontend/model_slide', 'Mslide');
        $this->load->model('frontend/model_configs', 'Mconfigs');
        $this->configs = $this->Mconfigs->get_Configs();
    }
    
    public function index()
    {
        
        //Configs
        $data['configs'] = $this->configs;
        
        //Flash Message
        $data['showed_flash_message']   = $this->session->userdata('showed_flash');
        $data['flas_message']           = $data['configs']->flash_message;
        $this->session->set_userdata(array('showed_flash' => 1));
        
        //Category List
        $data['category_list']          = $this->Mcategory->All(2);
        
        //Slider Data
        $data['slide_list']             = $this->Mslide->All(5);
        
        //BreadCrumb
        $data['breadcrumb']             = array('Home' => CMS_BASE_URL);
        
        //Featured Products Data
        $data['featured_product_list']  = $this->Mproduct->SelectFeaturedProducts();
        
        //Hotest Products Data
        $data['hotest_product_list']    = $this->Mproduct->SelectHotestProducts();
        
        //Lastest Products Data
        $data['lastest_product_list']   = $this->Mproduct->SelectLastestProducts();
        
        
        //SEO
        $data['seo']['title']           = (isset($this->configs->meta_title) ? $this->configs->meta_title : 'Shop Online');
        
        //View
        $data['tpl']                = 'frontend/home/home';
        if($this->configs->is_active){
            $this->load->view('frontend/layout/1-column', $data);
        }else{
            $this->load->view('frontend/home/maintain', $data);
        }
    }
}