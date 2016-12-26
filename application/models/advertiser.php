<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Advertiser extends CI_Model{
    function getAdvertiserByUserId($user_id){
        $this->db->select('id, name');
        $this->db->from('advertiser');
        if(isset($user_id)) {
            $this->db->where('user_id', $user_id);
        }
        $result = array();
        foreach ($this->db->get()->result() as $row)
        {
            $result[$row->id] = $row->name;
        }
        return $result;
    }
}

