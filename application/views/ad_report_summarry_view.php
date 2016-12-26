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
 	echo "Filter Summary";
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
    echo form_open('AdReportSummary',"class='form-inline'");
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
    echo '<label for="type_id">Placement</label> '.form_dropdown('placement_id', array("All Placements"), "");
    echo "</div>";
    echo "&nbsp;&nbsp;";
    echo "<div class=\"form-group\">";
    echo '<label for="type_id">Banner</label> '.form_dropdown('banner_id', array("All Banners"), "");
    echo "</div>";
    echo "&nbsp;&nbsp;";
    echo "<div class=\"form-group\">";
    echo '<label for="type_id">Start Date</label> <input type="text" id="start_date">';
    echo "</div>";
    echo "&nbsp;&nbsp;";
    echo " <div class=\"form-group\">";
    echo '  <label for="lname">End Date</label> <input type="text" id="end_date">';
    echo "</div> ";
    echo form_submit('mysubmit', 'Filter',"class ='btn btn-success'");
    echo form_close();
?>

<?php  if(isset($output))
 print_r($output); ?>
</div> 


<?php //$this->load->view('segments/footer')?>


<script>
  $(function() {
    $( "#start_date" ).datepicker();
  });
  
  $(function() {
    $( "#end_date" ).datepicker();
  });
</script>