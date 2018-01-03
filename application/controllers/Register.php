<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function index() {
        $this->load->view('partial/header');
        $this->load->view('register');
        $this->load->view('partial/footer');
	}
}
