<?php $this->load->view('segments/head') ?>
<?php $this->load->view('segments/navigation') ?>
<div id="page-wrapper">
    <?php
        $CI =& get_instance();
        $name = $CI->router->fetch_class();
        echo '<h3>Manage '. $name .'</h3>';
    ?>
    <?php
        $placement = $this->input->get('placementId');
        if(isset($placement) && $placement != null) {
            //$placement_info = $CI->getPlacementInfo($placement);
            echo "<div id='placement_info'>";
            $CI->getPlacementEncodedInfo($placement);
            echo "</div>";
        } else {
            echo "<div id='placement_info'>";
            echo "</div>";
        }
        $banner = $this->input->get('bannerId');
        if (isset($banner) && $banner != null){
            //$banner_info = $CI->getBannerInfo($banner);
            echo "<div id='banner_info'>";
            $CI->getBannerEncodedInfo($banner);
            /*echo "<div id='placement_info'><b>Banner Information: </b>";
            echo "Advertiser - $banner_info->advertiser, ";
            echo "Brand - $banner_info->brand, ";
            echo "Variant - $banner_info->variant, ";
            echo "Campaign - $banner_info->campaign, ";
            echo "Banner Type - $banner_info->type.";
            //print_r($banner_info);
            echo "</div>";*/
        } else {
            echo "<div id='banner_info'>";
            echo "</div>";
        }
    ?>
    <?php echo $output; ?>
</div> 


<?php
//$this->load->view('segments/footer')?>
<script type="text/javascript">
    $(function() {
        $("#field-placement_id").after("<div id='parents1'></div>");
        $("#field-banner_id").after("<div id='parents2'></div>");
    });
    $("select#field-placement_id").change(function(){
      //alert($(this).val());
      var url1 = '<?php echo base_url();?>index.php/BannerPlacement/getPlacementEncodedInfo';
      //alert(url1);
      
      $.ajax({
          type: "POST",
          url: url1,///astarserve/as/index.php/Report/getChildList
          data: {placementId: $(this).val()},
          datatype: "json",
          success: function(data){
            //alert(data);
            /*var options = '<option value=""></option>';
            $.each(data, function(){
                options += '<option value="' + this.id + '">' + this.name + '</option>';
            });*/
            $("#placement_info").html(data);
            //$("#parents1").after(data);
          }
      });
  });
    $("select#field-banner_id").change(function(){
      //alert($(this).val());
      var url2 = '<?php echo base_url();?>index.php/BannerPlacement/getBannerEncodedInfo';
      
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