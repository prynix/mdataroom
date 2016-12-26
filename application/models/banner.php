<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Banner extends CI_Model{
    function getAllInfo($id){
        $this->db->select('*');
        $this->db->from('banner');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $position = 1;
        $result = NULL;
        foreach ($this->db->get()->result() as $row)
        {
            $result = new stdClass ();
            $result->id = $row->id;
            $result->url = base_url().'../_FILES/'.$row->url;
            $result->type = $this->getBannerInfo('banner_type', 'name', $row->banner_type_id);
            $result->campaign = $this->getBannerInfo('campaign', 'name', $row->campaign_id);
            $result->variant_id = $this->getBannerInfo('campaign', 'variant_id', $row->campaign_id);
            $result->variant = $this->getBannerInfo('variant', 'name', $result->variant_id);
            $result->brand_id = $this->getBannerInfo('variant', 'brand_id', $result->variant_id);
            $result->brand = $this->getBannerInfo('brand', 'name', $result->brand_id);
            $result->advertiser_id = $this->getBannerInfo('brand', 'advertiser_id', $result->brand_id);
            $result->advertiser = $this->getBannerInfo('advertiser', 'name', $result->advertiser_id);
        }
        return $result;
    }
    function getBannerInfo($foreignTable, $columnName, $id) {
        $this->db->select($columnName);
        $this->db->from($foreignTable);
        $this->db->where('id', $id);
        $this->db->limit(1);
        foreach ($this->db->get()->result() as $row)
        {
            return $row->$columnName;
        }
    }
}

