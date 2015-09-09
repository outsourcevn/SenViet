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

        //Slider Data
        $data['slideData']             = $this->Mslide->All(5);


        $data['configuration'] = $this->configs;


        
        //View
        $data['tpl']                = 'frontend/home/home';
        if($this->configs->is_active){
            $this->load->view('frontend/layout/1-column', $data);
        }else{
            $this->load->view('frontend/home/maintain', $data);
        }
    }
}