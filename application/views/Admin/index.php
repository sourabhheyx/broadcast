<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('Admin/include/header.php'); ?>


<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

 <?php $this->load->view('Admin/include/mainheader.php'); ?>
  <!-- Left side column. contains the logo and sidebar -->
 
<?php $this->load->view('Admin/include/sidebar.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="height: 100%;/* min-height: 100%; */">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
<?php  $statususer =  $this->session->userdata['admin_session']['status'];
$id =  $this->session->userdata['admin_session']['user_id'];
if($statususer == '1')
{ ?>


    
   <section class="content">
                	
                 	<div class="row">
                    	<div class="content-inner">
                        	
                            
						<div class="col-lg-3 col-xs-6">
                              <!-- small box -->
                              <div class="small-box bg-green">
                                <div class="inner">
                                  <h3><?php if(!empty($tousers)) { echo count($tousers); }else { echo '0'; } ?></h3>
                    
                                  <p>Total Users</p>
                                </div>
                                <div class="icon">
                                  <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?php echo base_url();?>admin/user/AllUser" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                            </div>
                          
                            <!-- ./col -->
                           
                           
                            
                        </div>
                        
                    </div> <!-- row end -->
                    
                    
                </section>
<?php } ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('Admin/include/footer.php'); ?>

  <!-- Control Sidebar -->
  <?php $this->load->view('Admin/include/rigthsidebar.php'); ?>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<?php $this->load->view('Admin/include/js.php'); ?>

</body>
</html>
