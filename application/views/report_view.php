<?php $this->load->view('segments/head')?>
<?php $this->load->view('segments/navigation')?>
 <div id="page-wrapper">                        
 <h3> 
 <?php 
 
 
 //$lname = $CI->get_lname();
 //$type_id = $CI->get_type_id();
 //$type_name = $CI->get_type_name();
 
 if(isset($output))
 {
 	echo "Report";
 	//if(isset($lname) && !empty($lname)) echo " from Location: ". $lname;
 }
 else 
 {
 	//echo "Filter Items";
 }
 ?>
 </h3>
<?php  
//echo form_open('items_location',array('method'=>'get'));
    echo form_open('Report',"class='form-inline'");
    $CI =& get_instance();
    //$locations = $CI->get_locations();
    //print_r($locations);
    //$types = $CI ->get_types();
    
    //print_r($types);
/*    echo "<div class=\"form-group\">";
    echo '<label for="type_id">Type</label> '.form_dropdown('type_id', $types, $type_id);
    echo "</div>";
    echo " <div class=\"form-group\">";
    echo '  <label for="lname">Location</label> '.form_dropdown('lname', $locations, $lname);
    echo "</div> ";*/
    echo "<div class=\"form-group\">";
    $CI =& get_instance();
    $advertiserList = $CI->getAdvertiserList();
    $brandList = $CI->getChildNameList("advertiser_id", "brand");
    $variantList = $CI->getChildNameList("brand_id", "variant");
    $campaignList = $CI->getChildNameList("variant_id", "campaign");
    $errors = $CI->getErrors();
    echo '<label for="type_id">Advertiser</label> '.form_dropdown('advertiser_id', $advertiserList, $this->input->post('advertiser_id'), 'style="width: 150px; font-size: 13px", id="advertiser_id"');
    echo "</div>";
    echo "&nbsp;&nbsp;";
    echo "<div class=\"form-group\">";
    echo '<label for="type_id">Brand</label> '.form_dropdown('brand_id', $brandList, $this->input->post('brand_id'), 'style="width: 150px; font-size: 13px", id="brand_id"');
    echo "</div>";
    echo "&nbsp;&nbsp;";
    echo "<div class=\"form-group\">";
    echo '<label for="type_id">Variant</label> '.form_dropdown('variant_id', $variantList, $this->input->post('variant_id'), 'style="width: 200px; font-size: 13px", id="variant_id"');
    echo "</div>";
    echo "&nbsp;&nbsp;";
    echo "<div class=\"form-group\">";
    echo '<label for="type_id">Campaign</label> '.form_dropdown('campaign_id', $campaignList, $this->input->post('campaign_id'), 'style="width: 200px; font-size: 13px", id="campaign_id"');
    echo "</div>";
    echo "&nbsp;&nbsp;";
    echo "<br \>";
    echo " <div class=\"form-group\">";
    $start_date = array(
        'name' => 'start_date',
        'id' => 'start_date',
        //'type' => 'date',
    );
    echo '  <label for="lname">Start Date</label> '.form_input($start_date, set_value('start_date', $this->input->post('start_date')));
    echo "</div> ";
    echo "&nbsp;&nbsp;";
    echo " <div class=\"form-group\">";
    $end_date = array(
        'name' => 'end_date',
        'id' => 'end_date',
        //'type' => 'date',
    );
    echo '  <label for="lname">End Date</label> '.form_input($end_date, set_value('end_date', $this->input->post('end_date')));
    echo "</div> ";
    echo form_submit('mysubmit', 'View Report',"class ='btn btn-success', style=\"margin:10px\"");
    echo form_submit('print', 'Print Report',"class ='btn btn-success', style=\"margin:10px\", id='print', onclick=\"this.form.target='_blank';return true;\"");
    $CI =& get_instance();
    $CI->load->helper('auth_helper');
    //$priviledge = get_priviledge_level();	
    $pid = is_logged_in();
    $user_role = get_user_role();
    if($user_role === 'admin' || $user_role === 'user' ){
        echo form_submit('dump', 'Dump Data',"class ='btn btn-success', style=\"margin:10px\", id='dump', onclick=\"this.form.target='_blank';return true;\"");
    }
    echo form_close();
    echo "$errors";
?>

<?php
if(isset($output)){
    print_r($output);
}?>
</div> 


<?php //$this->load->view('segments/footer')?>


<script type="text/javascript" src="<?php echo base_url();?>js/Report.js">
</script>