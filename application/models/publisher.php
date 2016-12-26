<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Publisher extends CI_Model{
    function getPublisherName($id){
        $this->db->select('name');
        $this->db->from('publisher');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $name = 'Empty Publisher';
        foreach ($this->db->get()->result() as $row)
        {
            $name = $row->name;
        }
        return $name;
    }
}

