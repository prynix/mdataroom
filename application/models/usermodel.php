<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class UserModel extends CI_Model{
    function validate($username, $password){
        $result[0] = false;
        
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $query = $this->db->get('user');
        
        if($query->num_rows == 1){
            $result[0] = true;
            foreach ($query->result() as $row)
            {
                $result['user_role'] = $row->user_role;
                $result['user_id'] = $row->id;
            }
        }
        return $result;
    }
    function updateLoginTime($user_id){
    	$date = gmDate("Y-m-d");
    	$this->db->where('id', $user_id);
    	$this->db->set('last_login',$date);
    	$this->db->update('user');
    }
}

