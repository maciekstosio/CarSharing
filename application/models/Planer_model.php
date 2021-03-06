<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Planer_model extends CI_Model {
   

    public function insert_new_plan($parsed,$user){
        if(!$this->delete_previous_plans($user)){
            return 0;
        }

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

    private function delete_previous_plans($user){
        $this->db->query("START TRANSACTION");

            if(!$query = $this->db->query("DELETE FROM plans WHERE user = ?", array($user))){
                $error = $this->db->error();
                $this->db->query("ROLLBACK");
                return 0;
            }

        $this->db->query("COMMIT");
        return 1;

    }

    public function get_plans($user){
        if(!$query = $this->db->query("SELECT `date`,`start`,`end` FROM plans WHERE user = ?", array($user))){
            return 0;
        }else{
            if($query->num_rows()==0){
                return 0;
            }else{
                return $query->result();
            }
        }
    }
    

}

?>