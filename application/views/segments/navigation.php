<body>
    <style>
        .sidebar ul li a.active{
            background-color: #DDF;
        }
    </style>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">mDataRoom</a>
            </div>
            <!-- /.navbar-header -->

<?php $this->load->view('segments/notification_bar');?>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <!--<li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                             /input-group 
                        </li>
                        -->
                        
                        <?php 
                        $CI =& get_instance();
                        //$name = $CI->router->fetch_class();
                        //echo $name;
                        $CI->load->helper('auth_helper');
                        //$priviledge = get_priviledge_level();	
                        $pid = is_logged_in();
                        $user_role = get_user_role();
                        ?>

                        <?php
                        if($pid!=false) 
                        {
                        ?>
                        
                        	                        <li >
	                            <a class="<?php if($this->uri->segment(1)=="welcome"){echo "active";}?>" href="<?=site_url('welcome');?>"><i class="fa fa-dashboard fa-fw"></i>Home</a>
	                        </li>
                                <?php 
                            if($user_role === 'admin' || $user_role === 'user' ){
                                if($user_role == 'admin'){?>
	                        
	                        <li>
	                            <a class="<?php if($this->uri->segment(1)=="User"){echo "active";}?>" href="<?=site_url('User');?>"><i class="fa fa-table fa-fw"></i> Manage User</a>
	                        </li>
                                <li>
	                            <a class="<?php if($this->uri->segment(1)=="Advertiser"){echo "active";}?>" href="<?=site_url('Advertiser');?>"><i class="fa fa-table fa-fw"></i> Advertiser</a>
	                        </li>
                            <?php }?>
	                       
	                        
	                        <li>
	                            <a class="<?php if($this->uri->segment(1)=="Brand"){echo "active";}?>" href="<?=site_url('Brand');?>"><i class="fa fa-table fa-fw"></i>Brand</a>
	                        </li>
	                       
	                        
	                        <li>
	                            <a class="<?php if($this->uri->segment(1)=="Variant"){echo "active";}?>" href="<?=site_url('Variant');?>"><i class="fa fa-table fa-fw"></i>Variant</a>
	                        </li>
	                       
	                        
	                        <li>
	                            <a class="<?php if($this->uri->segment(1)=="Campaign"){echo "active";}?>" href="<?=site_url('Campaign');?>"><i class="fa fa-table fa-fw"></i>Campaign</a>
	                        </li>
	                       
	                        
	                        <li>
	                            <a class="<?php if($this->uri->segment(1)=="Payment"){echo "active";}?>" href="<?=site_url('Payment');?>"><i class="fa fa-table fa-fw"></i>Payment</a>
	                        </li>
	                       
	                        
	                        <li>
	                            <a class="<?php if($this->uri->segment(1)=="Banner"){echo "active";}?>" href="<?=site_url('Banner');?>"><i class="fa fa-table fa-fw"></i>Banner</a>
	                        </li>
	                       
	                        
	                        <li>
	                            <a class="<?php if($this->uri->segment(1)=="Publisher"){echo "active";}?>" href="<?=site_url('Publisher');?>"><i class="fa fa-table fa-fw"></i>Publisher</a>
	                        </li>
	                       
	                        
	                        <li>
	                            <a class="<?php if($this->uri->segment(1)=="Placement"){echo "active";}?>" href="<?=site_url('Placement');?>"><i class="fa fa-table fa-fw"></i>Placement</a>
	                        </li>
	                       
	                        
	                        <li>
	                            <a class="<?php if($this->uri->segment(1)=="BannerPlacement"){echo "active";}?>" href="<?=site_url('BannerPlacement');?>"><i class="fa fa-table fa-fw"></i>Banner Placement</a>
	                        </li>
	                       
	                        
	                        <!--<li>
	                            <a href="<?=site_url('AdRecord');?>"><i class="fa fa-table fa-fw"></i>Ad Record</a>
	                        </li>-->
	                       
	                        
	                        <!--<li>
	                            <a href="<?=site_url('AdReportSummary');?>"><i class="fa fa-table fa-fw"></i>Ad Report Summary</a>
	                        </li>-->
                        <?php }?>
                                <li>
	                            <a class="<?php if($this->uri->segment(1)=="Report"){echo "active";}?>" href="<?=site_url('Report');?>"><i class="fa fa-table fa-fw"></i> Report</a>
	                        </li>
                                <li>
	                            <a class="<?php if($this->uri->segment(1)=="Profile"){echo "active";}?>" href="<?=site_url('Profile');?>"><i class="fa fa-table fa-fw"></i> Profile</a>
	                        </li>
                                <li>
	                            <a class="<?php if($this->uri->segment(1)=="logout"){echo "active";}?>" href="<?=site_url('logout');?>"><i class="fa fa-table fa-fw"></i> Log Out</a>
	                        </li>
                        <?php } else {?><li>
	                            <a class="<?php if($this->uri->segment(1)=="login"){echo "active";}?>" href="<?=site_url('login');?>"><i class="fa fa-table fa-fw"></i> Login</a>
	                        </li>
                        <?php }?>
 
                        
					
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
