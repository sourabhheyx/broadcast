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
                  <th>Email</th>
                  <!--<th>Password</th>-->
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
                      <!--<td><?php echo $value['password'] ?></td>-->
                      <td><?php echo $value['mobile']  ?></td>
                      <td><?php echo $value['address']  ?></td>
                     <td><?php if($value['status']==1){ ?>
                        <a href="#" ><span class="label label-primary">Active</span></a>
                      <?php }else{ ?>
                        <a href="#" ><span class="label  label-danger">Deactive</span></a>
                      <?php } ?></td>
                      <td>
                        
                          <a  href="#" data-toggle="modal" data-target="#myModal<?php echo $value['user_id'] ?>" title="Assign" ><span class="label label-success">permission</span></a>
                      </td>
                </tr>
                
                
                <div id="myModal<?php echo $value['user_id'] ?>" class="modal fade" role="dialog">
                <div class="modal-dialog">
                
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Order Status </h4>
                  </div>
                  <div class="modal-body">
                    <ul>
                        <?php  $resu = $this->adminmodel->getwhere('payment_order_status');
                        if(!empty($resu))
                        {
                            
                        foreach($resu as $key => $val){
                            
                            $getcheck = $this->adminmodel->getwheres('order_status_sms_per' ,array('order_status'=>$val['id'],'user_id'=> $value['user_id']));
                        ?>
                        <li>
                            <b><?php echo $val['order_status'];?> &nbsp;&nbsp;&nbsp; <label><input type="checkbox" <?php  if(!empty($getcheck)){ echo 'checked'; } ?> onclick="clickcheck(<?php echo $val['id'];?>,<?php echo $value['user_id'] ?>)" name="checkbox<?php echo $val['id'];?><?php echo $value['user_id'] ?>"  id="checkbox"  value="<?php echo $val['id'];?>"></label><br></b>
                        </li>
                        
                        <?php } } ?>
                    </ul>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
                
                </div>
                </div>
               <?php } } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>S.no</th>
                  <th>Name</th>
                  <th>Email</th>

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

<script>
   function clickcheck(id,user_id){
       var checks = $('input[name="checkbox'+id+''+user_id+'"]').prop("checked");
     
        if(checks == true){
          var url = "<?php echo base_url(); ?>admin/user/userspermission";
          var order_status = id;
          var status = 1;
          $.ajax({
            type: "POST",
            url: url,
            data: {user_id:user_id,order_status:order_status,status:status},

            success: function (data) {
            }
         });
          
        }
        else if(checks == false){
        
           var url = "<?php echo base_url(); ?>admin/user/userspermission";
           var order_status = id;
           var status = 0;
          $.ajax({
            type: "POST",
            url: url,
            data: {user_id:user_id,order_status:order_status,status:status},

            success: function (data) {
            }
         });
        }
    
   }
   
  
</script>

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