<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('Admin/include/header.php'); ?>
<?php $this->load->view('Admin/pages/Ajax/ajax.php'); ?>
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
              <div class="col-md-3">
                <div class="form-group">
                  <label>Store</label>
                  <select name="store_id" id="store_id" class="form-control">
                    <option value="">--Select--</option>
                    <?php 

                    if(!empty($store)){
                      foreach ($store as $key => $types) { ?>
                      <option value="<?php echo $types['id'] ?>" <?php if(!empty($update['store_id']))  { echo (set_value('store_id', $update['store_id'])==$types['id'])?"selected":''; } ?>> <?php echo $types['store_name']; ?> </option>
                      <?php }
                      } ?>
                  </select>
                  <?php echo form_error('store_id'); ?>
                </div>
              </div>
               <div class="col-md-3">
                <div class="form-group">
                  <label>Product Type</label>
                  <select name="product_type" id="product_type" onchange="getcategory(this.value);" class="form-control">
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
              <div class="col-md-3">
                <div class="form-group">
                  <label>Category</label>
                  <select name="category_id" onchange="getsubcategory(this.value);" id="category_id" class="form-control">
                    <option value="">--Select--</option>
                    <?php 

                    if(!empty($update['category_id'])){
                      foreach ($category_id as $key => $types) { ?>
                      <option value="<?php echo $types['id'] ?>" <?php if(!empty($update['category_id']))  { echo (set_value('category_id', $update['category_id'])==$types['id'])?"selected":''; } ?>> <?php echo $types['category']; ?> </option>
                      <?php }
                      } ?>
                  </select>
                  <?php echo form_error('category_id'); ?>
                </div>
              </div>
            <div class="col-md-3">
                <div class="form-group">
                  <label>Sub Category</label>
                  <select name="subcategory_id" id="subcategory_id" class="form-control">
                    <option value="">--Select--</option>
                    <?php 

                    if(!empty($update['subcategory_id'])){
                      foreach ($subcategory_id as $key => $types) { ?>
                      <option value="<?php echo $types['id'] ?>" <?php if(!empty($update['subcategory_id']))  { echo (set_value('subcategory_id', $update['subcategory_id'])==$types['id'])?"selected":''; } ?>> <?php echo $types['subcategory']; ?> </option>
                      <?php }
                      } ?>
                  </select>
                  <?php echo form_error('subcategory_id'); ?>
                </div>
              </div>
             <div class="col-md-3">
                <div class="form-group">
                  <label>Product Name</label>
                  <input class="form-control" placeholder="Enter Product Name" type="text" name="product_name" value="<?php if(!empty($update)) { echo $update['product_name']; } else { echo set_value('product_name'); } ?>">
                  <?php echo form_error('product_name'); ?>
                </div>
              </div>
           
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Search</button>
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
                  <th>Sub Category</th>
                  <th>Product Name</th>
                  <th>Price</th>
                  <th>MRP</th>
                  <th>Color</th>
                  <th>Size</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Display Status</th>
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
                      <td><?php echo $this->adminmodel->getwheres('category',array('id'=>$value['category_id']))['category']; ?></td>
                      <td><?php echo $this->adminmodel->getwheres('subcategory',array('id'=>$value['subcategory_id']))['subcategory']; ?></td>
                      <td><?php echo $value['product_name'] ?></td>
                      <td><?php echo $value['product_price'] ?></td>
                      <td><?php echo $value['sale_price'] ?></td>
                      <td><?php echo $value['product_color'] ?></td>
                      <td><?php echo $value['product_size'] ?></td>
                      <td><?php echo $value['image'] ?></td>
                      <td><?php if($value['status']==1){ ?>
                        <a href="<?php echo base_url() ?>Admin/product/active_product/<?php echo $value['id'] ?>" ><span class="label label-primary">Active</span></a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url() ?>Admin/product/active_product/<?php echo $value['id'] ?>" ><span class="label  label-danger">Deactive</span></a>
                      <?php } ?></td>
                      
                      <td>
                       
                              <select name="display_status" onchange="updateproduct(this.value,<?php echo $value['id'] ?>);" id="display_status" class="form-control">
                                <option value="">--Select--</option>
                                 <option value="0"  <?php if(!empty($value['display_status']))  { echo (set_value('category_id', $value['display_status'])==0)?"selected":''; } ?> > Both PRODUCT </option>
                                 <option value="1"  <?php if(!empty($value['display_status']))  { echo (set_value('category_id', $value['display_status'])==1)?"selected":''; } ?> > FEATURED PRODUCT </option>
                                 <option value="2"  <?php if(!empty($value['display_status']))  { echo (set_value('category_id', $value['display_status'])==2)?"selected":''; } ?> > NEW PRODUCT </option>
                              </select>
                        
                          
                      </td>
                    
                      <td>
                          <a href="<?php echo base_url() ?>Admin/product/product/<?php echo $value['id'] ?>" title="EDIT" ><span class="label label-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>
                          &nbsp;
                          <a onclick="return confirm('Are you sure you want to delete this product?');" href="<?php echo base_url() ?>Admin/product/productDelete/<?php echo $value['id'] ?>" title="DELETE" ><span class="label label-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></span></a>

                      </td>
                </tr>
               <?php } } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>S.no</th>
                  <th>Product Type</th>
                  <th>Category</th>
                  <th>Sub Category</th>
                  <th>Product Name</th>
                  <th>Price</th>
                  <th>MRP</th>
                  <th>Color</th>
                  <th>Size</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Display Status</th>
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