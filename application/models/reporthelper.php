<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ReportHelper extends CI_Model{
    public function __construct()
    {
            parent::__construct();
            $this->load->helper('auth_helper');
            redirect_if_not_logged_in();
    }
    public function getDumpData(){
        $bannerList = $this->session->flashdata('bannerList');
        $start_date = $this->session->flashdata('start_date');
        $end_date = $this->session->flashdata('end_date');
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $this->db->select('time, source, ip, country, state, city, browser_name, cookie_enabled, cookie_age, name as Placement, caption as Banner');
        $this->db->from('ad_record');
        $this->db->join('banner', 'banner.id = banner_id');
        $this->db->join('placement', 'placement.id = placement_id');
        $this->db->where("DATE(time) >= ", $start_date);
        $this->db->where("DATE(time) <= ", $end_date);
        $this->db->where_in('banner_id', $bannerList);//$bannerList
        $this->db->order_by('banner_id');
        $this->db->order_by('time desc');
        $this->db->limit(5000);
        $query = $this->db->get();
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download('log.csv', $data);
    }
    function getAdvertiserByUserId($user_id){
        $this->db->select('id, name');
        $this->db->from('advertiser');
        if(isset($user_id)) {
            $this->db->where('user_id', $user_id);
        }
        $result = array();
        $result[""]="";
        foreach ($this->db->get()->result() as $row)
        {
            $result[$row->id] = $row->name;
        }
        return $result;
    }
    function getSelectedBanners($user_id){
        $this->load->helper('auth_helper');
        $advertiser_id = $this->input->post('advertiser_id');
        if(my_isset($user_id)) {
            $this->db->select('user_id');
            $this->db->from('advertiser');
            $this->db->where('id', $advertiser_id);
            $this->db->limit(1);
            foreach ($this->db->get()->result() as $row)
            {
                $advertiser_user_id = $row->user_id;
            }
            if (isset($advertiser_user_id) && $user_id == $advertiser_user_id) {
                //
            } else {
                return array(-1);
            }
        }
        $brandList = $this->getChilds(array($advertiser_id), 'advertiser_id', 'brand');
        $brandList = $this->getFilteredChilds($brandList, $this->input->post('brand_id'));
        //print_r($brandList);
        if(count($brandList) < 1) return array(-1);
        $variantList = $this->getChilds($brandList, 'brand_id', 'variant');
        $variantList = $this->getFilteredChilds($variantList, $this->input->post('variant_id'));
        //print_r($variantList);
        if(count($variantList) < 1) return array(-1);
        $campaignList = $this->getChilds($variantList, 'variant_id', 'campaign');
        $campaignList = $this->getFilteredChilds($campaignList, $this->input->post('campaign_id'));
        //print_r($campaignList);
        if(count($campaignList) < 1) return array(-1);
        $bannerList = $this->getChilds($campaignList, 'campaign_id', 'banner');
        //print_r($bannerList);
        if(count($bannerList) < 1) return array(-1);
        return $bannerList;
    }
    function getFilteredChilds($childs, $child) {
        if(my_isset($child)) {
            foreach ($childs as $row) {
                if ($row == $child) {
                    return array($child);
                }
            }
            return array(-1);
        } else {
            return $childs;
        }
    }
    function getChilds($parent_ids, $fk_name, $table_name){
        $this->db->select('id');
        $this->db->from($table_name);
        $this->db->where_in($fk_name, $parent_ids);
        $result = array();
        foreach ($this->db->get()->result() as $row)
        {
            $result[$row->id] = $row->id;
        }
        return $result;
    }
    function getChildByParentId($parent_id, $fk_name, $table_name){
        $this->db->select('id, name');
        $this->db->from($table_name);
        if(isset($parent_id)) {
            $this->db->where($fk_name, $parent_id);
        }
        $result = array();
        foreach ($this->db->get()->result() as $row)
        {
            $result[$row->id] = ["id"=> $row->id, "name" => $row->name];
        }
        return $result;
    }
    function getChildNamesByParentId($parent_id, $fk_name, $table_name){
        $this->db->select('id, name');
        $this->db->from($table_name);
        if(isset($parent_id)) {
            $this->db->where($fk_name, $parent_id);
        }
        $result = array(""=>"");
        foreach ($this->db->get()->result() as $row)
        {
            $result[$row->id] = $row->name;
        }
        return $result;
    }
}

