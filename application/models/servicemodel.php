<?php

class servicemodel extends CI_Model {

   

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function getInformation($bannnerId=NULL)
    {
        if($bannnerId!=NULL){
            
            $this->db->select('*');
            $this->db->from('banner');
            $this->db->where('id', $bannnerId); 
            $query = $this->db->get();

            if ($query->num_rows() > 0)
            {
                return $row = $query->first_row();
            } 
            else{
                return false;
            }
        }
        else{
            return false;
        }
        
    }
    
    function updateClickBangladeshRecord($placementId,$bannerId){
           
        try{
                $date = gmDate("Y-m-d",time()+(6*3600));
                
                $this->db->where('placement_id', $placementId);
                $this->db->where('banner_id', $bannerId);
                $this->db->where('summary_date',$date);
                $this->db->set('click','click+1', FALSE);
                $this->db->set('click_bangladesh','click_bangladesh+1', FALSE);
                $this->db->update('ad_report_summary');
        }
        catch(Exception $e){
                die();
        }
    }
    
    function updateClickOtherRecord($placementId,$bannerId){
           
        try{
                $date = gmDate("Y-m-d",time()+(6*3600));
                
                $this->db->where('placement_id', $placementId);
                $this->db->where('banner_id', $bannerId);
                $this->db->where('summary_date',$date);
                $this->db->set('click','click+1', FALSE);
                $this->db->set('click_other','click_other+1', FALSE);
                $this->db->update('ad_report_summary');
        }
        catch(Exception $e){
                die();
        }
    }
    
    function updateBannerRecord($placementId,$bannerId,$country){
           
        try{
                $date = gmDate("Y-m-d",time()+(6*3600)); 
                
                $this->db->where('placement_id', $placementId);
                $this->db->where('banner_id', $bannerId);
                $this->db->where('summary_date',$date);
                //$this->db->where('country',$country);
                $this->db->set('click','click+1', FALSE);
                $this->db->update('ad_report_summary');
        }
        catch(Exception $e){
                die();
        }
    }
    
    function updateClickRecord($placementId,$bannerId,$country){
        if($country=='Bangladesh'||$country==NULL){
            $this->updateClickBangladeshRecord($placementId, $bannerId);
        }
        else{
            $this->updateClickOtherRecord($placementId, $bannerId);
        }
    }
    
    
    function getPlacementKey($id){
        $this->db->where('id',$id);
        $this->db->from('placement');
        $query=$this->db->get();
        return $query->first_row()->key;
    }
    
    function updateRequestRecord($placementId,$bannerId,$country){
           $date = gmDate("Y-m-d",time()+(6*3600));
            //echo $date;
            //die();
            
            $this->db->select('id');
            $this->db->from('ad_report_summary');
            $this->db->where('placement_id', $placementId);
            $this->db->where('banner_id', $bannerId);
           // $this->db->where('country',$country);
            $this->db->where('summary_date',$date);
                    
            $query = $this->db->get();
             

            if ($query->num_rows() > 0)
            {
                $this->db->where('placement_id', $placementId);
                $this->db->where('banner_id', $bannerId);
                $this->db->where('summary_date',$date);
                //$this->db->where('country',$country);
                $this->db->set('request','request+1', FALSE);
                $this->db->update('ad_report_summary');
                                
            }
            else{
                
                /*$this->db->select('*');
                $this->db->from('banner_placement');
                $this->db->where('placement_id', $placementId);
                $this->db->where('banner_id', $bannerId);                
                $query2 = $this->db->get();
                */
                
                
                //if($query2->num_rows()>0){
                    
                    $data=array(
                        'banner_id'=>$bannerId,
                        'placement_id'=>$placementId,
                        'click'=>0,
                        'request'=>1,
                        'impression'=>0,
                        'summary_date'=>$date
                        //'country'=>$country
                    );

                    //print_r($data);
                    
                    $this->db->insert('ad_report_summary',$data);
                
                //}
            }
            
            
          
            //echo $this->db->last_query();            
          //  die();
        
    }
    
    function updateBangladeshImpressionRecord($placementId,$bannerId){
        
        $date = gmDate("Y-m-d",time()+(6*3600));
        
        try{                    
                $this->db->where('placement_id', $placementId);
                $this->db->where('banner_id', $bannerId);
                $this->db->where('summary_date',$date);                
                $this->db->set('impression','impression+1', FALSE);
                $this->db->set('impression_bangladesh','impression_bangladesh+1', FALSE);
                $this->db->update('ad_report_summary');
        }
        catch(Exception $e){
                die();
        }
        
        echo $this->db->last_query();

    }
    
    function updateOtherImpressionRecord($placementId,$bannerId){
        
        $date = gmDate("Y-m-d",time()+(6*3600)); 
        
        try{                    
                $this->db->where('placement_id', $placementId);
                $this->db->where('banner_id', $bannerId);
                $this->db->where('summary_date',$date);         
                $this->db->set('impression','impression+1', FALSE);
                $this->db->set('impression_other','impression_other+1', FALSE);
                $this->db->update('ad_report_summary');
        }
        catch(Exception $e){
                die();
        }
        
        //echo $this->db->last_query();

    }
    
    function updateImpressionRequestRecord($placementId,$bannerId,$country){
        
        if($country=='Bangladesh'||$country==NULL){
            $this->updateBangladeshImpressionRecord($placementId, $bannerId);
        }
        else{
            $this->updateOtherImpressionRecord($placementId, $bannerId);
        }

    }
    
    function updateImpressionRecord($placementId,$bannerId,$country){
        
        $date = gmDate("Y-m-d",time()+(6*3600)); 
        
        try{                    
                $this->db->where('placement_id', $placementId);
                $this->db->where('banner_id', $bannerId);
                $this->db->where('summary_date',$date);                
                $this->db->where('country',$country);
                $this->db->set('impression','impression+1', FALSE);
                
                $this->db->update('ad_report_summary');
        }
        catch(Exception $e){
                die();
        }
    }
    
    
        
    
    function getPlacementId($placementTest){
        $this->db->where('md5(id)',$placementTest);
        $this->db->from('placement');
        $query=$this->db->get();
        return $query->first_row();
    }
                
    function getPlacementById($placementId){
        $this->db->where('id',$placementId);
        $this->db->from('placement');
        $query=$this->db->get();
        return $query->first_row();
    }
    
    function loadDefaultBanner($placementId,$deviceType){
        $this->db->where('id',$placementId);
        $this->db->from('placement');
        $query=$this->db->get();
        return $query->first_row()->default_banner_id;
       
    }
    
    function updateLog($data){
        $this->db->insert('ad_record',$data);
    }
    
    function getplacementidByKey($key){
        $this->db->where('key',$key);
        $this->db->from('placement');
        $query=$this->db->get();
        return $query->first_row()->id;
    }
    
    function getTotalImpression($placementId,$bannerId){
        $this->db->select_sum('impression');
        $this->db->where('placement_id',$placementId);
        $this->db->where('banner_id',$bannerId);
        $query = $this->db->get('ad_report_summary');
        
        if($query->num_rows>0)
            return $query->first_row()->impression;
        return 0;
    }
    
}