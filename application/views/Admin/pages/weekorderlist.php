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
                  <label>Store Name</label>
                  <select name="user_store_id" id="user_store_id"  class="form-control">
                    <option value="">--Select--</option>
                    <?php 

                    if(!empty($usersstore)){
                      foreach ($usersstore as $key => $types) { ?>
                      <option value="<?php echo $types['user_id'] ?>" <?php  echo set_value('user_store_id'); ?>> <?php echo $types['store_name']; ?> </option>
                      <?php }
                      } ?>
                  </select>
                  <?php echo form_error('user_store_id'); ?>
                </div>
              </div>
              <div class="col-md-3">
                 <div class="form-group">
                  <label>City </label>
                  <select name="city_id"  id ='city_id' class="form-control">
                    <option value="">--Select--</option>
                    <?php 

                    if(!empty($city)){
                      foreach ($city as $key => $types) { ?>
                      <option value="<?php echo $types['id'] ?>"  <?php  echo set_value('city_id'); ?> > <?php echo $types['city']; ?> </option>
                      <?php }
                      } ?>
                  </select>
                  <?php echo form_error('city_id'); ?>
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
                 
                  <th>Order Id</th>
                  <th>Txn Id</th>
                  <th>Online Txn Id</th>
                  <th>Full Name</th>
                  <th>Mobile</th>
                  <th>Address</th>
                  <th>Order Date</th>
                  <th>Price</th>
                  <th>Shipping Rate</th>
                  <th>Total Price</th>
                  <th>Status</th>
              
                  <th>Payment Mode</th>
                  <th>View</th>
                
                </tr>
                </thead>
                <tbody>
               <?php if(!empty($data)){
                  $i=1;
                  foreach ($data as $key => $value) { ?>
                <tr>
                      <td><?php  echo $i++ ?></td>
                     
                      <td>#<?php echo $value['order_id'] ?></td>
                      
                      <td><?php echo $value['txn_id'] ?></td>
                      <td><?php echo $value['online_txn_id'] ?></td>
                      <td><?php echo $value['first_name'].' '.$value['last_name'] ?></td>
                      <td><?php echo $value['mobile'] ?></td>
                      <td><?php echo $value['address'] ?></td>
                      <td><?php echo $value['order_date'] ?></td>
                      <td><?php echo $value['total_price'] ?></td>
                      <td><?php echo $value['delivery_fee'] ?></td>
                      <td><?php echo $value['total_price']+$value['delivery_fee']; ?></td>
                      <td><?php if($value['order_status']==1){ echo '<span class="label label-primary">Placed Order</span>'; }else if($value['order_status']==2) { echo '<span class="label label-primary">Recieved Order</span>'; }else if($value['order_status']==3){  echo '<span class="label label-primary">Prepered Order</span>'; }else if($value['order_status']==4){  echo '<span class="label label-primary">Processed Order</span>'; }else if($value['order_status']==5){  echo '<span class="label label-primary">Shipped Order</span>'; }else if($value['order_status']==6){  echo '<span class="label label-primary">Gharphoch Order</span>'; }else{ echo '<span class="label  label-danger">Cencel</span>'; }?>
                      </td>
                     
                   <td><?php echo $value['payment_mode'] ?></td> 
                    <td>
                        <a href="<?php echo base_url() ?>user/order/orderviews/<?php echo $value['order_id'] ?>" title="EDIT" ><span class="label label-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>
                    </td>
                     
                </tr>
               <?php } } ?>
                </tbody>
                <tfoot>
                <tr>
                <th>S.no</th>
                 
                  <th>Order Id</th>
                  <th>Txn Id</th>
                  <th>Online Txn Id</th>
                  <th>Full Name</th>
                  <th>Mobile</th>
                  <th>Address</th>
                  <th>Order Date</th>
                  <th>Price</th>
                  <th>Shipping Rate</th>
                  <th>Total Price</th>
                  <th>Status</th>
                 
                  <th>Payment Mode</th>
                  <th>View</th>
                
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