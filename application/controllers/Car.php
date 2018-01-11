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
        $this->load->model('Car_model');
        $data['brand']=$this->Car_model->get_possible_brands();
        $this->load->view('partial/header');
        $this->load->view('car_form',$data);
        $this->load->view('partial/footer');
    }

    public function add_car() {
        if (!logged_id()) redirect("user");
        echo '<pre>';
        var_dump($this -> input -> post());
        $parsed_calendar=$this->parse_calendar($this -> input -> post());
        if($parsed_calendar!=0){
            $this->parse_from_json($parsed_calendar);
        }else{
                                        //uzupelnic
        }
        echo '</pre>';
    }

    private function parse_calendar($input){
        $input=$input['calendar'];
        $len=strlen($input);

        if($len==0){
            return 0;
        }else{
            $input=substr($input,11,$len-13);
            $parsed_array=explode("},",$input);

            foreach($parsed_array as $key => $string){
                if(strcmp(substr($string,-1),"}")!=0){
                    $parsed_array[$key]= $string . "}";
                }
            }
        }
        return($parsed_array);
    }

    private function parse_from_json($parsed_calendar){
        $parsed = array();
        $this->load->model('Car_model');
        foreach($parsed_calendar as $a){
            $parsed[] = (json_decode($a,1));
        }
        if($this->Car_model->insert_new_availabilities($parsed)){
            echo "ok";
        }else{
            echo "not ok";
        }
    
    }
}
