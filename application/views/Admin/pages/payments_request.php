<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('Admin/include/header.php'); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper" style="height: 100%;">

  <?php $this->load->view('Admin/include/mainheader.php'); ?>
  <!-- Left side column. contains the logo and sidebar -->
 
  <?php $this->load->view('Admin/include/sidebar.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $pagetitle; ?> 
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active"><?php echo $pagetitle; ?> Elements</li>
      </ol>
    </section>

    <!-- Main content -->
   
    <!-- Main content -->
     <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <?php if($this->session->flashdata('success_message')){ ?>
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i> Success!</h4>
              <?php echo $this->session->flashdata('success_message') ?>
            </div>
          <?php } ?> 
          <?php if($this->session->flashdata('error_message')){ ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                <?php echo $this->session->flashdata('error_message') ?>
            </div>
          <?php } ?>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo $List; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.no</th>
            
                  <th>User Id</th>
                  <th>User Name</th>
                  <th>Payment Mode</th>
                  <th>Mobile/UPI ID</th>
                  <th>Account Name</th>

                  <th>Amount</th>
                  <th>Created Date</th>
                  <th>Status</th>
                  <td>ACtion</td>
                </tr>
                </thead>
                <tbody>
               <?php if(!empty($data)){
                  $i=1;
                  foreach ($data as $key => $value) { ?>
                <tr>
                      <td><?php  echo $i++ ?></td>
                      <td><?php echo $value['user_id'] ?></td>
                      <td><?php echo $this->adminmodel->getwheres('users',array('user_id'=>$value['user_id']))['name'] ?></td>
                      <td><?php echo $value['payment_type'] ?></td>
                      <td><?php echo $value['payment_account'] ?></td>
                      <td><?php echo $value['account_name'] ?></td>
                      <td><?php echo $value['amount'] ?></td>
                      <td><?php echo $value['created_date'] ?></td>

                      <td><?php if($value['status']==1){ ?>
                       <span class="label label-primary">Approve</span>
                      <?php }else if($value['status']==2){ ?>
                        <span class="label label-primary">Decline</span>
                      <?php } else{ ?>
                        <span class="label  label-danger">Pending</span>
                      <?php } ?></td>


                       <td><?php if($value['status']==0){ ?>
                        <a href="<?php echo base_url() ?>admin/user/approve_decline_pay/<?php echo $value['id'] ?>/1" ><span class="label label-primary">Approve</span></a>
                        <a href="<?php echo base_url() ?>admin/user/approve_decline_pay/<?php echo $value['id'] ?>/2" ><span class="label label-danger">Decline</span></a>
                      <?php } else if($value['status']==1){ ?>
                       <span class="label label-primary">Approve</span>
                      <?php }else if($value['status']==2){ ?>
                        <span class="label label-danger">Decline</span>
                      <?php } ?></td>

                </tr>
               <?php } } ?>
                </tbody>
                <tfoot>
                <tr>
                 <th>S.no</th>
                  <th>User Id</th>
                  <th>User Name</th>
                  <th>Payment Mode</th>
                  <th>Mobile/UPI ID</th>
                  <th>Account Name</th>

                  <th>Amount</th>
                  <th>Created Date</th>
                  <th>Status</th>
                  <td>ACtion</td>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
 </div>     
<?php $this->load->view('Admin/include/footer.php'); ?>

  <!-- Control Sidebar -->
<?php $this->load->view('Admin/include/rigthsidebar.php'); ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php $this->load->view('Admin/include/js.php'); ?>
</body>
</html>      