<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaign extends CI_Controller {
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
            $crud->set_table('campaign');
            $crud->display_as('variant_id', 'Variant');
            $crud->required_fields('name','start_date','end_date','variant_id');//,'budget'
            $crud->add_fields('variant_id','name','start_date','end_date','budget');
            $crud->edit_fields('variant_id','name','start_date','end_date','budget');
            $crud->columns('variant_id','name','start_date','end_date','budget');
            $crud->set_subject('Campaign');
            $crud->set_relation('variant_id', 'variant', 'name');
            //$crud->set_relation('brand_id', 'brand', 'name');
            
            $crud->unset_print();
            $crud->display_as('name', 'Campaign Name');
            
            $crud->callback_column('campaign.name', array($this,'_callback_name'));
            
            $crud->add_action('Add payment', '', '', 'ui-icon-image', array($this, 'addPayment'));
            
            $output = $crud->render();

            $this->load->view('welcome_message', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            $this->load->view('welcome_message', (object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
        }
    }
    
    public function _callback_name($value, $row) {
        return "<a href='".site_url('Banner/index/add?campaignId='.$row->id)."'>$value</a>";
    }
    
    function addPayment($id, $row){
        return site_url('Payment/index/add?campaignId=').$id;
    }

}