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
                  <label>Web Name</label>
                 <input class="form-control" placeholder="Enter Web Name" type="text" name="web_name" value="<?php if(!empty($update)) { echo $update['web_name']; } else { echo set_value('web_name'); } ?>">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Logo</label>
                  <input class="form-control" placeholder="Enter Title" type="file" name="image">
                 <input class="form-control" placeholder="Enter Title" type="hidden" name="oldimage" value="<?php if(!empty($update)) { echo $update['logo']; } else { echo set_value('logo'); } ?>">
                </div>
              </div>
              
               <div class="col-md-4">
                <div class="form-group">
                  <label>Web Mobile</label>
                 <input class="form-control" placeholder="Enter phone" type="text" name="phone" value="<?php if(!empty($update)) { echo $update['phone']; } else { echo set_value('phone'); } ?>">
                </div>
              </div>
               <div class="col-md-4">
                <div class="form-group">
                  <label>Web email</label>
                 <input class="form-control" placeholder="Enter email" type="text" name="email" value="<?php if(!empty($update)) { echo $update['email']; } else { echo set_value('email'); } ?>">
                </div>
              </div>
               <div class="col-md-4">
                <div class="form-group">
                  <label>Web address</label>
                 <input class="form-control" placeholder="Enter address" type="text" name="address" value="<?php if(!empty($update)) { echo $update['address']; } else { echo set_value('address'); } ?>">
                </div>
              </div>
               
             <div class="col-md-4">
                <div class="form-group">
                  <label>Web footer</label>
                 <input class="form-control" placeholder="Enter footer" type="text" name="footer" value="<?php if(!empty($update)) { echo $update['footer']; } else { echo set_value('footer'); } ?>">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>Fee Charges</label>
                 <input class="form-control" placeholder="Enter fee_charges" type="text" name="fee_charges" value="<?php if(!empty($update)) { echo $update['fee_charges']; } else { echo set_value('fee_charges'); } ?>">
                </div>
              </div>
              
              <div class="col-md-4">
                <div class="form-group">
                  <label>Minimum Withdrow</label>
                 <input class="form-control" placeholder="Enter Withdrow" type="text" name="minimum_withdrow" value="<?php if(!empty($update)) { echo $update['minimum_withdrow']; } else { echo set_value('minimum_withdrow'); } ?>">
                </div>
              </div>
              
              <div class="col-md-4">
                <div class="form-group">
                  <label>Reffral Amount</label>
                 <input class="form-control" placeholder="Enter reffral_amt" type="text" name="reffral_amt" value="<?php if(!empty($update)) { echo $update['reffral_amt']; } else { echo set_value('fee_charges'); } ?>">
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
                  <th>Web Name</th>
                  <th>Logo</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Footer</th>
                  <th>Fee Charges</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               <?php if(!empty($data)){
                  $i=1;
                  foreach ($data as $key => $value) { ?>
                <tr>
                      <td><?php  echo $i++ ?></td>
                      <td><?php echo $value['web_name'] ?></td>
                      <td><img src="<?php echo base_url() ?>uploads/<?php echo $value['logo'] ?>" alt="Smiley face" height="42" width="42"></td>
                      <td><?php echo $value['phone'] ?></td>
                      <td><?php echo $value['email'] ?></td>
                      <td><?php echo $value['address'] ?></td>
                      <td><?php echo $value['footer'] ?></td>
                      <td><?php echo $value['fee_charges'] ?></td>
            
                      <td>
                    
                    <a onclick="return confirm('Are you sure you want to delete this Slider?');" href="<?php echo base_url() ?>admin/Web/WebviewDelete/<?php echo $value['id'] ?>" title="DELETE" ><span class="label label-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></span></a>

                      </td>
                </tr>
               <?php } } ?>
                </tbody>
                <tfoot>
                <tr>
                 <th>S.no</th>
                  <th>Web Name</th>
                  <th>Logo</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Footer</th>
                  <th>Fee Charges</th>
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
<script src="<?php echo base_url();?>assest/ckeditor/ckeditor.js"></script>
<script type="text/javascript">

  CKEDITOR.replace('social_icon');

  </script>
<?php $this->load->view('Admin/include/js.php'); ?>
</body>
</html>      