<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Planer_model extends CI_Model {
   

    public function insert_new_plan($parsed,$user){

        $this->db->query("START TRANSACTION");

         foreach($parsed as $key => $big){
    
            $date = substr($big['end'],0,10);
            $start = substr($big['start'],11,5);
            $end = substr($big['end'],11,5);
               
            if(!$query = $this->db->query("INSERT INTO plans VALUES( ?, ?, ?, ?)", array($user,$date, $start, $end))){
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