<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function index() {
                if(logged_id()) redirect();

                $this->load->view('partial/header');
                $this->load->view('login');
                $this->load->view('partial/footer');
        }

        public function join() {
                if(logged_id()) redirect();

                $this->load->view('partial/header');
                $this->load->view('register');
                $this->load->view('partial/footer');
        }

        public function auth() {
                if(logged_id()) redirect();

                $this->load->model("auth_model");

                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $row = $this->auth_model->auth($email, $password);

                if($row->id) {
                        login($row->id, $email, $row->name, $row->surname);
                        success("Zalogowano");
                } else {
                        error("Przepraszamy wystapił błąd");
                }

                redirect($_SERVER['HTTP_REFERER']);
        }

        public function register() {
                if(logged_id()) redirect();
                $this->load->model("auth_model");

                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $name = $this->input->post('name');
                $surname = $this->input->post('surname');

                if ($this->auth_model->register($email, $password, $name, $surname)) {
                        success("Zarejestrowano");
                } else {
                        error("Przepraszamy wystapił błąd");
                }

                redirect($_SERVER['HTTP_REFERER']);
        }

        public function planer() {
                if(!logged_id()) redirect();

                $this->load->view('partial/header');
                $this->load->view('planer');
                $this->load->view('partial/footer');             
        }

        public function add_planes() {
                if (!logged_id()) redirect("user");
                echo '<pre>';
                var_dump($this -> input -> post());
                echo '</pre>';       
        }

        public function logout() {
                logout();
                redirect( $_SERVER['HTTP_REFERER']);
        }
}
