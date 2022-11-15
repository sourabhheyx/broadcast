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
        <form role="form" action="" method="post" autocomplete="off">
          <div class="box-body">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Country</label>
                  <select name="country_id" id="country_id" onchange ="getstate(this.value);" class="form-control">
                    <option value="">--Select--</option>
                    <?php 

                    if(!empty($country)){
                      foreach ($country as $key => $types) { ?>
                      <option value="<?php echo $types['id'] ?>" <?php if(!empty($update['country_id']))  { echo (set_value('country_id', $update['country_id'])==$types['id'])?"selected":''; } ?>> <?php echo $types['country']; ?> </option>
                      <?php }
                      } ?>
                  </select>
                  <?php echo form_error('country_id'); ?>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>State</label>
                  <select name="state_id"  onchange ="getcity(this.value);"  id ='state_id' class="form-control">
                    <option value="">--Select--</option>
                    <?php 

                    if(!empty($update['state_id'])){
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
                  <select name="city_id" id ='city_id' class="form-control">
                    <option value="">--Select--</option>
                    <?php 

                    if(!empty($update['city_id'])){
                      foreach ($city as $key => $types) { ?>
                      <option value="<?php echo $types['id'] ?>" <?php if(!empty($update['city_id']))  { echo (set_value('city_id', $update['city_id'])==$types['id'])?"selected":''; } ?>> <?php echo $types['city']; ?> </option>
                      <?php }
                      } ?>
                  </select>
                  <?php echo form_error('city_id'); ?>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>City</label>
                  <input class="form-control" placeholder="Enter City" type="text" name="block" value="<?php if(!empty($update)) { echo $update['block']; } else { echo set_value('block'); } ?>">
                  <?php echo form_error('block'); ?>
                </div>
              </div>
              
              <div class="col-md-3">
                <div class="form-group">
                  <label>Pincode</label>
                  <input class="form-control" placeholder="Enter Pincode" type="text" name="pincode" value="<?php if(!empty($update)) { echo $update['pincode']; } else { echo set_value('pincode'); } ?>">
                  <?php echo form_error('pincode'); ?>
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
                  <th>Country</th>
                  <th>State</th>
                  <th>District</th>
                  <th>City</th>
                  <th>Pincode</th>
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
                      <td><?php $country = $this->adminmodel->getwheres('country',array('id'=>$value['country_id'])); echo $country['country'];  ?></td>
                      <td><?php $state = $this->adminmodel->getwheres('state',array('id'=>$value['state_id'])); echo $state['state']; ?></td>
                      <td><?php $city = $this->adminmodel->getwheres('city',array('id'=>$value['city_id'])); echo $city['city']; ?></td>
                      <td><?php echo $value['block'] ?></td>
                      <td><?php echo $value['pincode'] ?></td>
                      <td><?php if($value['status']==1){ ?>
                        <a href="<?php echo base_url() ?>admin/master/active_city_block/<?php echo $value['id'] ?>" ><span class="label label-primary">Active</span></a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url() ?>admin/master/active_city_block/<?php echo $value['id'] ?>" ><span class="label  label-danger">Deactive</span></a>
                      <?php } ?></td>
                    
                      <td>
                          <a href="<?php echo base_url() ?>admin/master/city_block/<?php echo $value['id'] ?>" title="EDIT" ><span class="label label-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>
                          &nbsp;
                          <a onclick="return confirm('Are you sure you want to delete this city block?');" href="<?php echo base_url() ?>admin/master/city_blockDelete/<?php echo $value['id'] ?>" title="DELETE" ><span class="label label-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></span></a>

                      </td>
                </tr>
               <?php } } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>S.no</th>
                  <th>Country</th>
                  <th>State</th>
                  <th>District</th>
                  <th>City</th>
                  <th>Pincode</th>
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