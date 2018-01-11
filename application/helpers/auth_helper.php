<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
*
*	@required Session library
*
*/

if ( ! function_exists('logged_id')) {
	function logged_id() {
		$CI =& get_instance();
		if ($CI->session->id !== NULL && $CI->session->email !== NULL) {
			if ($CI->session->browser !== $CI->input->user_agent()) {
				logout();
			} else return $CI->session->id;
		}	
		return false;
	}
}

if ( ! function_exists('logged_name')) {
	function logged_name() {
		$CI =& get_instance();
		$name = "NaN";
		$name = (strlen($CI->session->name) ? $CI->session->name : $CI->session->email) ;
		return $name;
	}
}

if ( ! function_exists('login')) {
	function login($id, $email, $name, $surname) {
		$CI =& get_instance();
		$CI->session->id=$id;
		$CI->session->email=$email;
		$CI->session->name = (strlen($name) ? (strlen($surname) ? $name + " " + $surname : $name) : "");
		$CI->session->browser=$CI->input->user_agent();
	}
}

if ( ! function_exists('logout')) {
	function logout() {
		$CI =& get_instance();
		$CI->session->sess_destroy(); 
	}
}