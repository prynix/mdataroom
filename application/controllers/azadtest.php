<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Azadtest extends CI_Controller 
{

	public function index()
	{
		//$this->load->helper('auth_helper');
		//redirect_if_not_logged_in();
		$this->load->view('welcome_message');		
	}
	public function process_banner_request()
	{

              // if(true) 
              // {
              //     echo print_r($this->input->post('id_info'));
              //     return;
              // }
              
               
               $IP = $this->input->post('IP');
               
               $idArray = $this->input->post('id_info');
               
               
               
               $responseArray=array();
               foreach($idArray as $id)
               {
                   $responseArray[$id['placement_id']] = $this->get_data($id['placement_id']);  
//                 $responseArray[$id['placement_id']] = ;
               }
                
         

               echo json_encode($responseArray);
              // print_r ($id);
	}
        
        private function get_data($id)
        {
            $content_width = $placement_width = 336;
            $content_height = $placement_height = 100;
            
            $imgurl = "";
            $caption = "";
            $banner_id="";

            //foreach($jsonData as $id)
            //{
                //$id = $id["placement_id"];
                //if(true) return $id;
                if(strcmp($id, "palo_1" )==0)
                {
                    $imgurl = "http://localhost/astarserve/_FILES/1.gif";
                    $type = 1;
                    $url = 'http://www.kaymu.com.bd/seller/prothoma/';
                    $banner_id="banner_1";
                    $content_width = $placement_width = 336;
                    $content_height = $placement_height = 100;

                }
                else if(strcmp($id, "palo_2" )==0)
                {
                    $imgurl = "http://localhost/astarserve/_FILES/ai.jpg";
                    $type = 1;
                    $url = 'http://cse.buet.ac.bd/faculty/facdetail.php?id=anindyaiqbal';
                    $banner_id="banner_2";
                    $content_width = $placement_width = 60 ;
                    $content_height = $placement_height = 60;  

                }
                else if(strcmp($id, "palo_3" )==0)
                {
                    $imgurl = "http://localhost/astarserve/_FILES/car.swf";
                    $type = 2;
                    $url = 'https://en.wikipedia.org/wiki/Computer_speaker';
                    $banner_id="banner_3";
                    $content_width = $placement_width = 336;
                    $content_height = $placement_height = 80;
    
                }
                else
                {
                    $imgurl = "http://localhost/astarserve/html_test_banner/html_test_local_news.html";
                    $type = 3;
                    $url = '';
                    $banner_id="banner_3";
                    $content_width = $placement_width = 350;
                    $content_height = $placement_height = 260;
     
                }
            //}
            
 //           http://localhost/astarserve/html_test_banner/html_test_local_news.html    
                
            $caption = "SOMETHING SID AZAD";
            

            
            return  array('banner_id' => $banner_id, 'content_url'=>$imgurl, 'caption'=>$caption , 'target_url' => $url, 'type'=>$type,
                    'content_width' => $content_width, 'content_height' => $content_height,
                    'placement_width' => $placement_width, 'placement_height' => $placement_height);
        }
        
        public function process_click_request()
	{
            echo $this->input->post("placement_id");
            echo " ";
            echo $this->input->post("banner_id");
        }
        public function process_impression_request()
	{
            echo $this->input->post("placement_id");
            echo " ";
            echo $this->input->post("banner_id");
        }
}