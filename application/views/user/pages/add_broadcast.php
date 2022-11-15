<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('user/include/header.php'); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php $this->load->view('user/include/mainheader.php'); ?>
  <!-- Left side column. contains the logo and sidebar -->
 
  <?php $this->load->view('user/include/sidebar.php');
  
  
 // print_r($temp_list);
  
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $pagetitle; ?> 
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
      <!-- left column -->
      <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
          <div class="box-header with-border">
              <h3 class="box-title"> </h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
        <form role="form" action="<?=base_url('user/user/send_request'); ?>" method="post" autocomplete="off" enctype="multipart/form-data">
          <div class="box-body">
              
              <div class="col-md-3">
                <div class="form-group">
                  <label>Broadcast Channel </label>
                  <select  class="form-control" placeholder="Enter Channel"  name="broadcast_channel" required>
                    <option value="360 Dialog WhatsApp"> 360 Dialog WhatsApp</option>  
                   
                  </select>
                  <?php echo form_error('name'); ?>
                </div>
              </div>
              
             
              <div class="col-md-3">
                <div class="form-group">
                  <label>Broadcast Name </label>
                       <input  type="text" class="form-control" name="broadcast_name" value="" required>
                </div>
              </div>
            
              <div class="col-md-3">
                <div class="form-group">
                  <label>Target Audience </label>
                  <select  class="form-control" placeholder="Enter Email"  name="target_audience" onchange="tag_divs(this.value);" required>
                      <option value="contact_with_all_of_these_tags"> Contact with all of these tags </option>
                      <option value="contact_with_any_of_these_tags"> Contact with any of these tags </option>
                      <option value="all_contact_in_channel"> All contact in channel </option>
                  </select>
                </div>
              </div>
              
              <div class="col-md-3" id="tag_div">
                <div class="form-group">
                  <label>Tag </label>
                  <select  class="form-control select2" placeholder="Enter Email"  name="tags[]" id="tags" multiple>
                     <option value=""> Select Tags </option>  
                        <?php if(!empty($tags)) {
                          foreach($tags as $key){
                        ?> 
                        <option value="<?=$key['tag']; ?>" <?php if(!empty($_GET['tags'])){ if($_GET['tags'] == $key['tag']){ echo 'selected'; } } ?> ><?=$key['tag']; ?></option>
                        <?php  } } ?>
                  </select>
                  <br>
                </div>
              </div>
             
               <div class="col-md-4">
                <div class="form-group">
                  <label>Select Massage Tamplate </label>
                  <select  class="form-control" placeholder="Enter Channel"  name="masssage_template"  required onchange="get_brodcast_list(this.value)">
                    <option value=""> Select Massage Tamplate </option>  
                    <?php if(!empty($temp_list_res)) {
                        $id = 0;
                      foreach($temp_list_res as $key){
                          
                        if($key->status == 'approved') {
                        
                    ?> 
                    <option value="<?=$id; ?>"><?=$key->name.' ('.$key->language.')'; ?></option>
                    <?php  } 
                    $id = $id+1;
                    } } ?>
                  </select>
                  <?php echo form_error('name'); ?>
                </div>
              </div>
           
              
              
              <div class="col-md-3">
                <div class="form-group">
                  <label>Schedule Broadcast</label>
                  <br>
                  <input  type="radio" name="send_type" required value="Send Now" onclick="showhidesch(this.value)"> &nbsp;Send Now
                   &nbsp;   &nbsp;   &nbsp;  
                   <input  type="radio" name="send_type" required value="Send Latter" onclick="showhidesch(this.value)">&nbsp;Send Latter
                  <?php echo form_error('send_type'); ?>
                </div>
              </div>
              
              
             <div class="col-md-4" id ="scheduleid" style="display:none">
                <div class="form-group">
                  <label>Schedule Date Time</label>
                   <input  type="datetime-local" class="form-control" name="schedule_date_time" >
                </div>
              </div>
             </div> 
              <div class="box-body" id="putdata"> </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Send Now</button>
              <a href="<?php echo base_url('') ?>" class="btn btn-warning">Back</a>
            </div>
          </form> 
        </div>
        </div>
    </div>  
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
 
<script type="text/javascript">
  function get_brodcast_list(val)
  {
       var url = "<?php echo base_url(); ?>user/user/get_brodcast_list";

        $.ajax({
            type: "POST",
            url: url,
            data: {val:val},

            success: function (data) {
             $("#putdata").html(data);
            }
         });
      
  }
  
  function tag_divs(val)
  {
     if(val == 'all_contact_in_channel')
     {
         $("#tag_div").hide();
          $("#tags").prop('required',false);;
     }else{
         $("#tag_div").show();
         $("#tags").prop('required',true);;
     }
  }
  
  function changepera(val,id)
  {
      var textpera = $("#textpera").html();
       var tx= '<span id="sp'+id+'"></span>';
      
       var tx1=textpera.replace("{{"+id+"}}", tx);
      $("#textpera").html(tx1);
      $("#sp"+id).html(val);
  }
  


</script>


<script>
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
  
  
  function showhidesch(val)
  {
      if(val == 'Send Latter'){
      $("#scheduleid").show();
      }else{
      $("#scheduleid").hide();    
      }
      
  }
</script>
<?php $this->load->view('user/include/js.php'); ?>
</body>
</html>      