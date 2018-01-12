<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index() {
                if (!logged_id()) redirect("user");
                
                $this->load->model("car_model");
                $this->load->model('request_model');
              
                $data = array(
                    "my_cars" => $this->car_model->get_user_cars(logged_id()),
                    "sent_requests" => $this->request_model->get_sent_requests(logged_id()),
                    "recived_requests" => $this->request_model->get_recived_requests(logged_id()),
                );

                $this->load->view('partial/header');
                $this->load->view('dashboard', $data);
                $this->load->view('partial/footer');
	}
}
