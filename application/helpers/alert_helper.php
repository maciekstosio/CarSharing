<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
BUDOWA ERRORÓW

ID_KONTROLERA.ID_BŁĘU

*/

if ( ! function_exists('get_alert_message'))
{
	function get_alert_message()
	{	
		$CI =& get_instance();
		if($code = $CI->session->flashdata('alert_message')){
			return $code;
		}else{
			return false;
		}
	}
}

if ( ! function_exists('get_alert_type'))
{
	function get_alert_type()
	{		
		$CI =& get_instance();
		if($type = $CI->session->flashdata('alert_type')){
			return $type;
		}else{
			return false;
		}
	}
}

if ( ! function_exists('isset_alert'))
{
	function isset_alert()
	{		
		if(get_alert_type() AND get_alert_message()){
			return true;
		}else{
			return false;
		}
	}
}

if ( ! function_exists('error'))
{
	function error($message)
	{
		$CI =& get_instance();
		$CI -> session->set_flashdata('alert_type', 'danger');
		$CI -> session->set_flashdata('alert_message', $message);
	}
}

if ( ! function_exists('information'))
{
	function information($message)
	{
		$CI =& get_instance();
		$CI -> session->set_flashdata('alert_type', 'warning');
		$CI -> session->set_flashdata('alert_message', $message);
	}
}

if ( ! function_exists('success'))
{
	function success($message)
	{
		$CI =& get_instance();
		$CI -> session->set_flashdata('alert_type', 'success');
		$CI -> session->set_flashdata('alert_message', $message);
	}
}
