<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Mymail {
    
    var $CI;
    
    public function __construct(){
        $this->CI =& get_instance();
    }
    
    public function send_mail($from = 'minhducck@gmail.com', $to, $subject, $content){
        
        //Config
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'minhducck@gmail.com',
            'smtp_pass' => 'ghltknaswmjcgpzf',
            'mailtype'  => 'html', 
            'charset'   => 'utf-8'
        );
        $this->CI->load->library('email', $config);
        $this->CI->email->set_newline("\r\n");
        
        
        $this->CI->email->from($from, 'Email from '.CMS_BASE_URL);
        $this->CI->email->to($to);
        $this->CI->email->subject($subject);
        $this->CI->email->message($content);
        $this->CI->email->send();
        echo $this->CI->email->print_debugger();
    }
}