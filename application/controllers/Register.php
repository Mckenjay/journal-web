<?php
class Register extends CI_Controller {

    public function index() {
        $this->load->view('templates/header');
        $this->load->view('register/register');
        $this->load->view('templates/footer');
    }
}