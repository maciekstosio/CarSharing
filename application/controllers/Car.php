<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Car extends CI_Controller {
	public function index() {
        if (!logged_id()) redirect("user");
        $this->load->view('partial/header');
        $this->load->view('partial/footer');
    }
    
    public function add() {
        if (!logged_id()) redirect("user");
        $this->load->view('partial/header');
        $this->load->view('car_form');
        $this->load->view('partial/footer');
    }
}
