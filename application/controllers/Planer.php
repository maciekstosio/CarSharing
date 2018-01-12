<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Planer extends CI_Controller {

    public function index() {
        if(!logged_id()) redirect();

        $this->load->view('partial/header');
        $this->load->view('planer');
        $this->load->view('partial/footer');             
}

    public function my_planer() {
        if (!logged_id()) redirect("user");
    
        $this->load->view('partial/header');
        $this->load->view('planer');
        $this->load->view('partial/footer');
    }


    public function add_planes() {
        if (!logged_id()) redirect("user");
        
        $this->load->helper('calendar_helper');
        $parsed_calendar=parse_calendar($this -> input -> post());
    
        if($parsed_calendar!=0){
            $this->parse_from_json($parsed_calendar);
        }else{
            error('Calendar was not set properly');
        }
        redirect( $_SERVER['HTTP_REFERER']);

    }

    private function parse_from_json($parsed_calendar){
        $parsed = array();
        $user = logged_id();

        $this->load->model('Planer_model');
        foreach($parsed_calendar as $a){
            $parsed[] = (json_decode($a,1));
        }
        if($this->Planer_model->insert_new_plan($parsed,$user)){
            success("New plan added!");
            redirect();
        }else{
            error("Error while adding new plan");
        }
    }
}
