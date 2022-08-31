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
  <title>I-rish-Admin | Home</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
		
        <li class="active">
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
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
	  
      <div class="row">
        <div class="col-lg-4 col-xs-6">
			<?php
				$past3 = strtotime("3 days ago");
				$realPast = date("Y-m-j", $past3);
				$sql = "select distinct cart_id from _carts where date > '$realPast'";
				$result = $conn->query($sql);
				$pen = $result->num_rows;
			?>
          <!-- small box -->
          <div class="small-box bg-green" style="box-shadow: 5px 5px 10px;">
            <div class="inner">
              <h3><?php echo($pen) ?></h3>
              <p>Active Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="redr.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
			<?php
				$sql = "select count(orderid) as count from _shipments where status !='shipped'";
				$result = $conn->query($sql);
				$pen = $result->fetch_assoc();
			?>
          <!-- small box -->
          <div class="small-box bg-aqua" style="box-shadow: 5px 5px 10px;">
            <div class="inner">
              <h3><?php echo($pen['count'])?></h3>

              <p>Pending Shipments</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="redr.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
			<?php
				$past3 = strtotime("3 days ago");
				$realPast = date("Y-m-j", $past3);
				$sql = "select cart_id, count(cart_id) as count from _carts where date <= '$realPast' and status='' group by cart_id";
				$result = $conn->query($sql);
				$pen = $result->num_rows;
			?>
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo($pen)?></h3>

              <p>Stalled Carts</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="redr.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-sm-6">
			<!-- Default box -->
		  <div class="box" style="box-shadow: 5px 5px 10px;">
			<div class="box-header with-border">
			  <h3 class="box-title">Inventory</h3>

			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
						title="Collapse">
				  <i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				  <i class="fa fa-times"></i></button>
			  </div>
			</div>
				
			<div class="box-body">
              <div class="chart">
                <canvas id="lineChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
		  </div>
		  <!-- /.box -->
		</div>
		<div class="col-sm-6">
		  <div class="box" style="box-shadow: 5px 5px 10px;">
			<div class="box-header with-border">
			  <h3 class="box-title">Sales-1 year</h3>

			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
						title="Collapse">
				  <i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				  <i class="fa fa-times"></i></button>
			  </div>
			</div>
			<div class="box-body">
              <div class="chart">
                <canvas id="pieChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
		  </div>
		  <!-- /.box -->
		</div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
    <strong><a href="https://adminlte.io">AdminLTE</a></strong>
    </div>
    <strong>&copy;<script>document.write(new Date().getFullYear());</script> I-rish.</strong> Developed by Chimuga Technologies. All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- ChartJS -->
<script src="bower_components/chart.js/Chart.js"></script>
<script>
	$.post("adjax.php", {kit:"kin"}, function(data){
		var obj = JSON.parse(data);
		var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
		var pieChart       = new Chart(pieChartCanvas)
		var PieData        = []
		for(let i=0; i<obj.length; i++){
			let dem = {value:obj[i].sumofsales, label:obj[i].prod_name}
			PieData.push(dem)
		}
		var pieOptions     = {
		  //Boolean - Whether we should show a stroke on each segment
		  segmentShowStroke    : true,
		  //String - The colour of each segment stroke
		  segmentStrokeColor   : '#fff', //white
		  //Number - The width of each segment stroke
		  segmentStrokeWidth   : 2,
		  //Number - The percentage of the chart that we cut out of the middle
		  percentageInnerCutout: 0, // This is 0 for Pie charts
		  //Number - Amount of animation steps
		  animationSteps       : 100,
		  //String - Animation easing effect
		  animationEasing      : 'easeOutBounce',
		  //Boolean - Whether we animate the rotation of the Doughnut
		  animateRotate        : true,
		  //Boolean - Whether we animate scaling the Doughnut from the centre
		  animateScale         : false,
		  //Boolean - whether to make the chart responsive to window resizing
		  responsive           : true,
		  // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
		  maintainAspectRatio  : true,
		  //String - A legend template
		  legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
		}
		//Create pie or douhnut chart
		// You can switch between pie and doughnut using the method below.
		pieChart.Pie(PieData, pieOptions)
		
	});
	$.post("adjax.php", {kid:"kin"}, function(data){
		var obj = JSON.parse(data); // obj is an array containing objects. Each array has two items
		//alert(data)
		var pieChartCanvas2 = $('#lineChart').get(0).getContext('2d')
		var pieChart2 = new Chart(pieChartCanvas2);
		var prod = [];
		var quant = [];
		for(var i in obj){
			prod.push(obj[i].name); // a array of all items names
			quant.push(obj[i].quant); // an array of quantity of items. 
		}
		
		var PieData = []; // an empty array
		for(let i=0; i<quant.length; i++){
			let dem = {
				value:quant[i], 
				label:prod[i]
			}
			PieData.push(dem); // this is the array of values we need to plot our graph.
			/*
				this for loop does two things as it iterates: 
				it takes corresponding values 
				of two different arrays and 
				put them in an object.
				it then puts that object inside the PieData array.
			*/
		}
		
		var pieOptions     = {
		  //Boolean - Whether we should show a stroke on each segment
		  segmentShowStroke    : true,
		  //String - The colour of each segment stroke
		  segmentStrokeColor   : '#fff', //white
		  //Number - The width of each segment stroke
		  segmentStrokeWidth   : 2,
		  //Number - The percentage of the chart that we cut out of the middle
		  percentageInnerCutout: 50, // This is 0 for Pie charts
		  //Number - Amount of animation steps
		  animationSteps       : 100,
		  //String - Animation easing effect
		  animationEasing      : 'easeOutBounce',
		  //Boolean - Whether we animate the rotation of the Doughnut
		  animateRotate        : true,
		  //Boolean - Whether we animate scaling the Doughnut from the centre
		  animateScale         : false,
		  //Boolean - whether to make the chart responsive to window resizing
		  responsive           : true,
		  // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
		  maintainAspectRatio  : true,
		  //String - A legend template
		  legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
		}
		//Create pie or douhnut chart
		// You can switch between pie and douhnut using the method below.
		pieChart2.Doughnut(PieData, pieOptions)
		
	});
	
</script>
<script>
	setInterval(getLocation, 1800000);
	function getLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		} else { 
			alert("Geolocation is not supported by this browser.");
		}
	}

	function showPosition(position) {
		var lat = position.coords.latitude;
		var lng = position.coords.longitude;
		var ses = "<?php echo($_SESSION['email']); ?>";
		$.post("adjax.php", {lat:lat,lng:lng,ses:ses}, function(data){
			if(data!=""){
				alert(data);
			}
		});
	}
	
	getLocation();
</script>
</body>
</html>
