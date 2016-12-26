<?php $this->load->view('segments/head') ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $headerTitle;?></h1>
                <h3><?php echo $placement_name;?></h3>
                <h4><?php echo $caption;?></h4>
                
                <div id="palo_1" class="astar_serve" >
                    <iframe src="<?php echo $content_url; ?>" 
                            width="<?php echo $placement_width?>" 
                            height="<?php echo $placement_height;?>"
                            border="0"
                            scrolling="yes"
                            allowtransparency="true"
                            style="border:0;"
                            >
                    </iframe>
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
