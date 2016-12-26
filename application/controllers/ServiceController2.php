<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ServiceController2 extends CI_Controller {
    
        private $base="_FILES/";
        private $script_url="clientAPI/front_iframe_viewport.js";
        private $click_url="index.php/ServiceController2/process_click_request/";
        
            
        function __construct(){
			
                header('Access-Control-Allow-Origin: *');
                header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
                $method = $_SERVER['REQUEST_METHOD'];
                if($method == "OPTIONS") {
                        die();
                }
                parent::__construct();

		$this->load->helper('auth_helper');
                //redirect_if_not_logged_in();                
                $this->load->model('servicemodel','', TRUE);
                $this->load->model('schedularmodel','',TRUE);
                //$this->base= dirname(base_url()).$this->base;
                $this->base= base_url().$this->base;
	}   
        
        private function processId($placementId){
           
            //$this->load->helper('auth_helper');
            //$placementId = RotDecrypt($placementId, 'takazadsid');
            //$this->load->model('servicemodel','',TRUE);
            $placementId = substr($placementId, 2);
            $data = $this->servicemodel->getPlacementId($placementId);
            if($data != null)return $data->id;
            return null;
            //$data=  explode("_", $placementId);                
            //return $data[count($data)-1];
                        
            //return $this->servicemodel->getplacementidByKey($placementId);
        }
        
        private function load_image($data){            
            $this->load->view('image',$data);            
        }
        
        private function load_flash($data){
            $this->load->view('flash',$data);
        }
        
        private function load_html5($data){
            $this->load->view('html5',$data);
        }
        


        public function process_banner_request(){
                        
            $client_data= $this->get_request_client_data();
            $requested_data= $this->get_requested_data($client_data);
                  
            if($requested_data==NULL)return;            
            $requested_data['client_data']=$client_data;            
            $this->set_cookie_data($requested_data);
            $requested_data['request_type']=1;
            
            
            $this->updateAdReport($requested_data);
            
            if($requested_data['type']==1)$this->load_image ($requested_data);
            else if($requested_data['type']==2)$this->load_flash ($requested_data);
            else if($requested_data['type']==3)$this->load_html5 ($requested_data);
            else return;            
            
        }
        
                
        public function process_click_request(){
            $data=$this->get_click_client_data();            
            
            $data['request_type']=4;
            $this->updateAdReport($data);            
            
            redirect($data['target_url']);
        }
        
        public function process_load_request(){
            $data=$this->get_load_client_data();  
            
            $data['request_type']=2;
            $this->updateAdReport($data);
            
        }               
        
        public function process_impression_request(){
            $data=$this->get_impression_client_data();  
            $data['request_type']=3;
            $this->updateAdReport($data);
        }
        
        public function get_impression_client_data(){
            $data=array();
            $placement_id=null;
            $banner_id=null;
            $uuid=null;
            
            
            if(isset($_POST['placement_id']))$placement_id=$this->input->post('placement_id');
            if(isset($_POST['banner_id']))$banner_id=$this->input->post('banner_id');
            if(isset($_POST['uuid']))$uuid=$this->input->post('uuid');
            
            $data['placement_id']=$placement_id;
            $data['banner_id']=$banner_id;
            $data['uuid']=$uuid;
            $data['device_type']=  $this->deviceType();
            
            
            return $data;
        }
        
        private function get_load_client_data(){
            $data=array();
            $data['placement_id']=$this->processId($this->input->post('placement_id')); 
            
            echo $this->getReferer();
            
            $cookie_data=  $this->get_cookie_data();
            
            $placementList=  explode(" ",$cookie_data['placements']);
            $bannerlist=  explode(" ", $cookie_data['banners']);
            $banner=NULL;
            
            echo "<pre>";
            print_r($placementList);
            echo "</pre>";
            
            
            foreach ($placementList as $key => $value) {
                if($value==$data['placement_id']){
                    $banner=$bannerlist[$key];
                    break;
                }
            }
            $data['banner_id']=$banner;
            $data['device_type']= $this->deviceType();
            $data['uuid']=  $this->getUUIDFromCookie();
            
            
            return $data;
        }
        
        private function getUUIDFromCookie(){
            if(isset($_COOKIE['uuid']))
                return $this->isValid ($_COOKIE['uuid']);
        }
        
        private function getCurrentTimeStamp(){
            return gmdate("U",time()+(6*3600));
        }
      

        private function getBannerIdFromScheduler($client_data){
            
            $placementId=$client_data['placement_id'];
            $deviceType=$client_data['device_type'];
            
            $result=$this->schedularmodel->getBannersInfo($placementId,$this->getCurrentTimeStamp(),$deviceType);
            $bannerId=0;            
           
            if(!$result){           
                $bannerId=$this->servicemodel->loadDefaultBanner($placementId,$deviceType);                
            }
            else{                
                $total=0;            
                $ignore=array();
                foreach($result->result() as $row){
                    //echo "<pre>";
                    //print_r($row);               
                   // echo "</pre>";
                    $impressioncount=$this->servicemodel->getTotalImpression($placementId,$row->banner_id);
                    
                    //echo $impressioncount;
                    
                    $ignore[$row->banner_id]=false;
                    
                    if($impressioncount>=$row->impression_ratio){
                        $ignore[$row->banner_id]=true;
                    }
                    else{                    
                        $total+=$row->impression_ratio;
                    }
                }
                
                if($total==0){
                    return $this->servicemodel->loadDefaultBanner($placementId,$deviceType);
                }
                
                $randValue= rand() / getrandmax();;
                $cumLative=0;

                foreach($result->result() as $row){  
                    
                    if($ignore[$row->banner_id])
                    {
                        continue;;
                    }
                    
                    $cmpValue=$cumLative+($row->impression_ratio/$total);                
                    if($randValue<=$cmpValue){
                        $bannerId=$row->banner_id;
                        break;
                    }
                    $cumLative+=$row->impression_ratio/$total;
                }
            }
            return $bannerId;
        }
        
        
        private function get_cookie_data(){           
            $data=array();
            
            if(!isset($_COOKIE['uuid'])){
                $data['uuid']= $this->getGUID();
            }
            else{
                $data['uuid']=  $this->isValid($_COOKIE['uuid']);
            }
            
            if(isset($_COOKIE['placements'])&& isset($_COOKIE['banners'])&& isset($_COOKIE['realplacements'])){
                $data['placements']= $_COOKIE['placements'];
                $data['banners']= $_COOKIE['banners'];
                $data['realplacements']=$_COOKIE['realplacements'];
            }
            else{
                $data['placements']="";
                $data['banners']="";
                $data['realplacements']="";
            }
            
            return $data;
        }
        
        private function set_cookie_data($data){ 
            
            $client_data=$data['client_data'];
            $cookie_data=$client_data['cookie_data'];
            
            $realplacementList=explode(" ",$cookie_data['realplacements']);
            $placementsList=  explode(" ",$cookie_data['placements']);
            $bannersList=explode(" ",$cookie_data['banners']);
            
            setcookie('uuid',$cookie_data['uuid']);
            
            $placement=$data['placement_id'];
            $realplacement=  md5($placement);
            $banner=$data['banner_id'];
            
            $index=0;
            $flag=TRUE;
            foreach ($placementsList as $in => $value) {
                if($value==$placement){                    
                    $bannersList[$in]=$banner;
                    $flag=FALSE;
                    break;
                }
                $index++;
            }
            if($flag){
                $placementsList[$index]=$placement;
                $bannersList[$index]=$banner;
                $realplacementList[$index]=$realplacement;
            }
            
            $realplacementstr=implode(" ",$realplacementList);
            $placementstr=implode(" ",$placementsList);
            $bannerstr=implode(" ",$bannersList);
            
            setcookie('realplacements',$realplacementstr);
            setcookie('placements',$placementstr);
            setcookie('banners',$bannerstr);
            
        }
        
         private function deviceType() {
            if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]))
            {
                return 1;
            }
            else{             
                return 0;
            }
        }
        

        
        private function get_click_client_data(){
            $data=array();
            $data['placement_id'] = $_GET['pid'];
            $data['banner_id']=$_GET['bid'];
            $data['target_url']=$_GET['target_url'];
            $data['device_type']=$this->deviceType();                      
            $data['uuid']=  $this->getUUIDFromCookie();
                    
            return $data;
        }
        
        private function get_request_client_data(){
            $data=array();
            $data['real_placement_id']=$_GET['pid'];
            $data['placement_id'] = $this->processId($_GET['pid']);
            $data['device_type']=$this->deviceType();           
            $data['cookie_data']=$this->get_cookie_data();
            
            return $data;
        }
           
        private function get_requested_data($client_data=NULL){
            if($client_data==NULL)return;
            
            $placementResult=$this->servicemodel->getPlacementById($client_data['placement_id']);            
            if($placementResult==null)return array();
            
            $bannerId=$this->getBannerIdFromScheduler($client_data);
            if($bannerId==null)return array();
            
            
            $result=$this->servicemodel->getInformation($bannerId);
            if(!$result)return array();
            
                        
            //$clientInformaton=$this->updateLog($clientInfo,$placementId,$bannerId,1);
            //$this->servicemodel->updateRequestRecord($placementId,$bannerId, $this->getCountry($clientInformaton));                                    
            
            $cookie_data=$client_data['cookie_data'];
            
            
            $data=array();  
            $data['uuid']=  $cookie_data['uuid'];
            $data['placement_id']=$client_data['placement_id'];
            $data['real_placement_id']=$client_data['real_placement_id'];
            $data['banner_id']=$bannerId;
            $data['content_url']=  $this->base.$result->url;
            $data['caption']=$result->caption;
            $data['type']=$result->banner_type_id;
            $data['target_url']=$result->link;
            $data['placement_height']=$placementResult->height;
            $data['placement_width']=$placementResult->width;
            $data['content_height']='';
            $data['content_width']='';   
            $data['script_url']=  base_url().$this->script_url;
            $data['click_url']=  base_url().$this->click_url;  
            $data['device_type']= $client_data['device_type'];
            //for html5
            if($result->banner_type_id==3){
                $data['content_url']=  $this->base.$this->processHtml5Name($result->url).'/index.html';
            }
            
            return  $data;
        }
        
        private function get_data($clientInfo,$placementId,$bannerIds,$deviceType)
        {
                                                 
            $placementResult=$this->servicemodel->getPlacementById($placementId);
            
            if($placementResult==null){
                  return array();
            }
            
            $bannerId=$this->getBannerIdFromScheduler($placementId,$bannerIds,$deviceType);
            
            if($bannerId==null){
                  return array();
            }
            
            $result=$this->servicemodel->getInformation($bannerId);
            
            if(!$result){
                return array();
            }
            
            $data=array();
            $clientInformaton=$this->updateLog($clientInfo,$placementId,$bannerId,1);
            $this->servicemodel->updateRequestRecord($placementId,$bannerId, $this->getCountry($clientInformaton));                                    
            
            $data['uuid']=$clientInfo['uuid'];            
            $data['placement_id']=$placementId;
            $data['banner_id']=$bannerId;
            $data['content_url']=  $this->base.$result->url;
            $data['caption']=$result->caption;
            $data['type']=$result->banner_type_id;
            $data['target_url']=$result->link;
            $data['placement_height']=$placementResult->height;
            $data['placement_width']=$placementResult->width;
            $data['content_height']='';
            $data['content_width']='';
            
            
            
            //for html5
            if($result->banner_type_id==3){
                $data['content_url']=  $this->base.$this->processHtml5Name($result->url).'/index.html';
            }
            
            
           
            return  $data;
        }
        
        
        private function updateAdReport($data){
            
            $log=array();            
            $ip=$this->getIP();
            //$ip='139.130.4.5';
            $log['ip']= $ip;
            $log['placement_id']=$data['placement_id'];
            $log['banner_id']=$data['banner_id'];
            $log['time']=gmDate("Y-m-d H:i:s",time()+(6*3600));
            $log['source']=  $this->getReferer();
            $log['request_type']=$data['request_type'];
            $log['device_id']=$data['device_type'];
            $log['uuid']=$data['uuid'];
            
            
            if($log['request_type']==1){
                $foot_print=$this->getFromServer();
            }
            else if($log['request_type']==2||$log['request_type']==3){
                $foot_print=  $this->getFromPost();
            }
            else if($log['request_type']==4){
                $foot_print=$this->getFromGet();
            }
            else{
                echo 'Not Ok';
               
            }
            
           
            $log=array_merge($log,$foot_print);   
            
            $data['country']=NULL;
            
            if($log['request_type'] != 1){
                $log=array_merge($log,$this->ip_info($ip,'location'));   
                if(isset($log['country']))
                    $data['country']=$log['country'];                
            }
              
            $this->servicemodel->updateLog($log);
            
            $this->updateAddreportSummary($data);
            
            return $log;
            
        }
        
        private function getFromServer(){
            $data=array();
            
            $browser_width=0;
            $browser_height=0;
            $browser_name="";
            $browser_version="";
            $browser_language="";
            $os_name="";
            $os_version=0;
            $cookie_enabled=NULL;
            $full_user_agent="";
            
            //$browser = get_browser(null, true);
            //echo json_encode($browser);
            
            
            $data['browser_width']=$browser_width;
            $data['browser_height']=$browser_height;
            $data['browser_name']=$browser_name;
            $data['browser_version']=$browser_version;
            $data['os_name']=$os_name;
            $data['os_version']=$os_version;
            $data['cookie_enabled']=$cookie_enabled;
            //$data['full_user_agent']=json_encode($browser);
            $data['full_user_agent']=$full_user_agent;
            
            return $data;
        }
        
        private function getFromPost(){
            $data=array();
           
            $browser_width=0;
            $browser_height=0;
            $browser_name="";
            $browser_version="";
            $browser_language="";
            $os_name="";
            $os_version=0;
            $cookie_enabled=NULL;
            $full_user_agent="";
            
            if(isset($_POST['browser_width']))$browser_width=$this->input->post ('browser_width');
            if(isset($_POST['browser_height']))$browser_height=$this->input->post ('browser_height');
            if(isset($_POST['browser_name']))$browser_name=$this->input->post ('browser_name');
            if(isset($_POST['browser_version']))$browser_version=$this->input->post ('browser_version');
            if(isset($_POST['os_name']))$os_name=$this->input->post ('os_name');
            if(isset($_POST['os_version']))$os_version=$this->input->post ('os_version');
            if(isset($_POST['cookie_enabled']))$cookie_enabled=$this->input->post ('cookie_enabled');
            if(isset($_POST['full_user_agent']))$full_user_agent=$this->input->post ('full_user_agent');
            
            $data['browser_width']=$browser_width;
            $data['browser_height']=$browser_height;
            $data['browser_name']=$browser_name;
            $data['browser_version']=$browser_version;
            $data['os_name']=$os_name;
            $data['os_version']=$os_version;
            $data['cookie_enabled']=$cookie_enabled;
            $data['full_user_agent']=$full_user_agent;
            
            return $data;
            
            
        }
        
        private function getFromGet(){
            $data=array();
           
            $browser_width=0;
            $browser_height=0;
            $browser_name="";
            $browser_version="";
            $browser_language="";
            $os_name="";
            $os_version=0;
            $cookie_enabled=NULL;
            $full_user_agent="";
            
            if(isset($_GET['browser_width']))$browser_width=$this->input->get ('browser_width');
            if(isset($_GET['browser_height']))$browser_height=$this->input->get ('browser_height');
            if(isset($_GET['browser_name']))$browser_name=$this->input->get ('browser_name');
            if(isset($_GET['browser_version']))$browser_version=$this->input->get ('browser_version');
            if(isset($_GET['os_name']))$os_name=$this->input->get ('os_name');
            if(isset($_GET['os_version']))$os_version=$this->input->get ('os_version');
            if(isset($_GET['cookie_enabled']))$cookie_enabled=$this->input->get ('cookie_enabled');
            if(isset($_GET['full_user_agent']))$full_user_agent=$this->input->get ('full_user_agent');
            
            $data['browser_width']=$browser_width;
            $data['browser_height']=$browser_height;
            $data['browser_name']=$browser_name;
            $data['browser_version']=$browser_version;
            $data['os_name']=$os_name;
            $data['os_version']=$os_version;
            $data['cookie_enabled']=$cookie_enabled;
            $data['full_user_agent']=$full_user_agent;
            
            return $data;
            
            
        }
        
        public function updateAddreportSummary($data){
            if($data['request_type']==1){
                $this->servicemodel->updateRequestRecord($data['placement_id'],$data['banner_id'],$data['country']);
            }
            else if($data['request_type']==2){
                
                return;
            }
            else if($data['request_type']==3){
                
                $this->servicemodel->updateImpressionRequestRecord($data['placement_id'],$data['banner_id'],$data['country']);
            }
            else if($data['request_type']==4){
                $this->servicemodel->updateClickRecord($data['placement_id'],$data['banner_id'],$data['country']);
            }
            else{
                return;
            }
        }
        
        public function testScheduler(){
            $data=$this->get_data(array(),7,'',1);
            
            echo "<pre>";
            print_r($data);
            echo "</pre>";
        }
         
        
        private function isValid($uuid){
            if(strlen($uuid)!=36)return 'NULL';            
            return $uuid;
        }

        private function getBrowserInfo(){
            $clientInfo=array();
            $clientInfo['uuid']= $this->isValid($this->input->post('uuid'));
            $clientInfo['browser_height']=  $this->input->post('browser_height'); 
            $clientInfo['browser_width']=  $this->input->post('browser_width'); 
            $clientInfo['browser_name']=  $this->input->post('browser_name'); 
            $clientInfo['browser_version']=  $this->input->post('browser_version'); 
            $clientInfo['browser_language']=  $this->input->post('browser_language'); 
            $clientInfo['os_name']=  $this->input->post('os_name'); 
            $clientInfo['os_version']=  $this->input->post('os_version'); 
            $clientInfo['cookie_enabled']=  $this->input->post('cookie_enabled'); 
            $clientInfo['cookie_age']=  $this->input->post('cookie_age'); 
            $clientInfo['full_user_agent']=  $this->input->post('full_user_agent'); 
            $clientInfo['device_id']=  $this->input->post('device_type'); 
            
            return $clientInfo;
        }
       
        private function getCountry($clientinfo){               
                $country=NULL;
                if(isset($clientinfo['country'])){
                    if(!($clientinfo['country']=='NULL' || $clientinfo['country']=='Bangladesh')){
                        $country='Other';
                    }                    
                }
                return $country;
                //return $country;
        }
              
        private function imagePreview($result,$placementResult){
           
            $data=array();
            
            //$base="http://localhost/astarserve/_FILES/";
            
            $data['headerTitle']="Image Preview";
            $data['placement_name']=$placementResult->name;            
            $data['content_url']=  $this->base.$result->url;
            $data['caption']=$result->caption;
            $data['target_url']=$result->link;
            $data['placement_height']=$placementResult->height;
            $data['placement_width']=$placementResult->width;            
            
            $this->load->view('imagePreview',$data);
        }
        
        private function flashPreview($result,$placementResult){
           
            $data=array();
            
            //$base="http://localhost/astarserve/_FILES/";
            
            $data['headerTitle']="Flash Preview";
            $data['placement_name']=$placementResult->name;            
            $data['content_url']=  $this->base.$result->url;
            $data['caption']=$result->caption;
            $data['target_url']=$result->link;
            $data['placement_height']=$placementResult->height;
            $data['placement_width']=$placementResult->width;            
            
            $this->load->view('flashPreview',$data);
        }
        
        private function processHtml5Name($name){
            return substr($name,0, strlen($name)-4);
            
        }
        
        private function errorPreview(){            
            $this->load->view('errorPreview');
        }
        
        private function html5Preview($result,$placementResult){
           
            $data=array();
            
            //$base="http://localhost/astarserve/_FILES/";
            
            $data['headerTitle']="HTML5 Preview";
            $data['placement_name']=$placementResult->name;            
            $data['content_url']=  $this->base.$this->processHtml5Name($result->url).'/index.html';
            $data['caption']=$result->caption;
            $data['target_url']=$result->link;
            $data['placement_height']=$placementResult->height;
            $data['placement_width']=$placementResult->width;            
            
            $this->load->view('html5Preview',$data);
        }
        
        public function testHTMLPreview($bannerId = NULL,$placementId=NULL) {
            
            
            if ($bannerId == NULL || $placementId==NULL) {
                $this->errorPreview();
            } 

            else {

                    $result = $this->servicemodel->getInformation($bannerId);
                    $placementResult=$this->servicemodel->getPlacementById($placementId);


                    if (!$result || !$placementResult) {
                        $this->errorPreview();
                    }
                    else if ($result->banner_type_id == 1) {
                        $this->imagePreview($result,$placementResult);
                    }
                    else if ($result->banner_type_id == 2) {
                        $this->flashPreview($result,$placementResult);
                    }
                    else if ($result->banner_type_id == 3) {
                        $this->html5Preview($result,$placementResult);
                    }
                    else {
                        $this->errorPreview();
                    }
            }
        }
    
        private function getGUID(){
            
            if (function_exists('com_create_guid')){
                return trim(com_create_guid(), '{}');
            }
            else{
                mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
                $charid = strtoupper(md5(uniqid(rand(), true)));
                $hyphen = chr(45);// "-"
                $uuid = chr(123)// "{"
                    .substr($charid, 0, 8).$hyphen
                    .substr($charid, 8, 4).$hyphen
                    .substr($charid,12, 4).$hyphen
                    .substr($charid,16, 4).$hyphen
                    .substr($charid,20,12)
                    .chr(125);// "}"
                return trim($uuid,'{}');
            }
        }
        
        private function getIP(){
            $real_ip_adress=null;
            
            if (isset($_SERVER['HTTP_CLIENT_IP']))
            {
                $real_ip_adress = $_SERVER['HTTP_CLIENT_IP'];
            }

            else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            {
                $real_ip_adress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            else
            {
                $real_ip_adress = $_SERVER['REMOTE_ADDR'];
            }
            
            
            return $real_ip_adress;
            
        }
        
        private function getReferer(){
            if(isset($_SERVER['HTTP_REFERER']))
                return  urlencode($_SERVER['HTTP_REFERER']);
            else
                return 'NULL';
        }
        
      
        
        private function processUUID($uuid)
        {
            if(strlen($uuid)!=36)
                return $this->getGUID();
            return $uuid;
        }
                
        private function updateLog($clientInfo,$placementId,$bannerId,$type){  
            $ip=$this->getIP();
           
            $clientInfo['ip']= $ip;
            $clientInfo['placement_id']=$placementId;
            $clientInfo['banner_id']=$bannerId;
            $clientInfo['time']=gmDate("Y-m-d H:i:s",time()+(6*3600));
            $clientInfo['source']=  $this->getReferer();
            $clientInfo['request_type']=$type;
            
            //$clientInfo=array_merge($clientInfo,$this->ip_info($ip,'location'));            
            
            
            if($type!=1){
                $clientInfo=array_merge($clientInfo,$this->ip_info($ip,'location'));            
               // print_r($clientInfo);
            }
            
            $this->servicemodel->updateLog($clientInfo);
            
            return $clientInfo;
            
        }
        
        private function testIP(){
            //print_r($this->ip_info("173.252.110.27", "location"));
           /* echo $this->ip_info("Visitor", "Country Code"); // IN
            echo $this->ip_info("Visitor", "State"); // Andhra Pradesh
            echo $this->ip_info("Visitor", "City"); // Proddatur
            echo $this->ip_info("Visitor", "Address"); // Proddatur, Andhra Pradesh, India

            print_r($this->ip_info("Visitor", "Location")); // Array ( [city] => Proddatur [state] => Andhra Pradesh [country] => India [country_code] => IN [continent] => Asia [continent_code] => AS )
            */
        }
    
        private function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
            $output = array();
            if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
                $ip = $_SERVER["REMOTE_ADDR"];
                if ($deep_detect) {
                    if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                        $ip = $_SERVER['HTTP_CLIENT_IP'];
                }
            }
            $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
            $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
            $continents = array(
                "AF" => "Africa",
                "AN" => "Antarctica",
                "AS" => "Asia",
                "EU" => "Europe",
                "OC" => "Australia (Oceania)",
                "NA" => "North America",
                "SA" => "South America"
            );
            if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
                $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
                if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                    switch ($purpose) {
                        case "location":
                            /*$output = array(
                                "city"           => @$ipdat->geoplugin_city,
                                "state"          => @$ipdat->geoplugin_regionName,
                                "country"        => @$ipdat->geoplugin_countryName,
                                "country_code"   => @$ipdat->geoplugin_countryCode,
                                "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                                "continent_code" => @$ipdat->geoplugin_continentCode
                            );*/
                            
                            $output = array(
                                "city"           => @$ipdat->geoplugin_city,
                                "state"          => @$ipdat->geoplugin_regionName,
                                "country"        => @$ipdat->geoplugin_countryName,
                                "country_code"   => @$ipdat->geoplugin_countryCode                                
                            );
                            
                            $address = array($ipdat->geoplugin_countryName);
                            if (@strlen($ipdat->geoplugin_regionName) >= 1)
                                $address[] = $ipdat->geoplugin_regionName;
                            if (@strlen($ipdat->geoplugin_city) >= 1)
                                $address[] = $ipdat->geoplugin_city;
                            
                            $output['address']=implode(", ", array_reverse($address));
                            
                            break;
                            
                        case "address":
                            $address = array($ipdat->geoplugin_countryName);
                            if (@strlen($ipdat->geoplugin_regionName) >= 1)
                                $address[] = $ipdat->geoplugin_regionName;
                            if (@strlen($ipdat->geoplugin_city) >= 1)
                                $address[] = $ipdat->geoplugin_city;
                            $output = implode(", ", array_reverse($address));
                            break;
                        case "city":
                            $output = @$ipdat->geoplugin_city;
                            break;
                        case "state":
                            $output = @$ipdat->geoplugin_regionName;
                            break;
                        case "region":
                            $output = @$ipdat->geoplugin_regionName;
                            break;
                        case "country":
                            $output = @$ipdat->geoplugin_countryName;
                            break;
                        case "countrycode":
                            $output = @$ipdat->geoplugin_countryCode;
                            break;
                    }
                }
            }
    return $output;
}
        

        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */