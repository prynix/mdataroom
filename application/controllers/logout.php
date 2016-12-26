<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __construct()
	{
		parent::__construct();
                $this->load->helper('auth_helper');
                redirect_if_not_logged_in();
		
/*		if($pid!=false)
		{
			//logged in 
		}
*/		
		//echo $pid;
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$array_items = array('username' => '','is_logged_in' => false);
		$this->session->unset_userdata($array_items);
		$data['msg'] = "You Have been logged out";
		$this->load->view('login_view',$data);

	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */