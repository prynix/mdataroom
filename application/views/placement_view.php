<style>
img {
    display: block;
    max-width:200px;
    max-height:150px;
    width: auto;
    height: auto;
}
</style>
<?php $this->load->view('segments/head') ?>
<?php $this->load->view('segments/navigation') ?>
<div id="page-wrapper">
    <?php
        $CI =& get_instance();
        $name = $CI->router->fetch_class();
        echo '<h3>Manage '. $name .'</h3>';
    ?>
    <?php echo $output; ?>
</div> 


<?php
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
//$this->load->view('segments/footer')?>
<script type="text/javascript">
    $(function() {
        //$("#field-placement_id").after("<div id='parents1'></div>");
        $("#field-default_banner_id").after("<div id='parents2'></div>");
    });
    $("select#field-default_banner_id").change(function(){
      //alert($(this).val());
      var url2 = '<?php echo base_url();?>index.php/Placement/getBannerEncodedInfo';
      
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
            //alert($(this).val());
            //alert(data);
            $("#parents2").html(data);
          }
      });
  });
</script>