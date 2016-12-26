<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
    function redirect_if_not_logged_in()
    {
		
		$CI = &get_instance();
		$pid = $CI->session->userdata('is_logged_in');
		
		if($pid != true)
		{
			redirect('login');
		}
    }
    function redirect_if_logged_in()
    {
		
		$CI = &get_instance();
		$pid = $CI->session->userdata('is_logged_in');
		
		if($pid == true)
		{
			redirect('welcome');
		}
    }
    
    function redirect_if_not_admin() {
        $user_role = get_user_role();
        if($user_role !== 'admin') {
            redirect('welcome');
        }
    }
    
    function redirect_if_not_user() {
        $user_role = get_user_role();
        if($user_role !== 'admin' && $user_role !== 'user') {
            redirect('welcome');
        }
    }
    
    function my_is_null($test) {
        return $test == NULL;
    }
    
    function my_isset($variable) {
        if(!isset($variable)) {
            return false;
        }
        if($variable === NULL){
            return false;
        }
        if($variable == "") { 
            return false;
        }
        return true;
    }
    function my_int_sane($variable) {
        if (my_isset($variable)) {
            return $variable;
        } else {
            return "0";
        }
    }
    
    function is_user() {
        $user_role = get_user_role();
        if($user_role !== 'admin' && $user_role !== 'user') {
            return false;
        }
        return true;
    }
    
    function get_username() {
        $CI = &get_instance();
        return $CI->session->userdata('username');
    }
    
    function get_user_role() {
        $CI = &get_instance();
        return $CI->session->userdata('user_role');
    }
    
    function get_user_id() {
        $CI = &get_instance();
        return $CI->session->userdata('user_id');
    }


    function is_logged_in()
    {
    	$CI = &get_instance();
        $pid = $CI->session->userdata('is_logged_in');
        return $pid;	
	}
    function get_priviledge_level()
    {
    	$CI = &get_instance();
        return $CI->session->userdata('priviledge');
    }
    
    function is_admin_or_super_admin()
    {
    	if(!is_logged_in()) return false;
        $CI = &get_instance();
		$pid = $CI->session->userdata('pid');
		$pri = $CI->session->userdata('priviledge');
		if($pri=='admin' || $pri == 'superadmin') return true;
		
		else return false;
    }
}