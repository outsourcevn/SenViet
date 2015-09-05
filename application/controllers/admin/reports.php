<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {
    var $auth;
    
    public function __construct(){
        parent::__construct();
        $this->authen->check_login();
        $this->auth = $this->session->userdata('session_login');
        $this->authen->check_permission($this->router->fetch_class().'/'.$this->router->fetch_method());
        
        
        $this->load->model('backend/model_reports', 'Mreports');
    }
    
	public function index($page = 0)
	{
        $date_form      = $this->input->get('date_from');
        $date_to        = $this->input->get('date_to');
        //Main Data
        $data['best_selling']   = $this->Mreports->getBestSelling($date_form, $date_to);
        $data['best_revenues']  = $this->Mreports->getBestRevenues($date_form, $date_to);
		//Data to transport
        //$data['input_data']= ;
        $data['auth'] = $this->auth;
        $data['tpl'] = 'backend/reports/home';
		$this->load->view('backend/layout/home', $data);
	}
}