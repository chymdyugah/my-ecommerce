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
	if(isset($_POST['dat1'])){
		$dat1 = $_POST['dat1'];
		$dat2 = $_POST['dat2'];
	}else{
		$nw = strtotime("now");
		$dn = strtotime("-1 month");
		$nw = date("Y-m-d", $nw);
		$dn = date("Y-m-d", $dn);
	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>I-rish-Admin | Inventory Charts</title>
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
<!-- Site wrapper -->
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

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
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
		<li class="active">
          <a href="inventcharts.php">
            <i class="fa fa-line-chart"></i> <span>Inventory Data Analysis</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Stats and Data
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Stats</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	<div class="row">
		<!-- left column -->
		<div class="col-sm-6">
			<!-- Default box -->
		  <div class="box" style="box-shadow: 5px 5px 10px;">
			<div class="box-header with-border">
			  <h3 class="box-title">Sales</h3>

			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				  <i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				  <i class="fa fa-times"></i>
				</button>
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
		  
		  <div class="box" style="box-shadow: 5px 5px 10px;">
			<div class="box-header with-border">
			  <h3 class="box-title">Sales-All Time</h3>

			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				  <i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				  <i class="fa fa-times"></i>
				</button>
			  </div>
			</div>
				
			<div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
		  </div>
		  <!-- /.box -->
		
		</div>
		
		<!--Right column -->
		<div class="col-sm-6">
		<!-- Default box -->
		  <div class="box" style="box-shadow: 5px 5px 10px;">
			<div class="box-header with-border">
			  <h3 class="box-title">Sales Selection</h3>

			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				  <i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				  <i class="fa fa-times"></i>
				</button>
			  </div>
			</div>
				
			<div class="box-body">
              <div class="chart">
				<form class='form-horizontal' method='post' id="frm">
					<input type='date' name='dat1' id='dat1' required>
					<input type='date' name='dat2' id='dat2' required>
					<input type='submit' name='submit' value="submit" id='submit' class='btn btn-default'>
				</form>
                <canvas id="barChart2" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</div>
	</div>
	
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
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- ChartJS -->
<script src="bower_components/chart.js/Chart.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
  
	var dat1 = JSON.parse(<?php echo($den) ?>);//$('#dat1').val();
	var dat2 = JSON.parse(<?php echo($nw) ?>);//$('#dat2').val();
</script>
<script>
	function getRndInteger(min, max) {
		let x = Math.floor(Math.random() * (max - min + 1) ) + min;
		var bad = "abcdef";
		let i = Math.floor(Math.random() * (5 - 0 + 1) ) + 0;
		i = bad[i];
		let q = Math.floor(Math.random() * (max - min + 1) ) + min;
		let pre = x+i+q;
		return "#" + pre[Math.floor(Math.random() * (2 - 0 + 1) ) + 0] + pre[Math.floor(Math.random() * (2 - 0 + 1) ) + 0] + pre[Math.floor(Math.random() * (2 - 0 + 1) ) + 0];
		
	}
	
	$.post("adjax.php", {kin:"kin"}, function(data){
		var obj = JSON.parse(data); //obj is an array of objects.
		var names = [];
		var ar = [];
		var first = [];
		var prod = obj.shift(); // remove the array holding the names of all products in obj and put it in prod
		for (var a in obj){
			names.push(obj[a].prod_name); // put all names of the all the product inside names. 
			ar.push(obj[a].quant); // put all quantity of the all the product inside ar. 
			/* var dem = {
				label:obj[a].prod_name,
				data : ar
			}
			datum.push(dem); */
		}
		for(var d in prod){
			var pat = []; 
			for(var g in obj){
				if(obj[g].prod_name == prod[d]){
					pat.push(obj[g].quant);
					
				}
				/*
					this for loop checks if the prod_name value of the object at obj in a particular index corresponds with the item at same index in the prod array.
					if they correspond, it puts that quantity value of the object at obj in that index in the pat array.
					for each pat is an array of quantities of a product name at prod.
				*/
				
			}
			var ruf = getRndInteger(0, 9); // a function to randomly create a color code in hexadecimal.
			var dem = {
				data: pat,
				label: prod[d],
				fillColor: ruf,
				strokeColor         : ruf,
				pointColor          : ruf,
				pointStrokeColor    : ruf,
				pointHighlightFill  : '#fff',
				pointHighlightStroke: ruf
			}
			first.push(dem);
			/*
				this main for loop does two things: first, it runs the child for loop
				then it create a data object called dem and put pat as the data of quantities needed for thr chart.
				finally it pushes dem into the array of datasets called first.
				at the end of the loop, first will contain the datasets for all the product items and and their 
				respective quantites.
			*/
		}
		
		//alert(pat)
		var lineChartData = {
		  labels  : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		  datasets: first
		}

		var lineChartOptions = {
		  //Boolean - If we should show the scale at all
		  showScale               : true,
		  //Boolean - Whether grid lines are shown across the chart
		  scaleShowGridLines      : false,
		  //String - Colour of the grid lines
		  scaleGridLineColor      : 'rgba(0,0,0,.05)',
		  //Number - Width of the grid lines
		  scaleGridLineWidth      : 1,
		  //Boolean - Whether to show horizontal lines (except X axis)
		  scaleShowHorizontalLines: true,
		  //Boolean - Whether to show vertical lines (except Y axis)
		  scaleShowVerticalLines  : true,
		  //Boolean - Whether the line is curved between points
		  bezierCurve             : true,
		  //Number - Tension of the bezier curve between points
		  bezierCurveTension      : 1,
		  //Boolean - Whether to show a dot for each point
		  pointDot                : false,
		  //Number - Radius of each point dot in pixels
		  pointDotRadius          : 4,
		  //Number - Pixel width of point dot stroke
		  pointDotStrokeWidth     : 1,
		  //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
		  pointHitDetectionRadius : 20,
		  //Boolean - Whether to show a stroke for datasets
		  datasetStroke           : true,
		  //Number - Pixel width of dataset stroke
		  datasetStrokeWidth      : 2,
		  //Boolean - Whether to fill the dataset with a color
		  datasetFill             : false,
		  //String - A legend template
		  legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
		  //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
		  maintainAspectRatio     : true,
		  //Boolean - whether to make the chart responsive to window resizing
		  responsive              : true
		}

		var lineChartCanvas          = $('#lineChart').get(0).getContext('2d');
		var lineChart                = new Chart(lineChartCanvas);
		lineChart.Line(lineChartData, lineChartOptions);
		
		
	});
	
	$.post("adjax.php", {kun:"kun"},function(data){
		var obj = JSON.parse(data);
		
		names = [];
		datas = [];
		pin = [];
		for (var a in obj){
			names.push(obj[a].prod_name); // put all names of the all the product inside names. 
			datas.push(obj[a].s); // put all quantities of all the product inside datas.
		}
		var ruf = getRndInteger(0, 9); // a function to randomly create a color code in hexadecimal.
		//alert(datas);
		var barChartData = {
		  labels  : names,
		  datasets: [
			{
			  fillColor           : '#0000FF',
			  strokeColor         : '#0000FF',
			  pointColor          : '#0000FF',
			  pointStrokeColor    : '#0000FF',
			  pointHighlightFill  : '#0000FF',
			  pointHighlightStroke: '#0000FF',
			  data                : datas
			}
		  ],
		}
		var barChartCanvas = $('#barChart').get(0).getContext('2d');
		var barChartCanvas2 = $('#barChart2').get(0).getContext('2d');
		var barChart = new Chart(barChartCanvas);
		var barChart2 = new Chart(barChartCanvas2);
		
		var barChartOptions = {
		  //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
		  scaleBeginAtZero        : true,
		  //Boolean - Whether grid lines are shown across the chart
		  scaleShowGridLines      : true,
		  //String - Colour of the grid lines
		  scaleGridLineColor      : 'rgba(0,0,0,.05)',
		  //Number - Width of the grid lines
		  scaleGridLineWidth      : 1,
		  //Boolean - Whether to show horizontal lines (except X axis)
		  scaleShowHorizontalLines: true,
		  //Boolean - Whether to show vertical lines (except Y axis)
		  scaleShowVerticalLines  : true,
		  //Boolean - If there is a stroke on each bar
		  barShowStroke           : true,
		  //Number - Pixel width of the bar stroke
		  barStrokeWidth          : 2,
		  //Number - Spacing between each of the X value sets
		  barValueSpacing         : 5,
		  //Number - Spacing between data sets within X values
		  barDatasetSpacing       : 1,
		  //String - A legend template
		  legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
		  //Boolean - whether to make the chart responsive
		  responsive              : true,
		  maintainAspectRatio     : true
		}

		barChartOptions.datasetFill = false;
		barChart.Bar(barChartData, barChartOptions);
		barChart2.Bar(barChartData, barChartOptions);
		
	});
	
	$('#submit').click(function(e){
		e.preventDefault();
		var dat1 = $('#dat1').val();
		var dat2 = $('#dat2').val();
		if(dat1 && dat2 != ""){
			$("#barChart2").remove();
			$("#frm").after('<canvas id="barChart2" style="height:250px"></canvas>');
			$.post('adjax.php', {dat1:dat1,dat2:dat2}, function(data){
			
				var obj = JSON.parse(data);
			
				names = [];
				datas = [];
				for (var a in obj){
					names.push(obj[a].prod_name); // put all names of the all the product inside names. 
					var ruf = getRndInteger(0, 9); // a function to randomly create a color code in hexadecimal.
					dem = {
					  label               : obj[a].prod_name,
					  fillColor           : ruf,
					  strokeColor         : ruf,
					  pointColor          : ruf,
					  pointStrokeColor    : ruf,
					  pointHighlightFill  : ruf,
					  pointHighlightStroke: ruf,
					  data                : [obj[a].s]
					}
					datas.push(obj[a].s);
				}
				//alert(datas);
				var barChartData = {
				  labels  : names,
				  datasets: [
					{
					  fillColor           : '#0000FF',
					  strokeColor         : '#0000FF',
					  pointColor          : '#0000FF',
					  pointStrokeColor    : '#0000FF',
					  pointHighlightFill  : '#0000FF',
					  pointHighlightStroke: '#0000FF',
					  data                : datas
					}
				  ],
				}
				var barChartCanvas = $('#barChart2').get(0).getContext('2d');
				var barChart = new Chart(barChartCanvas);
				
				var barChartOptions = {
				  //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
				  scaleBeginAtZero        : true,
				  //Boolean - Whether grid lines are shown across the chart
				  scaleShowGridLines      : true,
				  //String - Colour of the grid lines
				  scaleGridLineColor      : 'rgba(0,0,0,.05)',
				  //Number - Width of the grid lines
				  scaleGridLineWidth      : 1,
				  //Boolean - Whether to show horizontal lines (except X axis)
				  scaleShowHorizontalLines: true,
				  //Boolean - Whether to show vertical lines (except Y axis)
				  scaleShowVerticalLines  : true,
				  //Boolean - If there is a stroke on each bar
				  barShowStroke           : true,
				  //Number - Pixel width of the bar stroke
				  barStrokeWidth          : 2,
				  //Number - Spacing between each of the X value sets
				  barValueSpacing         : 5,
				  //Number - Spacing between data sets within X values
				  barDatasetSpacing       : 1,
				  //String - A legend template
				  legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
				  //Boolean - whether to make the chart responsive
				  responsive              : true,
				  maintainAspectRatio     : true
				}

				barChartOptions.datasetFill = false;
				barChart.Bar(barChartData, barChartOptions);
			})

		}else{
			alert("WARNING: Fill in both dates.");
		}
		
	})

</script>
</body>
</html>
