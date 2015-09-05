<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    var $auth;
    
    public function __construct(){
        parent::__construct();
        $this->authen->check_login();
        $this->auth = $this->session->userdata('session_login');
        $this->authen->check_permission($this->router->fetch_class().'/'.$this->router->fetch_method());
    }
    
	public function index()
	{
        $data['auth'] = $this->auth;
        
        $data['tpl'] = 'backend/user/home';
		$this->load->view('backend/layout/home', $data);
	}
}