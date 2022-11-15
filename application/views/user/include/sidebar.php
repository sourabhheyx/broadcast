  <?php $name =  $this->session->userdata['user_session']['name'];
      $user_id =  $this->session->userdata['user_session']['user_id'];
      $status =  $this->session->userdata['user_session']['status'];
      $type =  $this->session->userdata['user_session']['type'];
      
  ?>
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>assest/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $name;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           
            <li class="active"><a href="<?php echo base_url(); ?>user-dashboard"><i class="fa fa-circle-o"></i> Dashboard</a></li>
          
          </ul>
        </li>
       
      
       
         <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span> Contact Details</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>user/user/add_contact"><i class="fa fa-angle-double-right"></i>Add Contact</a></li>
            <li><a href="<?php echo base_url(); ?>user/user/upload_contact"><i class="fa fa-angle-double-right"></i>Upload Contact</a></li>
            <li><a href="<?php echo base_url(); ?>user/user/contact_list"><i class="fa fa-angle-double-right"></i>Contact List</a></li>
            
          </ul>
         </li>

         <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span> Broadcast</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           
            <li><a href="<?php echo base_url(); ?>user/user/add_broadcast"><i class="fa fa-angle-double-right"></i> Add Broadcast</a></li>
          
            <li><a href="<?php echo base_url(); ?>user/user/broadcast_report"><i class="fa fa-angle-double-right"></i> Broadcast Report</a></li>
          </ul>
         </li>
      
        
         
        <div style = "display:none">
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        </div>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>