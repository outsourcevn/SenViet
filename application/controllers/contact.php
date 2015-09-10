<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

    var $configs = null;

    public function __construct(){
        parent::__construct();

        $this->load->model('frontend/model_configs', 'Mconfigs');
        $this->load->model('frontend/model_contact', 'Mcontact');
        $this->configs = $this->Mconfigs->get_Configs();
    }

    public function index()
    {

        //Configs
        $data['configuration'] = $this->configs;
        $data['active_nav'] = 'nav_contact';



        //View
        $data['tpl']                = 'frontend/contacts/home';
        if($this->configs->is_active){
            $this->load->view('frontend/layout/1-column', $data);
        }else{
            $this->load->view('frontend/home/maintain', $data);
        }
    }

    public function post(){
        if($this->input->post('cmd') === 'send'){

            $this->form_validation->set_rules('full_name', 'Họ tên', 'required|min_length[5]');

            if($this->form_validation->run()){

                $inputData = $this->input->post();

                $contactObject = $this->Mcontact->populate($inputData);
                $contactObject->save();

                $this->mycommonlib->redir_alert('Gửi tin nhắn thành công!', 'contact/');
            }else{
            }
        }
        else {
            redirect('contact');
        }
    }
}