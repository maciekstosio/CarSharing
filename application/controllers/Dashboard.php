<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index() {
                if (!logged_id()) redirect("user");
                
                $this->load->model("Car_model");
              
                $data = array(
                    "my_cars" => $this->Car_model->get_user_cars(logged_id())
                );

                $this->load->view('partial/header');
                $this->load->view('dashboard', $data);
                $this->load->view('partial/footer');
	}
}
