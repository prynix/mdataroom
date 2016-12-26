<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class BannerPlacementModel extends CI_Model {
    public function activate($id) {
        $data = array('active' => 1);
        $this->db->where('id', $id);
        $this->db->update('banner_placement', $data);
    }
    public function deactivate($id) {
        $data = array('active' => 0);
        $this->db->where('id', $id);
        $this->db->update('banner_placement', $data);
    }
    public function getActive($id) {
        $this->db->select('active');
        $this->db->from('banner_placement');
        $this->db->where('id', $id);
        $result = array();
        foreach ($this->db->get()->result() as $row)
        {
            return $row->active;
        }
    }
}

