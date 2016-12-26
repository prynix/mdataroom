<?php $this->load->view('segments/head') ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $headerTitle;?></h1>
                <h3><?php echo $placement_name;?></h3>
                <h4><?php echo $caption;?></h4>
               
                
                <div id="palo_1" class="astar_serve" style="height: 100px; width: 336px;">
                    <a target="blank" href="<?php echo $target_url?>">
                        <img width="<?php echo $placement_width?>" height="<?php echo $placement_height?>" src="<?php echo $content_url?>" alt="<?php $caption?>">
                    </a>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->


<?php $this->load->view('segments/footer') ?>
