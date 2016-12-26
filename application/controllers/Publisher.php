<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Publisher extends CI_Controller {
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
            $crud->set_table('publisher');
            $crud->set_subject('Publisher');
            $crud->required_fields('name', 'address', 'email', 'contact_no');
            $crud->unique_fields('name');

            $crud->unset_print();

            $crud->display_as('contact_no', 'Contact No');
            $crud->display_as('name', 'Publisher Name');
            
            $crud->add_action('Add placement', '', '', 'ui-icon-image', array($this, 'addPlacement'));
            
            $output = $crud->render();

            $this->load->view('welcome_message', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            $this->load->view('welcome_message', (object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
        }
    }
    
    function addPlacement($id, $row){
        return site_url('Placement/index/add?publisherId=').$id;
    }

}