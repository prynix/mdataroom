<?php

class schedularmodel extends CI_Model {

   

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function getBannersInfo($placement_id,$timeStamp,$device){
                                         
            $devices = array($device,'9');

            $this->db->select('*');
            $this->db->from('banner_placement');
            $this->db->where('placement_id',$placement_id);
            $this->db->where_in('device_id',$devices);
            $this->db->where('UNIX_TIMESTAMP(start_time) <=',$timeStamp);
            $this->db->where('UNIX_TIMESTAMP(end_time) >=',$timeStamp);
            $this->db->where('active',1);
            
            $query = $this->db->get();
            
            //echo $this->db->last_query();
            
            if($query->num_rows()==0)return false;
            
            
            
            return $query;
            
            
    }

}