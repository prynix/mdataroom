<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Variant extends CI_Controller {
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
            $crud->set_table('variant');
            $crud->required_fields('name', 'brand_id');
            $crud->columns('brand_id', 'name');
            $crud->add_fields('brand_id', 'name');
            $crud->edit_fields('brand_id', 'name');
            $crud->display_as('brand_id', 'Brand');
            $crud->set_subject('Variant');
            $crud->set_relation('brand_id', 'brand', 'name');
            
            
            $crud->display_as('name', 'Variant Name');
            
            $crud->unset_print();
            
            $crud->add_action('Add campaign', '', '', 'ui-icon-image', array($this, 'addCampaign'));
            
            $output = $crud->render();

            $this->load->view('welcome_message', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            $this->load->view('welcome_message', (object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
        }
    }
    
    function addCampaign($id, $row){
        return site_url('Campaign/index/add?variantId=').$id;
    }

}