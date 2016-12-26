<?php $this->load->view('segments/head') ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $headerTitle; ?></h1>
                <h3><?php echo $placement_name; ?></h3>
                <h4><?php echo $caption; ?></h4>
                
                <div id="palo_3" class="astar_serve" style="height: 80px; width: 336px;">
                    <div style="position:absolute;"><div style="position:absolute;">
                            <a href="<?php echo $target_url;?>" target="_blank">
                                <img src="<?php echo dirname(base_url());?>/_FILES/Transparent.gif" width="<?php echo $placement_width?>" height="<?php echo $placement_height?>">
                            </a>
                        </div>
                        <div>
                            <object type="application/x-shockwave-flash" data="<?php echo $content_url?>" width="<?php echo $placement_width?>" height="<?php echo $placement_height?>">
                                <param name="flashvars" value="clickTag=&amp;clickTarget=_self">
                                <param name="allowScriptAccess" value="always">
                                <param name="movie" value="<?php echo $content_url?>">
                                <param name="wmode" value="transparent">
                            </object>
                        </div>
                    </div>
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
