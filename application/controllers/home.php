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
        $data['configuration'] = $this->configs;
        $data['active_nav'] = 'nav_home';

        //Slider Data
        $data['slideData']             = $this->Mslide->All(5);

        //Featured Products.
        $data['featured_products'] = $this->db->where('publish', 1)->where('is_featured', 1)->order_by('rand()')->limit(10)->get('products')->result_object();

        
        //View
        $data['tpl']                = 'frontend/home/home';
        if($this->configs->is_active){
            $this->load->view('frontend/layout/1-column', $data);
        }else{
            $this->load->view('frontend/home/maintain', $data);
        }
    }
}