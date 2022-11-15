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
                  <th>Mobile</th>
                  <th>Email</th>
                  
                  <th>Address</th>
                  <th>Apartment</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Zip</th>
                  <th>Country</th>
                  <th>date</th>
                  <th>Pan no</th>
                  <th>Adhhar no</th>
                  <th>Loan for</th>
                  <th>Pan doc</th>
                  <th>Addhar doc</th>
                </tr>
                </thead>
                <tbody>
               <?php if(!empty($data)){
                  $i=1;
                  foreach ($data as $key => $value) { ?>
                <tr>
                     <td><?php  echo $i++ ?></td>
                      <td><?php echo $value['name'] ?></td>
                      <td><?php echo $value['phone'] ?></td>
                      <td><?php echo $value['email'] ?></td>
                      <td><?php echo $value['street_address']  ?></td>
                      <td><?php echo $value['apartment'] ?></td>
                      <td><?php echo $value['city'] ?></td>
                      <td><?php echo $value['state'] ?></td>
                      <td><?php echo $value['zip']  ?></td>
                      <td><?php echo $value['country'] ?></td>
                      <td><?php echo $value['c_date'] ?></td>
                      <td><?php echo $value['pan_no'] ?></td>
                      <td><?php echo $value['adhhar_no']  ?></td>
                      <td><?php echo $value['loan_for'] ?></td>
                       <td><a href="<?=base_url('uploads/documents/'); ?><?php echo $value['pan_doc'] ?>"><img style="width: 50px;" target="_blank" src="<?=base_url('uploads/documents/'); ?><?php echo $value['pan_doc'] ?>"></a></td>
                      <td>

                        <a href="<?=base_url('uploads/documents/'); ?><?php echo $value['pan_doc'] ?>"><img style="width: 50px;" target="_blank" src="<?=base_url('uploads/documents/'); ?><?php echo $value['adhar_front'] ?>"></a> <?php echo $value['adhar_back'] ?></td>

                       
                     
                </tr>
               <?php } } ?>
                </tbody>
                <tfoot>
                <tr>
                 <th>S.no</th>
                  <th>Name</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Apartment</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Zip</th>
                  <th>Country</th>
                  <th>date</th>
                  <th>Pan no</th>
                  <th>Adhhar no</th>
                  <th>Loan for</th>
                  <th>Pan doc</th>
                  <th>Addhar doc</th>
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