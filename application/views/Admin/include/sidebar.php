  <?php $name =  $this->session->userdata['admin_session']['name'];
      $user_id =  $this->session->userdata['admin_session']['user_id'];
      $status =  $this->session->userdata['admin_session']['status'];
      $type =  $this->session->userdata['admin_session']['type'];
      
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
             <?php
                $type =$this->session->userdata['admin_session']['type'];
                if($type == '0')
                { ?>  
            <li class="active"><a href="<?php echo base_url(); ?>admin-dashboard"><i class="fa fa-circle-o"></i> Dashboard</a></li>
            <?php } else { ?>
            <li class="active"><a href="<?php echo base_url(); ?>admin-dashboard"><i class="fa fa-circle-o"></i> Dashboard</a></li>
            <?php } ?>
          </ul>
        </li>
        
        
      
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>User's Details</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a href="<?php echo base_url(); ?>admin/user/Adduser"><i class="fa fa-circle-o"></i>Add User's</a></li> 
             <li><a href="<?php echo base_url(); ?>admin/user/AllUser"><i class="fa fa-circle-o"></i> User's List</a></li> 
        
          </ul>
         </li>

          
         
        
         
          <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Web View</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
         
             <li><a href="<?php echo base_url(); ?>admin/web/webview"><i class="fa fa-circle-o"></i>Web Setting</a></li> 
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