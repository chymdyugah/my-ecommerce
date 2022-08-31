<?php
	session_start();
	if(!isset($_SESSION['email'])){
		echo "<script>location.replace('login.php')</script>";
	}
	include "../conn.php";
	include "functions.php";
	include "../myclasses.php";
	$e = $_SESSION['email'];
	$user = new User($e);
	$user->getUserDetails($conn);
	# new product
	if(isset($_POST['newproduct'])){
		$id = md5(strtotime("now"));
		$id = "prod".substr($id,0,6);
		$image = upload("image", "../images/products/");
		$image = test_input($image);
		$product = new Product($id);
		$product->name = test_input($_POST['name']);
		$product->price = test_input($_POST['price']);
		$product->description = test_input($_POST['desc']);
		$product->tags = test_input($_POST['tag']);
		if(isset($_POST['size'])){
			$product->size = test_input($_POST['size']);
		}
		if(isset($_POST['colours'])){
			$product->colours = test_input($_POST['colours']);
		}
		$retVal = $product->dbInsert($conn, $image);
		
	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>I-rish-Admin | Refill</title>
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
		<li class="active">
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

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inventory/Shipping/Refill
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Refill</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	<div class="row">
		<!-- Left column-->
		<div class="col-sm-6">
			<!-- Default box -->
		  <div class="box" style="box-shadow: 5px 5px 10px;">
			<div class="box-header with-border">
			  <h3 class="box-title">Shipping Form</h3>

			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
						title="Collapse">
				  <i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				  <i class="fa fa-times"></i></button>
			  </div>
			</div>
				
			<div class="box-body">
				<form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<div class="form-group">
					  <label for="product" class="col-sm-2 control-label">Product</label>

					  <div class="col-sm-10">
						<select class="form-control" id="product" name="product" required>
							<option></option>
							<?php
								$sql = "select * from _products";
								$result = $conn->query($sql);
								while($row = $result->fetch_assoc()){
									echo "<option value=".$row['prodid'].">".$row['name']."</option>";
								}
							?>
						</select>
					  </div>
					</div>
					<div class="form-group">
					  <label for="quantity" class="col-sm-2 control-label">Quantity</label>

					  <div class="col-sm-10">
						<input type="number" class="form-control" id="quantity" placeholder="Number only" name="quantity" min=0 required>
					  </div>
					</div>
					<button type="reset" class="btn btn-default">Cancel</button>
					<button type="submit" name="ship" class="btn btn-info pull-right">Submit</button> 
				</form>
			</div> 
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->
		  
		  <!-- Default box -->
		  <div class="box" style="box-shadow: 5px 5px 10px;">
			<div class="box-header with-border">
			  <h3 class="box-title">New Product</h3>

			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
						title="Collapse">
				  <i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				  <i class="fa fa-times"></i></button>
			  </div>
			</div>
				
			<div class="box-body">
				<form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" name="name" placeholder="Product Name" required>
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-sm-2 control-label">Price</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" id="price" name="price" placeholder="Number only" required>
						</div>
					</div>
					<div class="form-group">
						<label for="desc" class="col-sm-2 control-label">Description</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="desc" name="desc" placeholder="Product description. 500 characters max" max="500" required></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="desc" class="col-sm-2 control-label">Cat. Tags</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="tag" name="tag" placeholder="Product categories." max="500" required></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="size" class="col-sm-2 control-label">Colours</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="colours" name="colours">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<div class="checkbox">
							  <label>
								<input type="checkbox" id="size" name="size" value="true"> Sizes
							  </label>
							</div>
						</div>
						
					</div>
					<div class="form-group">
						<label for="image" class="col-sm-2 control-label">Image</label>
						<div class="col-sm-10">
							<input type="file" id="image" name="image" accept="image/*" required>
						</div>
					</div>
					<button type="reset" class="btn btn-default">Cancel</button>
					<button type="submit" name="newproduct" class="btn btn-info pull-right">Submit</button> 
				</form>
			</div> 
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->
		  
		  <!-- Default box -->
		  <div class="box" style="box-shadow: 5px 5px 10px;">
			<div class="box-header with-border">
			  <h3 class="box-title">Reminder Program Form</h3>

			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
						title="Collapse">
				  <i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				  <i class="fa fa-times"></i></button>
			  </div>
			</div>
				
			<div class="box-body">
				<form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<div class="form-group">
					  <label for="name" class="col-sm-2 control-label">Name</label>

					  <div class="col-sm-10">
						<input type="text" class="form-control" id="name" placeholder="Full Name" name="name" required>
					  </div>
					</div>
					<div class="form-group">
					  <label for="phone" class="col-sm-2 control-label">Phone</label>

					  <div class="col-sm-10">
						<input type="text" class="form-control" id="phone" placeholder="Telephone" name="phone" required>
					  </div>
					</div>
					<div class="form-group">
					  <label for="email" class="col-sm-2 control-label">Email</label>

					  <div class="col-sm-10">
						<input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
					  </div>
					</div>
					<div class="form-group">
					  <label for="occassion" class="col-sm-2 control-label">Ocassion</label>

					  <div class="col-sm-10">
						<input type="text" class="form-control" id="ocassion" placeholder="Ocassion" name="ocassion">
					  </div>
					</div>
					<button type="button" id="sms" class="btn btn-default">Cancel</button>
					<button type="submit" name="remind" class="btn btn-info pull-right">Submit</button> 
				</form>
			</div> 
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</div>
		
		<!-- right column-->
		<div class="col-sm-6">
			<!-- Default box -->
		  <div class="box" style="box-shadow: 5px 5px 10px;">
			<div class="box-header with-border">
			  <h3 class="box-title">Refill Form</h3>

			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
						title="Collapse">
				  <i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				  <i class="fa fa-times"></i></button>
			  </div>
			</div>
				
			<div class="box-body">
				<form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<div class="form-group">
					  <label for="product" class="col-sm-2 control-label">Product</label>

					  <div class="col-sm-10">
						<select class="form-control" id="product" name="product" required>
							<option></option>
							<?php
								$sql = "select * from _products";
								$result = $conn->query($sql);
								while($row = $result->fetch_assoc()){
									echo "<option value=".$row['prodid'].">".$row['name']."</option>";
								}
							?>
						</select>
					  </div>
					</div>
					<div class="form-group">
					  <label for="quantity" class="col-sm-2 control-label">Quantity</label>

					  <div class="col-sm-10">
						<input type="number" class="form-control" id="quantity" placeholder="Number only" name="quantity" min=0 required>
					  </div>
					</div>
					<button type="reset" class="btn btn-default">Cancel</button>
					<button type="submit" name="submit" class="btn btn-info pull-right">Submit</button> 
				</form>
			</div> 
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->
		  
		  <div class="box" style="box-shadow: 5px 5px 10px;">
			<div class="box-header with-border">
			  <h3 class="box-title">Assign Shipments</h3>

			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				  <i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				  <i class="fa fa-times"></i></button>
			  </div>
			</div>
				
			<div class="box-body">
				<form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<div class="form-group">
					  <label for="order" class="col-sm-2 control-label">Order</label>

					  <div class="col-sm-10">
						<select class="form-control" id="order" name="order" required>
							<option></option>
							<?php
								$sql = "select * from _shipments";
								$result = $conn->query($sql);
								while($row = $result->fetch_assoc()){
									echo "<option value=".$row['orderid'].">".$row['orderid']."</option>";
								}
							?>
						</select>
					  </div>
					</div>
					<div class="form-group">
					  <label for="driver" class="col-sm-2 control-label">Driver</label>

					  <div class="col-sm-10">
						<select class="form-control" id="driver" name="driver" required>
							<option></option>
							<?php
								$sql = "select * from _users where position='driver'";
								$result = $conn->query($sql);
								while($row = $result->fetch_assoc()){
									echo "<option value=".$row['email'].">".$row['name']."</option>";
								}
							?>
						</select>
					  </div>
					</div>
					<button type="reset" class="btn btn-default">Cancel</button>
					<button type="submit" name="track" class="btn btn-info pull-right">Submit</button> 
				</form>
			</div> 
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->
		  
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
    $.post("adjax.php", {kid:"kin"}, function(data){
		var obj = JSON.parse(data);
		//alert(data)
		var pieChartCanvas2 = $('#lineChart').get(0).getContext('2d')
		var pieChart2 = new Chart(pieChartCanvas2);
		var prod = [];
		var quant = [];
		for(var i in obj){
			prod.push(obj[i].name);
			quant.push(obj[i].quant);
		}
		
		var PieData = [];
		for(let i=0; i<quant.length; i++){
			let dem = {
				value:quant[i], 
				label:prod[i]
			}
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
	var bt = document.getElementById('sms');
	bt.addEventListener('click', sms);
	function sms(){
		var occ = document.getElementById("ocassion").value;
		var xhr = new XMLHttpRequest();
		xhr.open("GET", "https://platform.clickatell.com/messages/http/send?apiKey=krr0aGJKR8exBx3BuPD74A==&to=2348164383680&content="+occ, true);
		xhr.onreadystatechange = function(){
			if(xhr.readyState == 4 & (xhr.status == 200 | xhr.status == 202)){
				alert('sent!');
			}
		};
		xhr.send();
	}
</script>
</body>
</html>

<?php
	# refill
	if(isset($_POST['submit'])){
		$q = test_input($_POST['quantity']);
		$prodid = test_input($_POST['product']);
		echo "<script>alert($prodid)</script>";

		/*
		$d = date("Y-m-d");
		# get the current product quantity
		$sql = "select * from _products where prodid='$prodid'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		if($prodid!=""){
			$q += $row['quantity'];
			$sql = "update _products set quantity=$q where prodid='$prodid';";
			$q -= $row['quantity'];
			$sql .= "insert into _refills (product,date,quantity) values ('$prodid', '$d', $q)";
			if($conn->multi_query($sql)){
				echo "<script>alert('Refill Made')</script>";
			}else{
				echo "Error: An error occured.".$conn->error;
			}
		}else{
			die("<script>alert('Empty Product name')</script>");
		}
		*/
	}
	
	if(isset($_POST['ship'])){
		$q = test_input($_POST['quantity']);
		$prodid = test_input($_POST['product']);
		$d = date("Y-m-d");
		# get the current product quantity
		$sql = "select * from _products where prodid='$prodid'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		if($prodid!=""){
			$p = $row['quantity'] - $q;
			$sql = "update _products set quantity=$p where prodid='$prodid';";
			$sql .= "insert into _shipping_logs (prodid,quantity,date)values('$prodid', $q, '$d')";
			if($conn->multi_query($sql)){
				echo "<script>alert('Shipment Saved')</script>";
			}else{
				echo "Error: An error occured.".$conn->error;
			}
		}else{
			die("<script>alert('Empty Product name')</script>");
		}
		
	}
	
	if(isset($_POST['track'])){
		$order = test_input($_POST['order']);
		$driver = test_input($_POST['driver']);
		$lng = 1.0553;
		$lat = 25.3720;
		$t = date("H:i:s");
		if($order !="" and  $driver !=""){
			$sql = "insert into _track (handler,orderid,time,lng,lat)values('$driver', '$order', '$t', $lng, $lat)";
			if($conn->query($sql)){
				echo "<script>alert('Shipment Sent')</script>";
			}else{
				echo "Error: An error occured. ".$conn->error;
			}
		}else{
			die("<script>alert('Fill all fields')</script>");
		}
		
	}
	
	if(isset($_POST['newproduct'])){
		echo "<script>alert('$retVal')</script>";
	}
	
	if(isset($_POST['remind'])){
		$name = test_input($_POST['name']);
		$phone = test_input($_POST['phone']);
		$email = test_input($_POST['email']);
		$sql = "insert into _reminder(name, phone, email) values ('$name', '$phone', '$email')";
		
		if ($conn->query($sql)){
			echo "<script>alert('New Reminder Saved')</script>";
		}else{
			echo "Error: An error occured. ".$conn->error;
		}
	}
	
?>