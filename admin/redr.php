<?php
	session_start();
	if(!isset($_SESSION['email'])){
		echo "<script>location.replace('login.php')</script>";
	}
	$e = $_SESSION['email'];
	include "../conn.php";
	include "../myclasses.php";
	$user = new User($e);
	$user->getUserDetails($conn);
	
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>I-rish-Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>I</b>-R</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>I</b>-Rish</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="img/users/<?php echo($user->image) ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo($user->name) ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="img/users/<?php echo($user->image) ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo($user->name) ?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat disabled">Register</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="img/users/<?php echo($user->image) ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo($user->name) ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
		<li>
          <a href="inventory.php">
            <i class="fa fa-table"></i> <span>Inventory Tables</span>
          </a>
        </li>
		<li>
          <a href="refill.php">
            <i class="fa fa-cart-plus"></i> <span>Shipping/Refill</span>
          </a>
        </li>
		<li>
          <a href="inventcharts.php">
            <i class="fa fa-line-chart"></i> <span>Inventory Data Analysis</span>
          </a>
        </li>
      </ul>    
	</section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Report Tables
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reports</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box" id="shipments" style="box-shadow: 5px 5px 10px;">
            <div class="box-header">
              <h3 class="box-title">Shipments</h3>
			  <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ORDER ID</th>
                  <th>ADDRESS</th>
                  <th>ITEMS</th>
                  <th>DATE</th>
                </tr>
                </thead>
                <tbody>
					<?php
						shipments($conn);
					?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		  <div class="box" id="orders" style="box-shadow: 5px 5px 10px;">
            <div class="box-header">
              <h3 class="box-title">Orders</h3>
			  <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>DATE</th>
                  <th>CART ID</th>
                  <th>PRODUCT</th>
                  <th>QUANTITY</th>
                  <th>TOTAL</th>
                  <th>STATUS</th>
                </tr>
                </thead>
                <tbody>
					<?php
						orders($conn);
					?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		  <div class="box" id="stalledcarts" style="box-shadow: 5px 5px 10px;">
            <div class="box-header">
              <h3 class="box-title">Stalled Carts</h3>
			  <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>CART ID</th>
                  <th>TOTAL</th>
                </tr>
                </thead>
                <tbody>
					<?php
						stalledCarts($conn);
					?>
                </tbody>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
    <strong><a href="https://adminlte.io">AdminLTE</a></strong>
    </div>
    <strong>&copy;<script>document.write(new Date().getFullYear());</script> I-rish.</strong> Developed by Chimuga Technologies. All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable()
    $('#example3').DataTable()
  })
</script>
</body>
</html>
<?php
	function shipments($conn){
		$sql = "select * from _shipments";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){
			if($row['status']=='shipped'){
				echo "<tr><td>".$row['orderid']."</td><td>".$row['address']."</td><td>".$row['items']."</td><td><button class='btn btn-block disabled'>Shipped</button></td></tr>";
			}else{
				echo "<tr><td>".$row['orderid']."</td><td>".$row['address']."</td><td>".$row['items']."</td><td><a class='btn btn-primary btn-block' href='adjax.php?q=".$row['orderid']."'>Ship?</a></td></tr>";
			}
			
		}
	}
	
	function orders($conn){
		$past3 = strtotime("3 days ago");
		$realPast = date("Y-m-j", $past3);
		$sql = "select * from _carts where status = 'paid' or date > '$realPast'";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){
			echo "<tr><td>".$row['date']."</td><td>".$row['cart_id']."</td><td>".$row['prod_name']."</td><td>".$row['quant']."</td><td>".$row['total']."</td><td>".$row['status']."</td></tr>";
		}
	}
	
	function stalledCarts($conn){
		$past3 = strtotime("3 days ago");
		$realPast = date("Y-m-j", $past3);
		$sql = "select cart_id, sum(total) as worth from _carts where date <= '$realPast' and status='' group by cart_id";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){
			echo "<tr><td>".$row['cart_id']."</td><td>".$row['worth']."</td></tr>";
		}
	}
?>













