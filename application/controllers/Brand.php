<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brand extends CI_Controller {
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
            $crud->set_table('brand');
            $crud->required_fields('name', 'advertiser_id');
            $crud->columns('advertiser_id', 'name');
            $crud->add_fields('advertiser_id', 'name');
            $crud->edit_fields('advertiser_id', 'name');
            $crud->display_as('advertiser_id', 'Advertiser');
            $crud->set_subject('Brand');
            $crud->set_relation('advertiser_id', 'advertiser', 'name');
            
            
            $crud->display_as('name', 'Brand Name');
            
            $crud->unset_print();
            
            $crud->add_action('Add variant', '', '', 'ui-icon-image', array($this, 'addVariant'));
            
            $output = $crud->render();

            $this->load->view('welcome_message', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            $this->load->view('welcome_message', (object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
        }
    }
    
    function addVariant($id, $row){
        return site_url('Variant/index/add?brandId=').$id;
    }

}