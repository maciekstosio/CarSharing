<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Car extends CI_Controller {
    public function index() {
        if (!logged_id()) redirect("user");
        $this->load->model('Car_model');
        $data['brand']=$this->Car_model->get_possible_brands();
        $this->load->view('partial/header');
        $this->load->view('car_form', $data);
        $this->load->view('partial/footer');
    }


    public function view() {
        if (!logged_id()) redirect();
        if(!$this->uri->segment(3)) redirect();
        $this->load->model("Car_model");
        
        $temp = $this->Car_model->get_car_with_availability($this->uri->segment(3));
        if($temp['details']->user!==logged_id()) redirect();
        // echo '<pre>';
        // var_dump($temp);
        // echo '</pre>';


        //Nie działa
        $data = array(
            "details" => $temp['details'],
            "availability" => json_encode($temp['availability']),
            "brands" => $this->Car_model->get_possible_brands()
        );

        echo '<pre>';
        var_dump($data);
        echo '</pre>';

        if($temp) {
            $data['brand']=$this->Car_model->get_possible_brands();
            $this->load->view('partial/header');
            $this->load->view('car_form', $data);
            $this->load->view('partial/footer');
        } else {
            echo "ERROR";
        }
    }

    public function activate() {
        if (!logged_id()) redirect();
        if(!$this->uri->segment(3)) redirect();

        $this->load->model("Car_model");
        $car = $this->Car_model->get_car($this->uri->segment(3));

        if($car->user!==logged_id()) redirect();
        
        if($this->Car_model->activate($this->uri->segment(3))) {
            success("Car has been activated.");
        } else {
            error("Error has occurred.");
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function deactivate() {
        if (!logged_id()) redirect();
        if(!$this->uri->segment(3)) redirect();

        $this->load->model("Car_model");
        $car = $this->Car_model->get_car($this->uri->segment(3));

        if($car->user!==logged_id()) redirect();
        
        if($this->Car_model->deactivate($this->uri->segment(3))) {
            success("Car has been deactivated.");
        } else {
            error("Error has occurred.");
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function add_car() {
        if (!logged_id()) redirect();

        $this->load->model('Car_model');
        $plates = $this->input->post('plates');
        $user = logged_id();
        $price =  $this->input->post('price');

        if(!empty($plates) && !empty($price)){

            if($this->Car_model->insert_new_car($plates,$price,$user)){

                $this->load->helper('calendar_helper');
                $parsed_calendar=parse_calendar($this -> input -> post());
    
                if($parsed_calendar!=0){
                     $this->parse_from_json($parsed_calendar,$plates);
                }else{
                     error('Calendar was not set properly');
                }
                redirect( $_SERVER['HTTP_REFERER']);
    
            }else {
                error("Cannot add such car");
                redirect( $_SERVER['HTTP_REFERER']);
            }
            
        }else{
            error("Please enter car info");
            redirect( $_SERVER['HTTP_REFERER']);
        }

    }

    private function parse_from_json($parsed_calendar,$plates){
        $parsed = array();
        $this->load->model('Car_model');
        foreach($parsed_calendar as $a){
            $parsed[] = (json_decode($a,1));
        }
        if($this->Car_model->insert_new_availabilities($parsed,$plates)){
            success("New car added!");
            redirect();
        }else{
            error("Error while adding new car");
        }
    }

    public function add_request(){
        if (!logged_id()) redirect();
        $this->load->model('request_model');
        
        if($this->request_model->add_request($this->input->post('car'), logged_id(), $this->input->post('date'), $this->input->post('from'), $this->input->post('to'))) {
            success("Request has been sent.");
        } else {
            error("Failed to send request.");
        }
        redirect($_SERVER['HTTP_REFERER']);        
    }

    public function accept_request() {
        if (!logged_id()) redirect();
        if(!$this->uri->segment(3)) redirect();

        $this->load->model("request_model");
        $request = $this->request_model->get_request($this->uri->segment(3));

        if($request->user2!==logged_id()) redirect();
        
        if($this->request_model->accept_request($this->uri->segment(3))) {
            success("Request has been activated.");
        } else {
            error("Error has occurred.");
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function decline_request() {
        if (!logged_id()) redirect();
        if(!$this->uri->segment(3)) redirect();

        $this->load->model("request_model");
        $request = $this->request_model->get_request($this->uri->segment(3));

        if($request->user2!==logged_id()) redirect();
        
        if($this->request_model->decline_request($this->uri->segment(3))) {
            success("Request has been declined.");
        } else {
            error("Error has occurred.");
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function cancel_request() {
        if (!logged_id()) redirect();
        if(!$this->uri->segment(3)) redirect();

        $this->load->model("request_model");
        $request = $this->request_model->get_request($this->uri->segment(3));

        if($request->user!==logged_id()) redirect();
        
        if($this->request_model->cancel_request($this->uri->segment(3))) {
            success("Request has been canceled.");
        } else {
            error("Error has occurred.");
        }

        redirect($_SERVER['HTTP_REFERER']);
    }
}
