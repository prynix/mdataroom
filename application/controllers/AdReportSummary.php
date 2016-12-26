<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdReportSummary extends CI_Controller {
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
//            $crud->set_theme('bootstrap');
            $crud->set_table('ad_report_summary');
            $crud->display_as('placement_id', 'Placement');
            $crud->display_as('banner_id', 'Banner');
            $crud->set_subject('Ad Summary Report');
            $crud->set_relation('placement_id', 'placement', 'name');
            $crud->set_relation('banner_id', 'banner', 'caption');
            //$crud->set_relation('brand_id', 'brand', 'name');
            //$crud->set_relation('placement.publisher_id', 'publisher', 'name');
            
            $crud->unset_add();
            $crud->unset_edit();
            $crud->unset_delete();
            
            $crud->display_as('click', 'Click Count');
            $crud->display_as('impression', 'Impression Count');
            
            $crud->columns('publisher','placement_id','banner_id','summary_date', 'click', 'impression');
            
            $crud->callback_column('publisher',array($this,'_callback_publisher'));
            
            $crud->unset_print();
            
            /*$state = $crud->getState();
            $state_info = $crud->getStateInfo();
            
            if($state == 'list') {
                $clickCount = $this->input->get('click');
                if (isset($clickCount) && $clickCount != null) {
                    $crud->where('click', $clickCount);
                    //$this->db->where_in('click', [1, 2, 3, 4, 5]);
                }
            }*/
            
            $output = $crud->render();

            $this->load->view('ad_report_summarry_view', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            $this->load->view('ad_report_summarry_view', (object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
        }
    }
    
    public function _callback_publisher($value, $row) {
        $this->load->model('Placement');
        $publisher_id = $this->Placement->getPublisherId($row->placement_id);
        $this->load->model('Publisher');
        $name = $this->Publisher->getPublisherName($publisher_id);
        return "$name";
    }

}