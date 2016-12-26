<?php $this->load->view('segments/head') ?>
<?php $this->load->view('segments/navigation') ?>
<div id="page-wrapper">
    <?php
        $CI =& get_instance();
        $name = $CI->router->fetch_class();
        echo '<h3>Manage '. $name .'</h3>';
    ?>
    <?php
        $campaign_id = $this->input->get('campaign_id');
        if(isset($campaign_id) && $campaign_id != null) {
            //$placement_info = $CI->getPlacementInfo($placement);
            echo "<div id='campaign_info'>";
            $CI->getCampaignEncodedInfo($campaign_id);
            echo "</div>";
        } else {
            echo "<div id='campaign_info'>";
            echo "</div>";
        }
    ?>
    <?php echo $output; ?>
</div> 


<?php
//$this->load->view('segments/footer')?>
<script type="text/javascript">
    $(function() {
        $("#field-campaign_id").after("<div id='parents1'></div>");
    });
    $("select#field-campaign_id").change(function(){
      //alert($(this).val());
      var url1 = '<?php echo base_url();?>index.php/Banner/getCampaignEncodedInfo';
      //alert(url1);
      
      $.ajax({
          type: "POST",
          url: url1,///astarserve/as/index.php/Report/getChildList
          data: {campaign_id: $(this).val()},
          datatype: "json",
          success: function(data){
            //alert(data);
            /*var options = '<option value=""></option>';
            $.each(data, function(){
                options += '<option value="' + this.id + '">' + this.name + '</option>';
            });*/
            $("#campaign_info").html(data);
            //$("#campaign_info").html("asas");
            //$("#parents1").after(data);
          }
      });
  });
    $("select#field-banner_id").change(function(){
      //alert($(this).val());
      var url2 = '<?php echo base_url();?>index.php/BannerPlacement/getCampaignEncodedInfo';
      
      $.ajax({
          type: "POST",
          url: url2,///astarserve/as/index.php/Report/getChildList
          data: {bannerId: $(this).val()},
          datatype: "json",
          success: function(data){
              //alert(data);
            /*var options = '<option value=""></option>';
            $.each(data, function(){
                options += '<option value="' + this.id + '">' + this.name + '</option>';
            });*/
            $("#banner_info").html(data);
          }
      });
  });
</script>