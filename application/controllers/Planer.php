<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Planer extends CI_Controller {

    public function index() {
        if(!logged_id()) redirect();


        $this->load->model('Planer_model');
        $data=$this->Planer_model->get_plans(logged_id());
    
        $result=$this->parse_it($data);
    
        //var_dump($result);
        
        $this->load->view('partial/header');
        $this->load->view('planer',$result);
        $this->load->view('partial/footer');
        
                 
    }

    private function parse_it($data){
        $my=array_fill_keys(array('id','start','end','title'),'');
        $god= array();
        foreach($data as  $row ){
            $my['id'] ="1";
            $my['start']=$row->date."T".$row->start.":00.000Z";
            $my['end']=$row->date."T".$row->end.":00.000Z";
            $my['title']="noice";
            $god[]=$my;
        }
        return $this->parse_to_json($god);

    }

    private function parse_to_json($data){

        $moj_string="";
        foreach($data as $little){
            $moj_string.=json_encode($little).",";
        }
        $moj_string=substr($moj_string,0,-1);
        $moj_string="{\"events\":[".$moj_string."]}";

        $array=['calendar'=>$moj_string];
        return $array;
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
