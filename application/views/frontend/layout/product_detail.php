<?php

$this->load->view('frontend/layout/header', (isset($data)) ? $data : null);

$this->load->view('frontend/layout/breadcrumb', (isset($data)) ? $data : null);

if(!$showed_flash_message){
    $this->load->view('frontend/home/flash_message');
}

if(isset($tpl)){
    $this->load->view($tpl, (isset($data)) ? $data : null);
}

$this->load->view('frontend/layout/footer', (isset($data)) ? $data : null);

?>