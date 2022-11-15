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
        <form role="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
          <div class="box-body">
               <div class="col-md-4">
                <div class="form-group">
                  <label>Product Type</label>
                  <select name="product_type" class="form-control">
                    <option value="">--Select--</option>
                    <?php 

                    if(!empty($product_type)){
                      foreach ($product_type as $key => $types) { ?>
                      <option value="<?php echo $types['id'] ?>" <?php if(!empty($update['product_type']))  { echo (set_value('product_type', $update['product_type'])==$types['id'])?"selected":''; } ?>> <?php echo $types['product_type']; ?> </option>
                      <?php }
                      } ?>
                  </select>
                  <?php echo form_error('product_type'); ?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Category</label>
                  <input class="form-control" placeholder="Enter Category" type="text" name="category" value="<?php if(!empty($update)) { echo $update['category']; } else { echo set_value('category'); } ?>">
                  <?php echo form_error('category'); ?>
                </div>
              </div>
              
               <div class="col-md-4">
                <div class="form-group">
                  <label>Image</label>
                  <input class="form-control" placeholder="Enter Category" type="file" name="image" >
                  <input class="form-control" placeholder="Enter Category" type="hidden" name="oldimage" value="<?php if(!empty($update)) { echo $update['image']; } else { echo set_value('image'); } ?>">
                  <?php echo form_error('category'); ?>
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
                  <th>Product Type</th>
                  <th>Category</th>
                  <th>Image</th>
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
                      <td><?php echo $this->adminmodel->getwheres('product_type',array('id'=>$value['product_type']))['product_type']; ?></td>
                      <td><?php echo $value['category'] ?></td>
                      <td><?php echo $value['image'] ?></td>
                      <td><?php if($value['status']==1){ ?>
                        <a href="<?php echo base_url() ?>admin/master/active_category/<?php echo $value['id'] ?>" ><span class="label label-primary">Active</span></a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url() ?>admin/master/active_category/<?php echo $value['id'] ?>" ><span class="label  label-danger">Deactive</span></a>
                      <?php } ?></td>
                    
                      <td>
                          <a href="<?php echo base_url() ?>admin/master/category/<?php echo $value['id'] ?>" title="EDIT" ><span class="label label-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>
                          &nbsp;
                          <a onclick="return confirm('Are you sure you want to delete this category?');" href="<?php echo base_url() ?>admin/master/categoryDelete/<?php echo $value['id'] ?>" title="DELETE" ><span class="label label-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></span></a>

                      </td>
                </tr>
               <?php } } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>S.no</th>
                  <th>Product Type</th>
                  <th>Category</th>
                  <th>Image</th>
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