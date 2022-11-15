<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('Admin/pages/Ajax/ajax.php'); ?>
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
                  <label>Name</label>
                  <input class="form-control" placeholder="Enter Name" type="text" name="name" value="<?php if(!empty($update)) { echo $update['name']; } else { echo set_value('name'); } ?>">
                  <?php echo form_error('name'); ?>
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
                  <input class="form-control" placeholder="Enter Mobile" type="number" name="mobile" value="<?php if(!empty($update)) { echo $update['mobile']; } else { echo set_value('mobile'); } ?>">
                  <?php echo form_error('mobile'); ?>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>State</label>
                  <input  type="hidden" name="country_id" id="country_id"  value="2">
                  <select name="state_id"  onchange ="getcity(this.value);"  id ='state_id' class="form-control">
                    <option value="">--Select--</option>
                    <?php 

                    if(!empty($state)){
                      foreach ($state as $key => $types) { ?>
                      <option value="<?php echo $types['id'] ?>" <?php if(!empty($update['state_id']))  { echo (set_value('state_id', $update['state_id'])==$types['id'])?"selected":''; } ?>> <?php echo $types['state']; ?> </option>
                      <?php }
                      } ?>
                  </select>
                  <?php echo form_error('state_id'); ?>
                </div>
              </div>
              <div class="col-md-3">
                 <div class="form-group">
                  <label>District</label>
                  <select name="district_id" onchange ="getcityblock(this.value);" id ='city_id' class="form-control">
                    <option value="">--Select--</option>
                    <?php 

                    if(!empty($update['district_id'])){
                      foreach ($district as $key => $types) { ?>
                      <option value="<?php echo $types['id'] ?>" <?php if(!empty($update['district_id']))  { echo (set_value('district_id', $update['district_id'])==$types['id'])?"selected":''; } ?>> <?php echo $types['city']; ?> </option>
                      <?php }
                      } ?>
                  </select>
                  <?php echo form_error('district_id'); ?>
                </div>
              </div>
               <div class="col-md-3">
                 <div class="form-group">
                  <label>City </label>
                  <select name="city_id"  id ='city_block_id' class="form-control">
                    <option value="">--Select--</option>
                    <?php 

                    if(!empty($update['city_id'])){
                      foreach ($city as $key => $types) { ?>
                      <option value="<?php echo $types['id'] ?>" <?php if(!empty($update['city_id']))  { echo (set_value('city_id', $update['city_id'])==$types['id'])?"selected":''; } ?>> <?php echo $types['block']; ?> </option>
                      <?php }
                      } ?>
                  </select>
                  <?php echo form_error('city_id'); ?>
                </div>
              </div>
             <div class="col-md-3">
                <div class="form-group">
                  <label>Password </label>
                  <input class="form-control" autocomplete="off" placeholder="Enter Password" type="password" name="password" value="<?php if(!empty($update)) { echo $update['password']; } else { echo set_value('password'); } ?>">
                  <?php echo form_error('password'); ?>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Address </label>
                  <input class="form-control" autocomplete="off" placeholder="Enter address" type="text" name="address" value="<?php if(!empty($update)) { echo $update['address']; } else { echo set_value('address'); } ?>">
                  <?php echo form_error('address'); ?>
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
                  <th>Name</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Mobile</th>
                  <th>Address</th>
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
                      <td><?php echo $value['address']  ?></td>
                     <td><?php if($value['status']==1){ ?>
                        <a href="<?php echo base_url() ?>admin/user/active_user/<?php echo $value['user_id'] ?>" ><span class="label label-primary">Active</span></a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url() ?>admin/user/active_user/<?php echo $value['user_id'] ?>" ><span class="label  label-danger">Deactive</span></a>
                      <?php } ?></td>
                      <td>
                          <a href="<?php echo base_url() ?>admin/user/addstaff/<?php echo $value['user_id'] ?>" title="EDIT" ><span class="label label-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>
                          &nbsp;
                          <a onclick="return confirm('Are you sure you want to delete this User?');" href="<?php echo base_url() ?>admin/user/staffDelete/<?php echo $value['user_id'] ?>" title="DELETE" ><span class="label label-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></span></a>

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