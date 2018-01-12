<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matcher extends CI_Controller {
	public function index() {
            if (!logged_id()) redirect("user");
            $this->load->model('matcher_model');

            $data = array(
                "matches" => $this->matcher_model->get_matches_for_user(logged_id())
            );
            

            $this->load->view('partial/header');
            $this->load->view('matcher', $data);
            $this->load->view('partial/footer');
	}
}
