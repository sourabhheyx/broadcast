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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?php echo $user; ?> Form 
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active"><?php echo $user; ?></li>
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
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $user; ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method = "post" enctype="multipart/form-data" action="">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Enter Name" value="<?php if(!empty($data['name'])){ echo $data['name']; }?>">
                  <?php echo form_error('name'); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" name= "email" placeholder="Enter email" value="<?php if(!empty($data['email'])){ echo $data['email']; }?>">
                  <?php echo form_error('email'); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Mobile No.</label>
                  <input type="number" class="form-control" id="exampleInputEmail1" name = "mobile" placeholder="Enter Mobile No." value="<?php if(!empty($data['mobile'])){ echo $data['mobile']; }?>">
                  <input type="hidden" class="form-control" id="exampleInputEmail1" name = "old_mobile" placeholder="Enter Mobile No." value="<?php if(!empty($data['mobile'])){ echo $data['mobile']; }?>">
                  <?php echo form_error('mobile'); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name= "username" placeholder="Enter Username" value="<?php if(!empty($data['username'])){ echo $data['username']; }?>">
                  <?php echo form_error('username'); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" name= "password" placeholder="Password" value="<?php if(!empty($data['password'])){ echo $data['password']; }?>">
                <?php echo form_error('password'); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="file" id="exampleInputFile" name ="image">

                  <p class="help-block">Example block-level help text here.</p>
                </div>
                <div class="form-group">
                    <img src ="<?php echo base_url(); ?>uploads/<?php if(!empty($data['username'])){ echo $data['image']; }?>" height= "80px" width= "80px" >
                </div>  
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
             <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->


        </div>
        <!--/.col (left) -->
        <!-- right column -->
       
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
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

<?php $this->load->view('Admin/include/js.php'); ?>
</body>
</html>
