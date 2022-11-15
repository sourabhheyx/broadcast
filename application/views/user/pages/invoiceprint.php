
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assest/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assest/admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assest/admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assest/admin/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
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
                <td>Rs.<?php echo number_format($orderdata['delivery_fee']); ?></td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>Rs. <?php echo number_format($orderdata['total_price']+$orderdata['delivery_fee']); ?></td>
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
          <a href="" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
        
        </div>
      </div>
    </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
