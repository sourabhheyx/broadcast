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
    
    
    
<section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
          <div class="box-header with-border">
              <h3 class="box-title"> </h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
        <form role="form"  method="get" autocomplete="off">
          <div class="box-body">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Select Date </label>
                   <input  type="date" class="form-control" name="schedule_date_time" value="" required>
                  <?php echo form_error('name'); ?>
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
              <h3 class="box-title"><?php echo 'Past '.$List; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.no</th>
                  <th>WhatsApp Id</th>
                  <th>Broadcast channel</th>
                  <th>Broadcast Name</th>
                  <th>Send Type</th>
                 
                  <th>Schedule date time</th>
                </tr>
                </thead>
                <tbody>
               <?php if(!empty($past_data)){
                  $i=1;
                  foreach ($past_data as $key => $value) { ?>
                <tr>
                      <td><?php  echo $i++ ?></td>
    
                      <td><a href="https://wa.me/<?php echo $value['wa_id'] ?>" target="_blank"><?php echo $value['wa_id'] ?></a></td>
                      <td><?php echo $value['broadcast_channel'] ?></td>
                
                      <td><?php echo $value['broadcast_name']  ?></td>
                      <td><?php echo $value['send_type']  ?></td>
                      <td><?php echo $value['schedule_date_time']  ?></td>
                    
                    
                </tr>
               <?php } } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>S.no</th>
                  <th>WhatsApp Id</th>
                  <th>Broadcast channel</th>
                  <th>Broadcast Name</th>
                  <th>Send Type</th>
                  <th>Schedule date time</th>
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
      <?php if($List !='Failed List'){ ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo 'Current '.$List; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.no</th>
                  <th>WhatsApp Id</th>
                  <th>Broadcast channel</th>
                  <th>Broadcast Name</th>
                  <th>Send Type</th>
                 
                  <th>Schedule date time</th>
                </tr>
                </thead>
                <tbody>
               <?php if(!empty($future_data)){
                  $i=1;
                  foreach ($future_data as $key => $value) { ?>
                <tr>
                      <td><?php  echo $i++ ?></td>
    
                      <td><?php echo $value['wa_id'] ?></td>
                      <td><?php echo $value['broadcast_channel'] ?></td>
                
                      <td><?php echo $value['broadcast_name']  ?></td>
                      <td><?php echo $value['send_type']  ?></td>
                      <td><?php echo $value['schedule_date_time']  ?></td>
                    
                    
                </tr>
               <?php } } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>S.no</th>
                  <th>WhatsApp Id</th>
                  <th>Broadcast channel</th>
                  <th>Broadcast Name</th>
                  <th>Send Type</th>
                  <th>Schedule date time</th>
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
      <?php } ?>
      <!-- /.row -->
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