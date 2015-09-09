<?php

$this->load->view('frontend/layout/head');

$this->load->view('frontend/layout/header');

if(isset($tpl)) {
    $this->load->view($tpl);
}

$this->load->view('frontend/layout/footer');

?>