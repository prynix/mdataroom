<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('auth_helper');
		redirect_if_logged_in();
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
		$this->load->view('login_view');
	}
	function submit()
	{
		$this->form_validation->set_rules('name', 'Username', 'required|trim|xss_clean|max_length[50]');			
		$this->form_validation->set_rules('pass', 'Password', 'required|trim|xss_clean|max_length[255]');
			
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			$this->load->view('login_view');
		}
		else // passed validation proceed to post success logic
		{

			$username = $this->input->post('name');
			$password = $this->input->post('pass');
			$un=$username;
			$pass = $password;
                        
                        $this->load->model('usermodel');
                        $result = $this->usermodel->validate($un, $pass);
                        if($result[0] ){
                            $data = array(
                                    'username' => $un,
                                    'is_logged_in' => true,
                                    'user_role' => $result['user_role'],
                                    'user_id' => $result['user_id']
                            );
                            $this->session->set_userdata($data);
                            $this->usermodel->updateLoginTime($result['user_id']);
                            redirect('welcome');
                        } else{
				$vd['msg'] = "INCORRECT CREDENTIALS";
				$this->load->view('login_view',$vd);
                        }
			
			/*$this->load->library('Radius');
			$ip_radius_server="172.16.101.11";
			$shared_secret="testing123*cse";
			$radius = new Radius($ip_radius_server, $shared_secret);
			$result = $radius->AccessRequest($username, $password);
			
				//print_r($result);
			
			
			if($result || ($un=='headcse' && $pass=='RSAS')
			 || ($un=='testuser' && $pass=='RSAS') || ($un=='testadmin' && $pass=='RSAS'))
			{
				$this->load->model('person');
				$data = $this->person->get_info($username);
				
				$pid = $data->id;
				$role = $data->role;
				//echo "ROLL->".$role;
				if(isset($data) && isset($role) && !empty($role) )
				{
			
					$this->session->set_userdata('username',$username);
					$this->session->set_userdata('priviledge',$role);
					$this->session->set_userdata('pid',$pid);
					
					$vd['message']="Welcome ".$username;
					$this->load->view('success',$vd);
				}
				else
				{
					$vd['msg'] = "You have not been registered as a user in this system";
					$this->load->view('login_view',$vd);					
				}
			}
			else 
			{
				$vd['msg'] = "INCORRECT CREDENTIALS";
				$this->load->view('login_view',$vd);
			}*/
		}
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */