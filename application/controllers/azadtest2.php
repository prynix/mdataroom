<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Azadtest2 extends CI_Controller 
{

        function __construct(){
			
                header('Access-Control-Allow-Origin: *');
                header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
                $method = $_SERVER['REQUEST_METHOD'];
                if($method == "OPTIONS") {
                        die();
                }
                parent::__construct();


	}   

	public function index()
	{
            $pid =1;
            $banner_id=5;            
            $query = '?pid=' . $pid;
            $query = $query. '&banner_id='.$banner_id;
            echo '<a href="'.site_url('azadtest2/process_click_request');//.$query.'" target="_blank"> <img src="http://cse.buet.ac.bd/faculty/photos/anindyaiqbalanindya.jpg"/></a>';


	}
	public function process_banner_request()
	{
            $pid = $_GET['pid'];
            $cook="";
            
            setcookie('astar_iframe_cookie', $cook);
            setcookie('uuid', 1231);            

// (!isset($_COOKIE[$cookie_name])) {
    //echo "Cookie named '" . $cookie_name . "' is not set!";
//} else {
 //   echo "Cookie '" . $cookie_name . "' is set!<br>";
//    echo "Value is: " . $_COOKIE[$cookie_name];
//}
            if($pid=="palo_1")
            {
                $banner_id=1;

                $query = '?pid=' . $pid;
                $query = $query. '&banner_id='.$banner_id;
                echo 
                '<head>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
                    <script src="http://localhost/astarserve/as/clientAPI/front_iframe_viewport.js"> </script>
                 </head>'
                . '<div class="astar_serve" id="palo_1">'
                        . '<a href="http://localhost/astarserve/as/index.php/azadtest2/process_click_request?pid=1&bid=33" target="_blank"> '
                        . '<img src="http://cse.buet.ac.bd/faculty/photos/anindyaiqbalanindya.jpg"/></a></div>';
            }
            else
            {
                $banner_id=$pid;
                $query = '?pid=' . $pid;
                $query = $query. '&banner_id='.$banner_id;
                echo 
                '<head>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
                    <script src="http://mdataroom.com/adserver/as/clientAPI/front_iframe_viewport.js"> </script>
                 </head>'
                . '<div class="astar_serve" id="'.$pid.'">'
                        . '<a href="http://localhost/astarserve/as/index.php/azadtest2/process_click_request?pid=1&bid=33" target="_blank"> '
                        . '<img src="http://cse.buet.ac.bd/faculty/photos/anindyaiqbalanindya.jpg"/></a></div>';

            }
            

	}
      
        public function process_click_request()
	{
            $pid = $_GET['pid'];
            $bid = $_GET['bid'];
            
            echo $pid;
            echo '   ';
            
            echo $bid;
            echo '   ';
                        
            echo $_SERVER['HTTP_HOST'];
            echo '   ';
            echo $_SERVER['HTTP_REFERER'];
            echo '   ';
            echo $_SERVER['HTTP_USER_AGENT'];
            echo '   ';            
        }
        
        public function process_load_request()
	{
//            echo $this->input->post("placement_id");
//            echo " ";
//            echo $this->input->post("banner_id");
            echo $_COOKIE['astar_iframe_cookie'];

        } 
        
        public function process_impression_request()
	{
            echo $this->input->post("placement_id");
            echo " ";
            echo $this->input->post("banner_id");
            
        }
}