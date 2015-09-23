<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends CI_Controller{

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
        $data['configuration']->meta_title = 'Câu hỏi thường gặp - '.$data['configuration']->meta_title;
        $data['active_nav'] = 'nav_faq';

        $data['faq_data'] = $this->db->where('publish', 1)->get('faq')->result_object();

        //View
        $data['tpl']                = 'frontend/faq/faq';
        if($this->configs->is_active){
            $this->load->view('frontend/layout/1-column', $data);
        }else{
            $this->load->view('frontend/home/maintain', $data);
        }
    }
}