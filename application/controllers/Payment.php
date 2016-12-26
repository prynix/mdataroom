<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {
    public function __construct()
    {
            parent::__construct();
            $this->load->helper('auth_helper');
            redirect_if_not_logged_in();
            redirect_if_not_user();
            $this->load->library('grocery_CRUD');
    }
    public function index()
    {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('payment');
            $crud->display_as('campaign_id', 'Campaign');
            $crud->required_fields('amount','payment_date','campaign_id');
            $crud->add_fields('campaign_id','amount','payment_date');
            $crud->edit_fields('campaign_id','amount','payment_date');
            $crud->columns('campaign_id','amount','payment_date');
            $crud->set_subject('Payment');
            $crud->set_relation('campaign_id', 'campaign', 'name');
            //$crud->set_relation('brand_id', 'brand', 'name');
            
            $crud->unset_print();
            
            $output = $crud->render();

            $this->load->view('welcome_message', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            $this->load->view('welcome_message', (object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
        }
    }

}