<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends CI_Controller {
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
            $crud->set_table('banner');
            $crud->display_as('campaign_id', 'Campaign');
            $crud->display_as('device_id', 'Device');
            $crud->display_as('banner_type_id', 'Banner Type');
            $crud->display_as('url', 'Banner File');
            $crud->display_as('link', 'Redirect Link');
            //$this->db->order_by('id', 'desc');
            $this->load->config('grocery_crud');
            $this->config->set_item('grocery_crud_file_upload_allow_file_types',
                                                            'gif|jpeg|jpg|png|swf|zip');
            $crud->required_fields('url','caption','campaign_id', 'banner_type_id', 'link');//, 'device_id'
            $crud->columns('campaign_id','url','caption', 'banner_type_id', 'device_id', 'link');
            $crud->add_fields('campaign_id','banner_type_id', 'url','caption', 'device_id', 'link');
            $crud->edit_fields('campaign_id', 'banner_type_id','url','caption', 'device_id', 'link');
            $crud->set_subject('Banner');
            
            $crud->set_field_upload('url', '_FILES');
            $crud->callback_after_upload(array($this,'_callback_after_upload'));
            
            $crud->set_relation('campaign_id', 'campaign', 'name');
            $crud->set_relation('device_id', 'device', 'name');
            $crud->set_relation('banner_type_id', 'banner_type', 'name');
            //$crud->set_relation('brand_id', 'brand', 'name');
            
            $crud->unset_print();
            
            $crud->callback_column('caption',array($this,'_callback_caption'));
            $crud->order_by('banner.id', 'desc');
            $output = $crud->render();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();
            if($state == 'add' || $state == 'edit' ) {
                $this->load->view('banner_view', $output);
            } else {
                $this->load->view('welcome_message', $output);
            }
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            $this->load->view('welcome_message', (object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
        }
    }
    
    /*public function getBannerInfo($bannerId) {
        $this->load->model("Banner");
        $banner = $this->Banner->getAllInfo($bannerId);
        return $banner;
    }*/
    
    public function getCampaignEncodedInfo($campaign_id=null) {
        if($campaign_id == null) {
            $campaign_id = $this->input->post('campaign_id');
        }
        //echo $campaign_id;
        $this->load->model("Campaign");
        $banner_info = $this->Campaign->getAllInfo($campaign_id);
        if($banner_info != null){
            echo "<b>Campaign Information: </b>";
            echo "Advertiser - ";
            echo "$banner_info->advertiser, ";
            echo "Brand - ";
            echo "$banner_info->brand, ";
            echo "Variant - "; 
            echo "$banner_info->variant, ";
            echo "Campaign - ";
            echo "$banner_info->campaign, ";
            //print_r($banner_info);
            //echo "Banner Type - $banner_info->type.";
        }
    }
    
    public function _callback_caption($value, $row) {
        return "<a href='".site_url('BannerPlacement/index/add?bannerId='.$row->id)."'>$value</a>";
    }
    
    function _callback_after_upload($uploader_response, $field_info, $files_to_upload) {

        //Is only one file uploaded so it ok to use it with $uploader_response[0].
        $file_extension = explode('.', $uploader_response[0]->name);
        $file_name = $file_extension[0];
        $file_extension = $file_extension[1];
        if($file_extension === 'zip') {
            $file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name;
            $zip = new ZipArchive;
            chmod($file_uploaded, 0777);
            if($zip->open($file_uploaded) === TRUE) {
                $zip->extractTo($field_info->upload_path.'/'.$file_name.'/');
                $zip->close();
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return true;
        }
}

}