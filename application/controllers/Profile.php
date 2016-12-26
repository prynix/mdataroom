<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
    public function __construct()
    {
            parent::__construct();
            $this->load->helper('auth_helper');
            redirect_if_not_logged_in();
            $this->load->library('grocery_CRUD');
            $this->load->library('form_validation');
    }
    public function index()
    {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('user');
            $user_id = get_user_id();
            $crud->where('id', $user_id);
            $crud->display_as('full_name', 'Full Name');
            $crud->columns('username','full_name', 'email');
            $crud->fields('full_name', 'email');
            $crud->unset_read();
            $crud->unset_add();
            $crud->unset_delete();
            $crud->unset_export();
            
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();
            if($state == 'edit') {
                $primary_key = $state_info->primary_key;
                if ($primary_key != $user_id) {
                    redirect("Profile/index/edit/$user_id");
                }
            }
            
            //$crud->unset_edit();
            $crud->set_subject('Profile');
            
            $crud->unset_print();
            $crud->add_action('Change Password', '', '', 'ui-icon-image', array($this, 'callbackChangePassword'));
            
            $output = $crud->render();

            $this->load->view('welcome_message', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            $this->load->view('welcome_message', (object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
        }
    }
    
    function callbackChangePassword($id, $row){
        return site_url("Profile/changePassword/edit/$id");
    }
    
    function changePassword(){
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('user');
            $user_id = get_user_id();
            $crud->where('id', $user_id);
            //$crud->columns('current password', 'password', 'confirm password');
            $crud->fields('current_password', 'password', 'confirm_password');
            $crud->change_field_type('current_password', 'password');
            $crud->change_field_type('password', 'password');
            $crud->change_field_type('confirm_password', 'password');
            $crud->required_fields('password');
            $crud->unset_list();
            $crud->unset_back_to_list();
            $crud->unset_read();
            $crud->unset_add();
            $crud->unset_delete();
            $crud->unset_print();
            $crud->unset_export();
            
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();
            if($state == 'edit') {
                $primary_key = $state_info->primary_key;
                if ($primary_key != $user_id) {
                    redirect("Profile/changePassword/edit/$user_id");
                }
            }
            
            $crud->set_rules('current_password', 'Current Password', 'callback_checkCurrentPassword');
            
            $crud->set_rules('confirm_password', 'Confirm Password', 'callback_checkConfirmPassword');
            
            $crud->callback_edit_field('password',array($this,'set_password_input_to_empty'));
            
            //$crud->unset_edit();
            $crud->set_subject('Password');
            
            $crud->callback_before_update(array($this,'before_update_password_callback'));
            $crud->callback_after_update(array($this,'after_update_password_callback'));
            
            $output = $crud->render();

            $this->load->view('welcome_message', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            $this->load->view('welcome_message', (object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
        }
    }
    
    public function checkCurrentPassword($str) {
        
        $this->load->model('usermodel');
        $username = get_username();
        //$password = $post_array['current_password'];
        $password = $str;
        $result = $this->usermodel->validate($username, $password);
        if($result[0] == true) {
            return true;
        } else {
            unset($post_array['password']);
            $this->form_validation->set_message('checkCurrentPassword', "Incorrect Current Password");
            return false;
        }
    }
    
    public function checkConfirmPassword($str) {
        if($str == $_POST['password']) {
            return true;
        } else {
            unset($post_array['password']);
            $this->form_validation->set_message('checkConfirmPassword', "Password and Confirm password do not match, please try again.");
            return false;
        }
    }
    
    function before_update_password_callback($post_array, $primary_key) {
        $user_id = get_user_id();
        if($user_id != $primary_key) {
            unset($post_array['password']);
            //redirect("Profile/changePassword/edit/$user_id");
        }
        if(!empty($post_array['password'])){
            $post_array['password'] = md5($post_array['password']);
        } else {
            unset($post_array['password']);
        }
        unset($post_array['current_password']);
        unset($post_array['confirm_password']);
        return $post_array;
    }
    
    function after_update_password_callback($post_array, $primary_key) {
        //redirect("Profile");
    }
    
    function set_password_input_to_empty() {
        return "<input type='password' name='password' value='' />";
    }

}