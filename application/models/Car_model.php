<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Car_model extends CI_Model {
    public function get_possible_brands() {
        if ($query = $this->db->query("SELECT DISTINCT name FROM brands")) {
            if ($query->num_rows() >0) {
                return $query->result();
            }else {
                return 0;
            }
        }
        return 0;
    }

    public function insert_new_car($plates,$price,$user){
        $model="1";
        $year = "2012";
        $latidude = "0";
        $attitude = "0";
        if(!$query = $this->db->query("INSERT INTO cars VALUES(?, ?, ?, ?, ?, ?, ?)", array($user,$plates,$model, $year, $latidude,$attitude, $price))){
            return 0;
        }else{
            return 1;
        }

    }

    public function insert_new_availabilities($parsed,$plates){

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

    public function get_user_cars($uid) {
        $query = $this ->db-> query('SELECT license_plate, price, user, CONCAT(brands.name, " ", models.name) as type, (SELECT AVG(active) FROM availability WHERE car=license_plate) as active, (SELECT COUNT(active) FROM availability WHERE car=license_plate) as availability_count
                                        FROM `cars`
                                        LEFT JOIN models ON cars.model = models.id 
                                        LEFT JOIN brands ON models.brand = brands.id WHERE user=?', array($uid));
        

        if($query) {
            return $query->result();
        }
        return 0;
    } 

    public function get_car_with_availability($plates) {
        $query1 = $this->db->query('SELECT * FROM `cars` WHERE license_plate=?', array($plates));
        $query2 = $this->db->query('SELECT * FROM `availability` WHERE car=?', array($plates));

        // echo '<pre>';
        // var_dump($query2);
        // echo '</pre>';

        if($query1 && $query1->row() && $query2) {
            return array(
                "details" => $query1->row(),
                "availability" => $query2->result()
            );
        }

        return 0;
    } 

    public function get_car($plates) {
        $query1 = $this->db->query('SELECT * FROM `cars` WHERE license_plate=?', array($plates));

        if($query1 && $query1->row()) {
            return $query1->row();
        }

        return 0;
    } 

    public function activate($plates) {
        if ($this->db->query("UPDATE `availability` SET active=1 WHERE car=?", array($plates))) {
            if ($this->db->affected_rows() > 0) {
                return 1;
            }
        }
        return 0;
    }

    public function deactivate($plates) {
        if ($this->db->query("UPDATE `availability` SET active=0 WHERE car=?", array($plates))) {
            if ($this->db->affected_rows() > 0) {
                return 1;
            }
        }
        return 0;
    }
/*
    public function get_cal_availabilities($user){
        if ($this->db->query("SELECT `date`,`start`,`end` FROM `availabilities` WHERE user=?", array($user))) {
    }
*/
}

?>