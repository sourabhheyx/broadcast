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
                  <label>Title</label>
                  <input class="form-control" placeholder="Enter Title" type="text" name="title" value="<?php if(!empty($update)) { echo $update['title']; } else { echo set_value('title'); } ?>">
                  <?php echo form_error('title'); ?>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Product Qty </label>
                  <input class="form-control" placeholder="Enter Product Qty" type="text" name="product_upload" value="<?php if(!empty($update)) { echo $update['product_upload']; } else { echo set_value('product_upload'); } ?>">
                  <?php echo form_error('product_upload'); ?>
                </div>
              </div>
            
              <div class="col-md-3">
                <div class="form-group">
                  <label>Package Type </label>
                  <select name="membership_type" id="membership_type" class="form-control">
                    <option value="">--Select--</option>
                     <option value="1" <?php if(!empty($update['membership_type']))  { echo (set_value('membership_type', $update['membership_type'])==1)?"selected":''; } ?>> Monthly </option>
                     <option value="2" <?php if(!empty($update['membership_type']))  { echo (set_value('membership_type', $update['membership_type'])==2)?"selected":''; } ?>> Yealy </option>
                     <option value="3" <?php if(!empty($update['membership_type']))  { echo (set_value('membership_type', $update['membership_type'])==3)?"selected":''; } ?>> Part Time</option>
                  </select>
                  <?php echo form_error('membership_type'); ?>
                </div>
              </div>
             
              <div class="col-md-3">
                <div class="form-group">
                  <label>Amount </label>
                  <input class="form-control" autocomplete="off" placeholder="Enter Password" type="text" name="membership_amt" value="<?php if(!empty($update)) { echo $update['membership_amt']; } else { echo set_value('membership_amt'); } ?>">
                  <?php echo form_error('membership_amt'); ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Description </label>
                  <textarea class="form-control" autocomplete="off" placeholder="Enter Description" type="text" name="description"><?php if(!empty($update)) { echo $update['description']; } else { echo set_value('description'); } ?></textarea>
                  <?php echo form_error('description'); ?>
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
                  <th>Title</th>
                  <th>Description</th>
                  <th>Product Qty</th>
                  <th>Package Type</th>
                  <th>Amount</th>
                  <th>Date</th>
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
    
                      <td><?php echo $value['title'] ?></td>
                      <td><?php echo $value['description'] ?></td>
                      <td><?php echo $value['product_upload'] ?></td>
                      <td><?php if($value['membership_type'] == 1) { echo 'Monthly'; }else if($value['membership_type'] == 2){ echo 'Yealy'; }else{ echo 'Part Time'; }  ?></td>
                      <td><?php echo $value['membership_amt']  ?></td>
                      <td><?php echo $value['date']  ?></td>
                     <td><?php if($value['status']==1){ ?>
                        <a href="<?php echo base_url() ?>admin/master/active_membership/<?php echo $value['id'] ?>" ><span class="label label-primary">Active</span></a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url() ?>admin/master/active_membership/<?php echo $value['id'] ?>" ><span class="label  label-danger">Deactive</span></a>
                      <?php } ?></td>
                      <td>
                          <a href="<?php echo base_url() ?>admin/master/membership/<?php echo $value['id'] ?>" title="EDIT" ><span class="label label-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>
                          &nbsp;
                          <a onclick="return confirm('Are you sure you want to delete this membership?');" href="<?php echo base_url() ?>admin/user/membershipDelete/<?php echo $value['id'] ?>" title="DELETE" ><span class="label label-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></span></a>

                      </td>
                </tr>
               <?php } } ?>
                </tbody>
                <tfoot>
                <tr>
                 <th>S.no</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Product Qty</th>
                  <th>Package Type</th>
                  <th>Amount</th>
                  <th>Date</th>
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