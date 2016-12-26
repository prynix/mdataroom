<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {
    private $count = 0;
    private $result = null;
    private $errors = "";
    public function __construct()
    {
            parent::__construct();
            $this->load->helper('auth_helper');
            redirect_if_not_logged_in();
            $this->load->library('grocery_CRUD');
    }
    
    public function getAdvertiserList() {
        $user_id = get_user_id();
        $this->load->model("ReportHelper");
        if(is_user()){
            $advertiserList = $this->ReportHelper->getAdvertiserByUserId(null);
        } else {
            $advertiserList = $this->ReportHelper->getAdvertiserByUserId($user_id);
        }
        return $advertiserList;
    }
    
    public function getChildNameList($fk_name, $table_name) {
        $advertiser_id = $this->input->post($fk_name);
        $this->load->model("ReportHelper");
        if(my_isset($advertiser_id)){
            $brandList = $this->ReportHelper->getChildNamesByParentId($advertiser_id, $fk_name, $table_name);
        } else {
            $brandList = array();
        }
        return $brandList;
    }
    
    public function getErrors(){
        if(my_isset($this->errors)){
            return $this->errors."<br />";
        } else {
            return "";
        }
    }
    
    public function getChildList() {
        $parent_id = $this->input->post('parent_id');
        $fk_name = $this->input->post("fk_name");
        $table_name = $this->input->post("table_name");
        if(!my_is_null($parent_id) && !my_is_null($fk_name) && !my_is_null($table_name)) {
            $this->load->model("ReportHelper");
            $childList = $this->ReportHelper->getChildByParentId($parent_id, $fk_name, $table_name);
        } else {
            $childList = array();
        }
        header('Content-Type: application/json');
        echo json_encode($childList);
    }

    public function index()
    {
        try {
            $crud = new grocery_CRUD();
            //$crud->set_theme('flexigrid');
            $crud->set_theme('datatables');
            $crud->set_table('banner_placement');
            
            $advertiser_id = $this->input->post('advertiser_id');
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $validInput = true;
            
            if((my_isset($this->input->post('mysubmit')) || my_isset($this->input->post("print")) || my_isset($this->input->post('dump'))) && (!my_isset($advertiser_id) || !my_isset($start_date) || !my_isset($end_date))) {
                $validInput = false;
                $crud->where('banner_placement.id', -1);
                $this->errors = "Set Advertiser Name, Start and stop date range";
            } else {
                $validInput = true;
                //print_r($this->input->post());
                $this->errors = "";
                $user_id = get_user_id();
                $this->load->model("ReportHelper");
                if(is_user()){
                    $bannerList = $this->ReportHelper->getSelectedBanners(null);
                } else {
                    $bannerList = $this->ReportHelper->getSelectedBanners($user_id);
                }
                
                if (my_isset($this->input->post('dump'))) {
                    $this->session->set_flashdata('bannerList', $bannerList);
                    $this->session->set_flashdata('start_date', $start_date);
                    $this->session->set_flashdata('end_date', $end_date);
                    redirect('dump');
                }
                $this->db->where_in('banner_id', $bannerList);
            }
            //$crud->columns('SL.', 'Publisher', 'Position', 'Size', 'Request', 'Impression', 'Clicks', 'CTR', 'Display CPM', 'Display CPC',  'Ad Server CPM', 'Ad Server CPC', 'Display Budget', 'Ad Server Cost', 'Total Cost');
            $crud->columns('SL.', 'publisher', 'placement_id', 'banner_id', 'Size', 'request', 'impression', 'click', 'CTR', 'Display_CPM', 'Display_CPC',  'Ad_Server_CPM', 'Ad_Server_CPC', 'Display_Budget', 'Ad_Server_Cost', 'Total_Cost');
            $crud->set_relation('placement_id', 'placement', 'name');
            $crud->set_relation('banner_id', 'banner', 'caption');
            $crud->display_as('banner_id', 'Banner');
            $crud->display_as('placement_id', 'Placement');
            $crud->set_subject('Report');
            $crud->order_by('banner_placement.id');
            $crud->callback_column('publisher',array($this,'_callback_publisher'));
            $crud->callback_column('SL.',array($this,'_callback_SL'));
            $crud->callback_column('Size',array($this,'_callback_size'));
            $crud->callback_column('request',array($this,'_callback_request'));
            $crud->callback_column('impression',array($this,'_callback_impression'));
            $crud->callback_column('click',array($this,'_callback_click'));
            $crud->callback_column('CTR',array($this,'_callback_ctr'));
            $crud->callback_column('Display_CPM',array($this,'_callback_display_cpm'));
            $crud->callback_column('Display_CPC',array($this,'_callback_display_cpc'));
            $crud->callback_column('Ad_Server_CPM',array($this,'_callback_adserver_cpm'));
            $crud->callback_column('Ad_Server_CPC',array($this,'_callback_adserver_cpc'));
            $crud->callback_column('Display_Budget',array($this,'_callback_display_budget'));
            $crud->callback_column('Ad_Server_Cost',array($this,'_callback_ad_server_cost'));
            $crud->callback_column('Total_Cost',array($this,'_callback_total_cost'));
            //$crud->callback_column(,array($this,'_callback_'));
            //$crud->set_relation('brand_id', 'brand', 'name');

            $crud->unset_read();
            $crud->unset_add();
            $crud->unset_edit();
            $crud->unset_delete();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();
            if(my_isset($this->input->post("print")) && $validInput)
            {
                $crud->unset_export();
                //$crud->unset_print();
                //$crud->unset_search();
                $output = $crud->render();
                $this->load->view('report_print_view', $output); 
            } else {
                $crud->unset_print();
                $output = $crud->render();
                $this->load->view('report_view', $output);
            }
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            $this->load->view('welcome_message', (object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
        }
    }
    
    public function _callback_publisher($value, $row) {
        $this->load->model('Placement');
        $publisher_id = $this->Placement->getPublisherId($row->placement_id);
        $this->load->model('Publisher');
        $name = $this->Publisher->getPublisherName($publisher_id);
        return "$name";
    }
    
    public function _callback_SL($value, $row) {
        $this->count =$this->count + 1;
        //$this->result = null;
        return "$this->count";
    }
    
    public function _callback_size($value, $row) {
        $this->load->model('Placement');
        $size = $this->Placement->getSize($row->placement_id);
        return "$size";
    }
    
    public function _callback_request($value, $row) {
        if(isset($row->result)){
            return my_int_sane($row->result->request);
        } else {
            $this->load->model('AdReportSummary');
            $result = $this->AdReportSummary->getRequestCountByBannerPlacement($row->banner_id, $row->placement_id);
            $row->result = $result;
            return my_int_sane($result->request);
        }
    }
    
    public function _callback_impression($value, $row) {
        if(isset($row->result)){
            return my_int_sane($row->result->impression);
        } else {
            $this->load->model('AdReportSummary');
            $result = $this->AdReportSummary->getRequestCountByBannerPlacement($row->banner_id, $row->placement_id);
            $row->result = $result;
            return my_int_sane($result->impression);
        }
    }
    
    public function _callback_click($value, $row) {
        if(isset($row->result)){
            return my_int_sane($row->result->click);
        } else {
            $this->load->model('AdReportSummary');
            $result = $this->AdReportSummary->getRequestCountByBannerPlacement($row->banner_id, $row->placement_id);
            $row->result = $result;
            return my_int_sane($result->click);
        }
    }
    
    public function _callback_ctr($value, $row) {//number_format( $percent * 100, 2 ) . '%'
        if($row->result->impression == 0) {
                        return "-";
        }
        $percent = $row->result->click / $row->result->impression;
        return number_format( $percent * 100, 2 ) . '%';
    }
    
    public function _callback_display_cpm($value, $row) {
        if($row->ad_publishing_cost_method == "CPM") {
            return "$row->per_unit_ad_publishing_cost";
        } else {
            return "-";
        }
    }
    
    public function _callback_display_cpc($value, $row) {
        if($row->ad_publishing_cost_method == "CPC") {
            return "$row->per_unit_ad_publishing_cost";
        } else {
            return "-";
        }
    }
    
    public function _callback_adserver_cpm($value, $row) {
        if($row->ad_serving_cost_method == "CPM") {
            return "$row->per_unit_ad_serving_cost";
        } else {
            return "-";
        }
    }
    
    public function _callback_adserver_cpc($value, $row) {
        if($row->ad_serving_cost_method == "CPC") {
            return "$row->per_unit_ad_serving_cost";
        } else {
            return "-";
        }
    }
    
    public function _callback_display_budget($value, $row) {
        if($row->ad_publishing_cost_method == "CPM") {
            $cost = ($row->per_unit_ad_publishing_cost * $row->result->impression) / 1000;
        } else {
            $cost = $row->per_unit_ad_publishing_cost * $row->result->click;
        }
        $row->display_cost = $cost;
        return number_format( $cost, 2 ) ;
    }
    
    public function _callback_ad_server_cost($value, $row) {
        if($row->ad_serving_cost_method == "CPM") {
            $cost = ($row->per_unit_ad_serving_cost * $row->result->impression) / 1000;
        } else {
            $cost = $row->per_unit_ad_serving_cost * $row->result->click;
        }
        $row->adserver_cost = $cost;
        return number_format( $cost, 2 ) ;
    }
    
    public function _callback_total_cost($value, $row) {
        $cost = $row->display_cost + $row->adserver_cost;
        return number_format( $cost, 2 ) ;
    }
    
    /*public function _callback_($value, $row) {
        return "$row->placement_id";
    }*/

}