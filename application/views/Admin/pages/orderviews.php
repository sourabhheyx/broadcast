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
        <li><a href="#"></a></li>
        <li class="active"><?php echo $pagetitle; ?> Elements</li>
      </ol>
    </section>

    <!--  Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Product, Inc.
            <small class="pull-right">Date: <?php echo date("d-m-Y", strtotime($orderdata['order_date'])); ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From 
          <address>
             <strong><?php echo $this->adminmodel->getwheres('users',array('user_id'=>$orderlist['user_id']))['name'];  ?> </strong>
            <strong><?php echo $orderlist['store_name'] ?></strong><br>
            <?php echo $orderlist['address'] ?><br>
               
           <?php echo $this->adminmodel->getwheres('city',array('id'=>$orderlist['city_id']))['city'];  ?>,
           <?php echo $this->adminmodel->getwheres('state',array('id'=>$orderlist['state_id']))['state'];  ?>,
           <?php echo $this->adminmodel->getwheres('country',array('id'=>$orderlist['country_id']))['country'];  ?>,
           <br>
            Phone: (+91) <?php echo $this->adminmodel->getwheres('users',array('user_id'=>$orderlist['user_id']))['mobile'];  ?><br>
            Email: <?php echo $this->adminmodel->getwheres('users',array('user_id'=>$orderlist['user_id']))['email'];  ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong><?php echo $orderdata['first_name'].' '.$orderdata['last_name']; ?></strong><br>
            <?php echo $orderdata['address'] ?><br>
            <?php echo $this->adminmodel->getwheres('city',array('id'=>$orderdata['city']))['city'];  ?>,
            <?php echo $this->adminmodel->getwheres('state',array('id'=>$orderdata['state']))['state'];  ?>,
            <?php echo $this->adminmodel->getwheres('country',array('id'=>$orderdata['country']))['country'];  ?><br>
            Phone: (+91) <?php echo $orderdata['mobile'] ?><br>
            Email: <?php echo $orderdata['email'] ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #<?php echo $orderdata['order_id']; ?></b><br>
          <br>
          <b>Order ID:</b> <?php echo $orderdata['order_id']; ?><br>
    
          <b>Account:</b> <?php echo number_format($orderdata['total_price']); ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>S.no</th>
              <th>Product</th>
              <th>Color</th>
              <th>Size</th>
              <th>Unit</th> 
              <th>Qty</th>
              <th>Amount</th>
              <th>Description</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($data)) {
            foreach($data as $key => $val){
            $pro = $this->adminmodel->getwheres('product',array('id'=>$val['item_id']));
            ?>
            <tr>
              <td>1</td>
              <td><?php echo $pro['product_name']; ?></td>
              <td><?php echo $val['color']; ?></td>
              <td><?php echo $val['size']; ?></td>
              <td><?php echo $val['unit']; ?></td>
              <td><?php echo $val['qty']; ?></td>
              <td><?php echo number_format($val['price']); ?></td>
              <td><?php echo substr($pro['product_description'],0,50) ; ?></td>
              <td><?php echo number_format($val['total_price']); ?></td>
            </tr>
          <?php } } ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Payment Methods:</p>
          <?php echo $orderdata['payment_mode']; ?>

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount Pay <?php echo number_format($orderdata['total_price']); ?></p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>Rs. <?php echo number_format($orderdata['total_price']); ?></td>
              </tr>
              
              <tr>
                <th>Shipping:</th>
                <td>Rs.0.00</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>Rs. <?php echo number_format($orderdata['total_price']); ?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="<?php echo base_url(); ?>admin/order/invoiceprint/<?php echo $orderdata['order_id']; ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
         

        </div>
      </div>
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