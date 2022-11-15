<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('user/include/header.php'); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php $this->load->view('user/include/mainheader.php'); ?>
  <!-- Left side column. contains the logo and sidebar -->
 
  <?php $this->load->view('user/include/sidebar.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $pagetitle; ?> Form
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
      <!-- left column -->
      <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
          <div class="box-header with-border">
              <h3 class="box-title"><?php echo $pagetitle; ?></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
        <form role="form" action="" method="post" autocomplete="off">
          <div class="box-body">
              <div class="col-md-3">
                <div class="form-group">
                  <label>First Name</label>
                  <input class="form-control" placeholder="Enter Name" type="text" name="first_name" value="<?php if(!empty($update)) { echo $update['first_name']; } else { echo set_value('first_name'); } ?>">
                  <?php echo form_error('first_name'); ?>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Last Name</label>
                  <input class="form-control" placeholder="Enter Name" type="text" name="last_name" value="<?php if(!empty($update)) { echo $update['last_name']; } else { echo set_value('last_name'); } ?>">
                  <?php echo form_error('last_name'); ?>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Email </label>
                  <input class="form-control" placeholder="Enter Email" type="email" name="email" value="<?php if(!empty($update)) { echo $update['email']; } else { echo set_value('email'); } ?>">
                  <?php echo form_error('email'); ?>
                </div>
              </div>
            
              <div class="col-md-3">
                <div class="form-group">
                  <label>Mobile </label>
                  <input class="form-control" placeholder="Enter Mobile" type="text" name="phone" value="<?php if(!empty($update)) { echo $update['phone']; } else { echo set_value('phone'); } ?>">
                  <?php echo form_error('phone'); ?>
                </div>
              </div>
             
             
              <div class="col-md-3">
                <div class="form-group">
                  <label>Tags </label>
                  <input class="form-control" autocomplete="off" placeholder="Enter address" type="text" name="tags" value="<?php if(!empty($update)) { echo $update['tags']; } else { echo set_value('tags'); } ?>">
                  <?php echo form_error('tags'); ?>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Save</button>
              <a href="<?php echo base_url('') ?>" class="btn btn-warning">Back</a>
            </div>
          </form> 
        </div>
        </div>
    </div>  
  </section> 

   
 </div>     
<?php $this->load->view('user/include/footer.php'); ?>

  <!-- Control Sidebar -->
<?php $this->load->view('user/include/rigthsidebar.php'); ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php $this->load->view('user/include/js.php'); ?>
</body>
</html>      