<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Advertiser extends CI_Controller {
    public function __construct()
    {
            parent::__construct();
            $this->load->helper('auth_helper');
            redirect_if_not_logged_in();
            redirect_if_not_admin();
            //$this->load->database();
            //$this->load->helper('url');
            $this->load->library('grocery_CRUD');
    }
    public function index()
    {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('advertiser');
            $crud->set_subject('Advertiser');
            $crud->required_fields('name', 'address', 'email', 'contact_no');
            $crud->set_relation('user_id', 'user', 'username');
            $crud->display_as('user_id', 'Username');
            $crud->unique_fields('name');

            $crud->unset_print();

            // $crud->callback_column('lname',array($this,'blankFormatting'));

            $crud->display_as('contact_no', 'Contact No');
            $crud->display_as('name', 'Advertiser Name');


            /* $crud->set_primary_key('name');
              $crud->set_subject('Location');
              $crud->field_type('description', 'textarea');

              $crud->set_rules('name','Name','trim|required|max_length[50]|xss_clean|alpha_dash||callback_location_exists');
              $crud->set_rules('room_no','Room No','numeric|trim|xss_clean');
             */
            //$crud->callback_add_field('name',array($this,'add_name_callback'));
            //$crud->columns('name','type_id','make','purchase_date','lid','description');
            //$crud->set_relation('type_id','types','name');
            //$crud->set_relation('lid','location','name');
            
            $crud->add_action('Add brand', '', '', 'ui-icon-image', array($this, 'addBrand'));
            
            $output = $crud->render();

            $this->load->view('welcome_message', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            $this->load->view('welcome_message', (object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
        }
    }
    
    function addBrand($id, $row){
        return site_url('Brand/index/add?advertiserId=').$id;
    }

}