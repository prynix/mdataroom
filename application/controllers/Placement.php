<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Placement extends CI_Controller {
    public function __construct()
    {
            parent::__construct();
            $this->load->helper('auth_helper');
            redirect_if_not_logged_in();
            redirect_if_not_user();
            $this->load->library('grocery_CRUD');
            
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
            echo "<object data=\"http://stackoverflow.com/does-not-exist.png\" type=\"image/png\"><img src=\"$banner_info->url\" /></object>";
        }
    }
    public function index()
    {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('placement');
            $crud->display_as('publisher_id', 'Publisher');
            $crud->required_fields('name','position','width','height','publisher_id');
            $crud->add_fields('publisher_id','name','position','width','height','default_banner_id');
            $crud->edit_fields('publisher_id','name','position','width','height','default_banner_id');
            $crud->columns('publisher_id','name','position','width','height','default_banner_id');
            $crud->display_as('default_banner_id', 'Default Banner');
            $crud->set_subject('Placement');
            $crud->set_relation('publisher_id', 'publisher', 'name');
            //$crud->set_relation('default_banner_id', 'banner', 'caption');
            $crud->set_relation('default_banner_id', 'banner', 'url');
            //$crud->set_relation('brand_id', 'brand', 'name');
            
            $crud->unset_print();
            
            $crud->callback_column('placement.name', array($this,'_callback_name'));
            $crud->display_as('name', 'Placement Name');
            
            $crud->add_action('Code', '', '', 'ui-icon-image', array($this, 'test'));
            
            $output = $crud->render();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();
            if($state == 'add' || $state == 'edit' ) {
                $this->load->view('placement_view', $output);
            } else {
                $this->load->view('welcome_message', $output);
            }

            //$this->load->view('welcome_message', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            $this->load->view('welcome_message', (object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
        }
    }
    
    function test($id, $row){
        //echo $id;
        //echo $row;
        return site_url('Placement/code').'?id='.$id.'&width='.$row->width.'&height='.$row->height;
    }
    
    function code(){
        $id = $this->input->get('id');
        //$width = $this->input->get('width');
        //$height = $this->input->get('height');
        $data = "placement_".$id;
        $data = "ad".md5($id);
        //$data = RotEncrypt("placement_".$id, 'takazadsid');
        
        /*
        $code1 = '<div id="'.$data.'" class="astar_serve" ></div>';
        $code2 = '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>';	
        $code3 = '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>';
        $code4 = '<script src="'.base_url().'clientAPI/front.js"></script>';
        $this->load->view('code_view', array('code1'=>$code1,'code2'=>$code2,'code3'=>$code3,'code4'=>$code4));
  
         */
        $this->load->model('servicemodel','', TRUE);
        $placement=$this->servicemodel->getPlacementById($id);
        
        $code='<div id="ot'.$data.'" class="ot_astar_serve"><iframe scrolling="no" src="'.base_url().'index.php/ServiceController/process_banner_request?pid='.$data.'" width="'.$placement->width.'" height="'.$placement->height.'" style="border:none"></iframe></div>';
        $code2='<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script><script src="http://localhost/mdataroom.com/clientAPI/outer_front.js"> </script><div id="'.'"ad"'.$data.'" class="ot_astar_serve"><iframe scrolling="no" src="http://localhost/mdataroom.com/index.php/ServiceController2/process_banner_request?pid=ad8f14e45fceea167a5a36dedd4bea2543" width="300" height="300" style="border:0px; margin:0px; padding:0px"></iframe></div>';
        
        $this->load->view('code_view', array('code'=>$code,'code2'=>$code2));
        
    }
    
    public function _callback_name($value, $row) {
        return "<a href='".site_url('BannerPlacement/index/add?placementId='.$row->id)."'>$value</a>";
    }

}