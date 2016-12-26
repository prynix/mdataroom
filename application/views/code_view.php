<?php $this->load->view('segments/head')?>
<?php $this->load->view('segments/navigation')?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">If publisher allows js use Snippet 1 otherwise Snippet 2</h1>
                     	<h2>Snippet 1</h2>
                        <?php echo '<pre><XMP>'.$code2.'</XMP></pre>';?>
                     	<h2>Snippet 2</h2>
                        <?php echo '<pre><XMP>'.$code.'</XMP></pre>';?>
                        
                        
                        <!--
                        <?php echo '<pre><XMP>'.$code.'</XMP></pre>';?>-->
                        <?php //echo '<pre><XMP>'.$code1.'</XMP><XMP>'.$code2.'</XMP>'.'<XMP>'.$code3.'</XMP><XMP>'.$code4.'</XMP></pre>';?>

                        <?php //<h2>Add this code at the end of your page's html body.</h2> ?>
                     	<?php //echo '<pre><XMP>'.$code2.'</XMP></pre>';?>
                     	<!--<div id="my_magic_xss" />
                     	<script src="http://drnicwilliams.com/wp-content/uploads/2006/11/xss_magic.js"></script>
                     	
                     	
                     	
                    --></div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->


<?php $this->load->view('segments/footer')?>
