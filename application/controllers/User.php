<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct()
    {
            parent::__construct();
            $this->load->helper('auth_helper');
            redirect_if_not_logged_in();
            redirect_if_not_admin();
            $this->load->library('grocery_CRUD');
    }
    public function index()
    {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('user');
            $crud->display_as('full_name', 'Full Name');
            $crud->required_fields('username','password', 'user_role');
            $crud->columns('username','full_name', 'email', 'user_role', 'last_login');
            $crud->fields('username','password','full_name', 'email', 'user_role');
            $crud->change_field_type('password', 'password');
            $crud->unset_read();
            
            $crud->callback_edit_field('password',array($this,'set_password_input_to_empty'));
            $crud->callback_add_field('password',array($this,'set_password_input_to_empty'));
            
            //$crud->unset_edit();
            $crud->set_subject('User');
            
            $crud->unset_print();
            
            $crud->callback_before_insert(array($this,'insert_password_callback'));
            $crud->callback_before_update(array($this,'update_password_callback'));
            
            $output = $crud->render();

            $this->load->view('welcome_message', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            $this->load->view('welcome_message', (object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
        }
    }
    
    function insert_password_callback($post_array) {
        if(!empty($post_array['password'])){
            $post_array['password'] = md5($post_array['password']);
        } else {
            unset($post_array['password']);
        }
        return $post_array;
    }
    
    function update_password_callback($post_array, $primary_key) {
        if(!empty($post_array['password'])){
            $post_array['password'] = md5($post_array['password']);
        } else {
            unset($post_array['password']);
        }
        return $post_array;
    }
    
    function set_password_input_to_empty() {
        return "<input type='password' name='password' value='' />";
    }

}