<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request_model extends CI_Model {
    public function add_request($car, $user, $date, $from, $to) {
        if ($query = $this->db->query("INSERT INTO requests VALUES(NULL, ?, ?, ?, ?, ?, ?)", array($user, $car, 1, $date, $from, $to))) {
            if ($this->db->affected_rows() === 1) return true;
        }
        return false;
    }

    public function get_request($id) {
        $query1 = $this->db->query('SELECT requests.*, cars.user user2 FROM `requests` INNER JOIN cars ON cars.license_plate=requests.car WHERE id = ?', array($id));

        if($query1 && $query1->row()) {
            return $query1->row();
        }
        return 0;
    }
    
    public function accept_request($request_id) {
        if ($this->db->query("UPDATE requests SET status=2 WHERE id=?", array($request_id))) {
            if ($this->db->affected_rows() === 1) {
                return 1;
            }
        }
        var_dump($this->db->error());
        return 0;
    }

    public function decline_request($request_id) {
        if ($this->db->query("UPDATE requests SET status=3 WHERE id=?", array($request_id))) {
            if ($this->db->affected_rows() === 1) {
                return 1;
            }
        }
        return 0;
    }

    public function cancel_request($request_id) {
        if ($this->db->query("DELETE FROM requests WHERE id = ?", array($request_id))) {
            if ($this->db->affected_rows() === 1) {
                return 1;
            }
        }
        return 0;
    }

    public function get_sent_requests($uid) {
        $query = $this->db->query('SELECT requests.*, request_states.name status_name FROM requests LEFT JOIN request_states ON requests.status = request_states.id WHERE user = ?', array($uid));

        if($query) {
            return $query->result();
        }
        return 0;        
    }

    public function get_recived_requests($uid) {
        $query = $this->db->query('SELECT requests.*, request_states.name status_name FROM requests LEFT JOIN request_states ON requests.status = request_states.id WHERE car IN (SELECT license_plate FROM cars WHERE user = ?)', array($uid));

        if($query) {
            return $query->result();
        }
        return 0;
    }
}

?>