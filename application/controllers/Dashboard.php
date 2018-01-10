<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index() {
                if (!logged_id()) redirect("user");
                $this->load->view('partial/header');
                $this->load->view('dashboard');
                $this->load->view('partial/footer');
	}
}
