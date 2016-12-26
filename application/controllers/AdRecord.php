<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdRecord extends CI_Controller {
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
            $crud->set_table('ad_record');
            $crud->display_as('placement_id', 'Placement');
            $crud->set_subject('Ad Record');
            $crud->set_relation('placement_id', 'placement', 'name');
            //$crud->set_relation('brand_id', 'brand', 'name');
            $crud->unset_add();
            $crud->unset_edit();
            $crud->unset_delete();
            
            $crud->display_as('click_impression', 'Type');
            
            $crud->unset_print();
            
            $output = $crud->render();

            $this->load->view('welcome_message', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            $this->load->view('welcome_message', (object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
        }
    }

}