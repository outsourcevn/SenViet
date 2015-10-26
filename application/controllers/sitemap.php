<?php
class Sitemap extends CI_Controller{
    var $configs = null;

    public function __construct(){
        parent::__construct();

        $this->load->model('frontend/model_configs', 'Mconfigs');
        $this->configs = $this->Mconfigs->get_Configs();
    }

    public function index()
    {

        //Configs
        $data['configuration'] = $this->configs;



        //View
        $data['tpl']                = 'frontend/home/sitemap';
        if($this->configs->is_active){
            $this->load->view('frontend/layout/1-column', $data);
        }else{
            $this->load->view('frontend/home/maintain', $data);
        }
    }
}