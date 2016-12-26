<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dump extends CI_Controller {
    public function __construct()
    {
            parent::__construct();
            $this->load->helper('auth_helper');
            redirect_if_not_logged_in();
            redirect_if_not_user();
    }
    
    public function index() {
        $this->load->model("reporthelper");
        $this->reporthelper->getDumpData();
    }

}