<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BannerPlacement extends CI_Controller {
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
            $crud->set_table('banner_placement');
            $crud->order_by('banner_placement.id');
            $crud->display_as('banner_id', 'Banner');
            $crud->display_as('placement_id', 'Placement');
            $crud->display_as('device_id', 'Device');
            $crud->display_as('ad_publishing_cost_method', 'Display Cost Method');
            $crud->display_as('per_unit_ad_publishing_cost', 'Rate');
            $crud->display_as('ad_serving_cost_method', 'Ad Server Cost Method');
            $crud->display_as('per_unit_ad_serving_cost', 'Rate');
            $crud->display_as('active', 'Status');
            $crud->required_fields('placement_id','banner_id','impression_ratio', 'ad_publishing_cost_method', 'per_unit_ad_publishing_cost', 'ad_serving_cost_method', 'per_unit_ad_serving_cost');//,'start_time','end_time', 'device_id'
            $crud->columns('publisher','placement_id','banner_id', 'device_id','impression_ratio', 'ad_publishing_cost_method', 'per_unit_ad_publishing_cost', 'ad_serving_cost_method', 'per_unit_ad_serving_cost', 'active', 'action');//'start_time','end_time',
            $crud->add_fields('placement_id','banner_id', 'device_id','impression_ratio','start_time','end_time', 'ad_publishing_cost_method', 'per_unit_ad_publishing_cost', 'ad_serving_cost_method', 'per_unit_ad_serving_cost', 'active');
            $crud->edit_fields('placement_id','banner_id', 'device_id','impression_ratio','start_time','end_time', 'ad_publishing_cost_method', 'per_unit_ad_publishing_cost', 'ad_serving_cost_method', 'per_unit_ad_serving_cost', 'active');
            $crud->set_subject('Banner Placement');
            $crud->callback_column('publisher',array($this,'_callback_publisher'));
            
            $crud->set_relation('placement_id', 'placement', 'name');
            $crud->set_relation('banner_id', 'banner', 'caption');
            $crud->set_relation('device_id', 'device', 'name');
            //$crud->set_relation('brand_id', 'brand', 'name');
            
            $crud->add_action('Preview', '', '', 'ui-icon-image', array($this, 'displayPreview'));
            
            $crud->unset_print();
            
            $crud->callback_column('active', array($this,'_callback_active'));
            $crud->callback_column('action', array($this,'_callback_action'));
            
            $crud->callback_before_insert(array($this,'setTimeFormat'));
            $crud->callback_before_update(array($this,'setTimeFormat'));
            
            $output = $crud->render();
            
            
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();
            if($state == 'add' || $state == 'edit' ) {
                $this->load->view('banner_placement_view', $output);
            } else {
                $this->load->view('small_dt_view', $output);
            }
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            $this->load->view('welcome_message', (object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
        }
    }
    
    public function getPlacementInfo($placementId) {
        $this->load->model("Placement");
        $placement = $this->Placement->getAllInfo($placementId);
        if($placement == NULL) {
            return NULL;
        }
        $this->load->model("Publisher");
        $publisher_id = $this->Publisher->getPublisherName($placement->publisher_id);
        if($publisher_id == NULL){
            $placement->publisher_id = -1;
        }
        $placement->publisher_id = $publisher_id;
        return $placement;
    }
    
    public function getPlacementEncodedInfo($placementId = null) {
        if($placementId == null){
            $placementId = $this->input->post('placementId');
        }
        $this->load->model("Placement");
        $placement_info = $this->Placement->getAllInfo($placementId);
        if(isset($placement_info) && $placement_info != NULL){
            $this->load->model("Publisher");
            $placement_info->publisher_id = $this->Publisher->getPublisherName($placement_info->publisher_id);
            echo "<b>Placement Information: </b>";
            //echo "Publisher - ";
            if(isset($placement_info->publisher_id) && $placement_info->publisher_id != NULL)echo "$placement_info->publisher_id, ";
            //echo "Position - ";
            if(isset($placement_info->position) && $placement_info->position != NULL)echo "$placement_info->position, ";
            //echo "Width - ";
            if(isset($placement_info->width) && $placement_info->width != NULL)echo "$placement_info->width x ";
            //echo "Height - ";
            if(isset($placement_info->height) && $placement_info->height != NULL)echo "$placement_info->height.";
        }
    }
    
    public function getBannerInfo($bannerId) {
        $this->load->model("Banner");
        $banner = $this->Banner->getAllInfo($bannerId);
        return $banner;
    }
    
    public function getBannerEncodedInfo($bannerId=null) {
        if($bannerId == null) {
            $bannerId = $this->input->post('bannerId');
        }
        $this->load->model("Banner");
        $banner_info = $this->Banner->getAllInfo($bannerId);
        if(isset($banner_info) && $banner_info != NULL){
            echo "<b>Banner Information: </b>";
            //echo "Advertiser - ";
            echo "$banner_info->advertiser, ";
            //echo "Brand - ";
            echo "$banner_info->brand, ";
            //echo "Variant - "; 
            echo "$banner_info->variant, ";
            //echo "Campaign - ";
            echo "$banner_info->campaign, ";
            echo "Banner Type - $banner_info->type.";
            //echo "<object data=\"http://stackoverflow.com/does-not-exist.png\" type=\"image/png\"><img src=\"$banner_info->url\" /></object>";
        }
    }
    
    function setTimeFormat($post_array){
        //$post_array['start_time']=date("U",STRTOTIME($post_array['start_time']));//UNIX_TIMESTAMP
        //$post_array['start_time']='UNIX_TIMESTAMP('.$post_array['start_time'].')';
        return $post_array;
    }
    
    public function activate($id) {
        $this->load->model("BannerPlacementModel");
        $this->BannerPlacementModel->activate($id);
        redirect('BannerPlacement/index');
    }
    
    public function deactivate($id) {
        $this->load->model("BannerPlacementModel");
        $this->BannerPlacementModel->deactivate($id);
        redirect('BannerPlacement/index');
    }
    
    public function _callback_action($value, $row) {
        $this->load->model("BannerPlacementModel");
        $active = $this->BannerPlacementModel->getActive($row->id);
        if($active == 0) {
            return "<a href='".site_url('BannerPlacement/activate/'.$row->id)."'>Activate</a>";
        } else {
            return "<a href='".site_url('BannerPlacement/deactivate/'.$row->id)."'>Deactivate</a>";
        }
    }
    
    public function _callback_active($value, $row) {
        $this->load->model("BannerPlacementModel");
        $active = $this->BannerPlacementModel->getActive($row->id);
        if($active == 1) {
            return '<span style="color: green">Active</span>';
            //return "<a href='".site_url('BannerPlacement/activate/'.$row->id)."'>Activate</a>";
        } else {
            return '<span style="color: red">Off</span>';
            //return "<a href='".site_url('BannerPlacement/deactivate/'.$row->id)."'>Deactivate</a>";
        }
    }
    
    function displayPreview($id, $row){
        return site_url('ServiceController/testHTMLPreview').'/'.$row->banner_id.'/'.$row->placement_id;
    }
    
    public function _callback_publisher($value, $row) {
        $this->load->model('Placement');
        $publisher_id = $this->Placement->getPublisherId($row->placement_id);
        $this->load->model('Publisher');
        $name = $this->Publisher->getPublisherName($publisher_id);
        return "$name";
    }

}