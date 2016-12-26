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
//$this->load->view('segments/footer')?>