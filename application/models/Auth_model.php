<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {
    public function auth($email, $password) {
        if ($query = $this->db->query("SELECT id, password, name, surname FROM users WHERE email = ?", array($email))) {
            if ($query->num_rows() === 1 && crypt($password, $query->row()->password) === $query->row()->password) {
                return $query->row();
            }
        }
        return 0;
    }

    public function register($email, $password, $name = NULL, $surname = NULL) {
        if ($query = $this->db->query("INSERT INTO users VALUES(NULL, ?, ?, ?, ?, ?, ?)", array($email, $name, $surname, crypt($password), time(), time()))) {
            if ($this->db->affected_rows() === 1) return true;
        }
        return false;
    }

    public function update($email, $password, $name = NULL, $surname = NULL) {
        if($id = auth($email, $password)) {
            if ($query = $this->db->query("UPDATE users SET name=?, surname=? WHERE id=?", array($name, $surname, $id))) {
                if ($this->db->affected_rows() === 1) return true;
            }
        }
        return false;      
    }
}

?>