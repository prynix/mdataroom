<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Campaign extends CI_Model{
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
        //$this->db->select('a.name as campaign');
        //$this->db->from('campaign a, variant b');
        //$this->db->where('b.id', 'a.variant_id');
        //$this->db->where('a.id', $id);
        $query = $this->db->query("select a.name as advertiser, b.name as brand, c.name as variant, d.name as campaign
from advertiser a, brand b, variant c, campaign d
where a.id=b.advertiser_id and b.id=c.brand_id and c.id = d.variant_id and d.id=?", array($id));
        //$this->db->limit(1);
        $position = 1;
        foreach ($query->result() as $row)
        {
            return $row;
        }
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

