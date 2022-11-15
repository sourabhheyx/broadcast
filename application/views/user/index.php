<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('user/include/header.php'); ?>


<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

 <?php $this->load->view('user/include/mainheader.php'); 
 
 $id =  $this->session->userdata['user_session']['user_id'];
 ?>
  <!-- Left side column. contains the logo and sidebar -->
 
<?php $this->load->view('user/include/sidebar.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="height: 100%;/* min-height: 100%; */">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="row">    
    <div class="content-inner">    
     <div class="box-inner col-lg-12 col-xs-12" >
                            	
                            </div>
     </div>
     </div>
    </section>
<?php  $statususer =  $this->session->userdata['user_session']['status'];


if($statususer == '1')
{ ?>
  
  
  <section class="content">
                	
                 	<div class="row">
                    	<div class="content-inner">
                        	
                            
						  <div class="col-lg-3 col-xs-6">
                              <!-- small box -->
                              <div class="small-box bg-green">
                                <div class="inner">
                                  <h3><?php if(!empty($contact)) { echo count($contact); }else { echo '0'; } ?></h3>
                    
                                  <p>Total Contacts</p>
                                </div>
                                <div class="icon">
                                  <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?php echo base_url();?>user/user/contact_list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                              <!-- small box -->
                              <div class="small-box bg-red">
                                <div class="inner">
                                  <h3><?php if(!empty($delivered)) { echo count($delivered); }else { echo '0'; } ?></h3>
                    
                                  <p>Total Delivered</p>
                                </div>
                                <div class="icon">
                                  <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?php echo base_url();?>user/user/delivered" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                              <!-- small box -->
                              <div class="small-box bg-yellow">
                                <div class="inner">
                                  <h3><?php if(!empty($outgoing)) { echo count($outgoing); }else { echo '0'; } ?></h3>
                    
                                  <p>Total Outgoing</p>
                                </div>
                                <div class="icon">
                                  <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?php echo base_url();?>user/user/outgoing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                              <!-- small box -->
                              <div class="small-box bg-blue">
                                <div class="inner">
                                  <h3><?php if(!empty($failed)) { echo count($failed); }else { echo '0'; } ?></h3>
                    
                                  <p>Total Failed</p>
                                </div>
                                <div class="icon">
                                  <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?php echo base_url();?>user/user/failed" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                            </div>
                            <!-- ./col -->
                          
                            <!-- ./col -->
                           
                           
                            
                        </div>
                        
                    </div> <!-- row end -->
                    
                     
                </section>
<?php } ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('user/include/footer.php'); ?>

  <!-- Control Sidebar -->
  <?php $this->load->view('user/include/rigthsidebar.php'); ?>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<?php $this->load->view('user/include/js.php'); ?>

</body>
</html>
