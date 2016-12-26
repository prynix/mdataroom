<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Placement extends CI_Model{
    function getPublisherId($id){
        $this->db->select('publisher_id');
        $this->db->from('placement');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $publisher_id = 1;
        foreach ($this->db->get()->result() as $row)
        {
            $publisher_id = $row->publisher_id;
        }
        return $publisher_id;
    }
    function getAllInfo($id){
        $this->db->select('*');
        $this->db->from('placement');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $position = 1;
        foreach ($this->db->get()->result() as $row)
        {
            return $row;
        }
        return NULL;
    }
    
    
    function getSize($id){
        $this->db->select('');
        $this->db->from('placement');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $width = null;
        $height = null;
        foreach ($this->db->get()->result() as $row)
        {
            $width = $row->width;
            $height =$row->height;
        }
        return "{$width}X{$height}";
    }
}

