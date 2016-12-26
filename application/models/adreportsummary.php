<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class AdReportSummary extends CI_Model{
    function getRequestCountByBannerPlacement($banner_id, $placement_id){
        $this->db->select_sum('request');
        $this->db->select_sum('impression');
        $this->db->select_sum('click');
        $this->db->from('ad_report_summary');
        $this->db->where('banner_id', $banner_id);
        $this->db->where('placement_id', $placement_id);
        //print_r($_POST);
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        //echo $start_date . ' '. $end_date;
        if(isset($start_date) && $start_date != NULL && isset($end_date) && $end_date != NULL) {
            $this->db->where("summary_date >= ", $start_date);
            $this->db->where("summary_date <= ", $end_date);
        }
        $this->db->limit(1);
        $request = 0;
        foreach ($this->db->get()->result() as $row)
        {
            return $row;
        }
        //return $request;
    }
}

