<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('Admin/include/header.php'); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

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
                  <th>Name</th>
                
                  <th>Email</th>
                  <th>Password</th>
                  <th>Mobile</th>
                  <th>Address</th>
                  <th>Api Key</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               <?php if(!empty($data)){
                  $i=1;
                  foreach ($data as $key => $value) { ?>
                <tr>
                     <td><?php  echo $i++ ?></td>
                      <td><?php echo $value['name'] ?></td>
                     
                      <td><?php echo $value['email'] ?></td>
                      <td><?php echo $value['password'] ?></td>
                      <td><?php echo $value['mobile']  ?></td>
                      <td><?php echo $value['address'] ?></td>
                      <td><?php echo $value['dsix_api_key']  ?></td>
                       <td><?php if($value['status']==1){ ?>
                        <a href="<?php echo base_url() ?>admin/user/activeuser/<?php echo $value['user_id'] ?>" ><span class="label label-primary">Active</span></a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url() ?>admin/user/activeuser/<?php echo $value['user_id'] ?>" ><span class="label  label-danger">Deactive</span></a>
                      <?php } ?></td>
                      <td>
                          <a href="<?php echo base_url() ?>admin/user/Adduser/<?php echo $value['user_id'] ?>" title="EDIT" ><span class="label label-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>
                          &nbsp;
                          <a onclick="return confirm('Are you sure you want to delete this Student?');" href="<?php echo base_url() ?>admin/user/userDelete/<?php echo $value['user_id'] ?>" title="DELETE" ><span class="label label-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></span></a>

                      </td>
                </tr>
               <?php } } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>S.no</th>
                  <th>Name</th>
               
                  <th>Email</th>
                  <th>Password</th>
                  <th>Mobile</th>
                  <th>Address</th>
                  <th>Api Key</th>
                  <th>Status</th>
                  <th>Action</th>
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