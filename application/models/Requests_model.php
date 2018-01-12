<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requests_model extends CI_Model {
   

    public function insert_new_requests($parsed,$plates){

        $this->db->query("START TRANSACTION");

         foreach($parsed as $key => $big){
             
            if(strcmp($big['title'],"Available")==0){
                 $active = "1";
            }else{
                 $active = "0";
            }
            $date = substr($big['end'],0,10);
            $start = substr($big['start'],11,5);
            $end = substr($big['end'],11,5);
               
            if(!$query = $this->db->query("INSERT INTO availability VALUES(NULL, ?, ?, ?, ?, ?)", array($plates,$date, $start, $end, $active))){
                $error = $this->db->error();
                $this->db->query("ROLLBACK");
                return 0;
            }
        }

        $this->db->query("COMMIT");
        return 1;

    }

}

?>