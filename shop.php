<?php
	session_start();
	if(!isset($_SESSION['id'])){
		$sess = rand(999,9999999);
		$_SESSION['id'] = $sess;
	}
	
	include "conn.php";
	$cart = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>I-rish</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="admin/bower_components/font-awesome/css/font-awesome.min.css">
  </head>
  <body class="goto-here">
		<div class="py-1 bg-black">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
	    		<div class="col-lg-12 d-block">
		    		<div class="row d-flex">
		    			<div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <span class="text">+234 (0)816 438 3680</span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
						    <span class="text">ugahchymdy@gmail.com</span>
					    </div>
					    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
						    <span class="text">7 Business days delivery &amp; Free Returns</span>
					    </div>
				    </div>
			    </div>
		    </div>
		  </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">I-rish</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <?php
				$sql = "select count(*) as count from _carts where cart_id=$cart and status=''";
				$result = $conn->query($sql);
				$rows = $result->fetch_assoc();
			?>
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
	          <li class="nav-item active"><a href="shop.php" class="nav-link">Shop</a></li>
	          <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
	          <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
	          <li class="nav-item"><a href="track.php" class="nav-link">Track</a></li>
	          <li class="nav-item cta cta-colored"><a href="cart.php" class="nav-link"><span class="icon-shopping_cart"></span>[<i id='cart'><?php echo($rows['count']); ?></i>]</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Shop</span></p>
            <h1 class="mb-0 bread">Shop</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-8 col-lg-10 order-md-last">
    				<div class="row">
						<?php
							if(!isset($_GET['pg'])){
								$sql = "select * from _products";
								$pgp = 2;
								$pgm = 1;
								if(isset($_GET['c1'])){
									$cat = $_GET['c1']."%".$_GET['c2']."%";
									$sql .= " where categories like '$cat'";
								}
								if(isset($_GET['p1'])){
									$p1 = $_GET['p1'];
									$p2 = $_GET['p2'];
									$sql .= " where price between $p1 and $p2 order by name desc";
								}
								if(isset($_GET['desc'])){
									$desc = $_GET['desc'];
									$sql .= " where name like '%$desc%'";
								}
								$sql .= " limit 6";
							}else{
								$pg = $_GET['pg']-1;
								$pg *= 6; // change this figure and also change the other figures too to change the number of product per page
								$sql = "select * from _products";
								$pgp = $_GET['pg'] + 1;
								$pgm = $_GET['pg'] - 1;
								if(isset($_GET['c1'])){
									$cat = $_GET['c1']."%".$_GET['c2'];
									$sql .= " where categories like '$cat'";
									
								}
								if(isset($_GET['p1'])){
									$p1 = $_GET['p1'];
									$p2 = $_GET['p2'];
									$sql .= " where price between $p1 and $p2 order by name";
								}
								if(isset($_GET['desc'])){
									$desc = $_GET['desc'];
									$sql .= " where name like '%$desc%'";
								}
								$sql .= " limit $pg,6";
							}
							
							$result = $conn->query($sql);
							if($result->num_rows == 0){
								echo "<script>alert('This page does not exist')</script>";
								echo "<script>location.replace('shop.php')</script>";
								
							}
							//echo $sql;
							while($row = $result->fetch_assoc()){
								echo '<div class="col-sm-12 col-md-12 col-lg-4 ftco-animate d-flex">
									<div class="product d-flex flex-column" style="box-shadow: 5px 5px 10px;">
										<a href="product-single.php?pid='.$row["prodid"].'" class="img-prod"><img class="img-fluid" src="images/products/'.$row["image"].'" alt="Colorlib Template">
											<div class="overlay"></div>
										</a>
										<div class="text py-3 pb-4 px-3">
											<div class="d-flex">
												<div class="cat">
													<span>Lifestyle</span>
												</div>
												<div class="rating">
													<p class="text-right mb-0">
														<a href="#"><span class="ion-ios-star-outline"></span></a>
														<a href="#"><span class="ion-ios-star-outline"></span></a>
														<a href="#"><span class="ion-ios-star-outline"></span></a>
														<a href="#"><span class="ion-ios-star-outline"></span></a>
														<a href="#"><span class="ion-ios-star-outline"></span></a>
													</p>
												</div>
											</div>
											<h3><a href="#">'.$row["name"].'</a></h3>
											<div class="pricing">
												<p class="price">$<span class="pricee">'.$row["price"].'</span></p>
											</div>
											<p class="bottom-area d-flex px-3">
												<a type="button" class="but add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
												<a type="button" class="but1 buy-now text-center py-2">Buy now<span><i class="ion-ios-cart ml-1"></i></span></a>
											</p>
											<p id="pid" style="display:none">'.$row['prodid'].'</p>
										</div>
									</div>
								</div>';
							}
							
						?>
		    		</div>
		    		<div class="row mt-5">
					  <div class="col text-center">
						<div class="block-27">
						  <ul>
							<?php
								if(isset($_GET['c1'])){
									$cat = "c1=".$_GET['c1']."&c2=".$_GET['c2'];
									echo "<li><a href='shop.php?pg=$pgm&$cat'>&lt;</a></li>
									<li><a href='shop.php?pg=$pgp&$cat'>&gt;</a></li>";
								}elseif(isset($_GET['desc'])){
									$cat = "desc=".$_GET['desc'];
									echo "<li><a href='shop.php?pg=$pgm&$cat'>&lt;</a></li>
									<li><a href='shop.php?pg=$pgp&$cat'>&gt;</a></li>";
								}elseif(isset($_GET['p1'])){
									$cat = "p1=".$_GET['p1']."&p2=".$_GET['p2'];
									echo "<li><a href='shop.php?pg=$pgm&$cat'>&lt;</a></li>
									<li><a href='shop.php?pg=$pgp&$cat'>&gt;</a></li>";
								}else{
									echo "<li><a href='shop.php?pg=$pgm'>&lt;</a></li>
									<li><a href='shop.php?pg=$pgp'>&gt;</a></li>";
								}
							?>
						  </ul>
						</div>
					  </div>
					</div>
		    	</div>

		    	<div class="col-md-4 col-lg-2">
		    		<div class="sidebar">
							<div class="sidebar-box-2">
								<h2 class="heading">Categories</h2>
								<div class="fancy-collapse-panel">
								  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
									 <div class="panel panel-default">
										 <div class="panel-heading" role="tab" id="headingOne">
											 <h4 class="panel-title">
												 <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Men's
												 </a>
											 </h4>
										 </div>
										 <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
											 <div class="panel-body">
												 <ul>
													<li><a href="shop.php?c1=male&c2=sport">Shoes</a></li>
													<li><a href="shop.php?c1=male&c2=sport">Jackets</a></li>
													<li><a href="shop.php?c1=male&c2=sport">Shirts</a></li>
													<li><a href="shop.php?c1=male&c2=sport">Jeans</a></li>
													<li><a href="shop.php?c1=male&c2=sport">T-Shirt</a></li>
												 </ul>
											 </div>
										 </div>
									 </div>
									 <div class="panel panel-default">
										 <div class="panel-heading" role="tab" id="headingTwo">
											 <h4 class="panel-title">
												 <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Women's
												 </a>
											 </h4>
										 </div>
										 <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
											 <div class="panel-body">
												<ul>
													<li><a href="shop.php?c1=female&c2=sport">Shoes</a></li>
													<li><a href="shop.php?c1=female&c2=sport">Gowns</a></li>
													<li><a href="shop.php?c1=female&c2=sport">Skirts</a></li>
													<li><a href="shop.php?c1=female&c2=sport">T-Shirt</a></li>
													<li><a href="shop.php?c1=female&c2=sport">Jeans</a></li>
													<li><a href="shop.php?c1=female&c2=sport">Jackets</a></li>
												</ul>
											 </div>
										 </div>
									 </div>
									 <div class="panel panel-default">
										 <div class="panel-heading" role="tab" id="headingThree">
											 <h4 class="panel-title">
												 <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Accessories
												 </a>
											 </h4>
										 </div>
										 <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
											 <div class="panel-body">
												<ul>
													<li><a href="#">Rings</a></li>
													<li><a href="#">Necklaces</a></li>
													<li><a href="#">Anklets</a></li>
													<li><a href="#">Watches</a></li>
												 </ul>
											 </div>
										 </div>
									 </div>
								  </div>
								</div>
							</div>
							<div class="sidebar-box-2">
								<h2 class="heading">Price Range</h2>
								<form method="get" class="colorlib-form-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
								  <div class="row">
									<div class="col-md-12">
									  <div class="form-group">
										<label for="guests">Price from:</label>
										<div class="form-field">
										  <i class="icon icon-arrow-down3"></i>
										  <input name="p1" type="number" min="1000" id="people" class="form-control">
										</div>
									  </div>
									</div>
									<div class="col-md-12">
									  <div class="form-group">
										<label for="guests">Price to:</label>
										<div class="form-field">
										  <i class="icon icon-arrow-down3"></i>
										  <input name="p2" type="number" min="1000" id="people" class="form-control">
										</div>
									  </div>
									</div>
									<div class="col-md-12">
									  <div class="form-group">
										<div class="form-field">
										  <button class="btn btn-block" style="background-color:#dbcc8f; color:#ffffff">SEARCH</button>
										</div>
									  </div>
									</div>
								  </div>
								</form>
								<form class="billing-form">
									
									<input type="text" class="form-control" placeholder="Product name" name="desc">
									  
						
									  
									
								</form>
							</div>
						</div>
    			</div>
    		</div>
    	</div>
    </section>
		
		<section class="ftco-gallery">
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-md-8 heading-section text-center mb-4 ftco-animate">
            <h2 class="mb-4">Follow Us On Instagram</h2>
          </div>
    		</div>
    	</div>
    	<div class="container-fluid px-0">
    		<div class="row no-gutters">
					<div class="col-md-4 col-lg-2 ftco-animate">
						<a href="images/gallery-1.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/gallery-1.jpg);">
							<div class="icon mb-4 d-flex align-items-center justify-content-center">
    						<span class="icon-instagram"></span>
    					</div>
						</a>
					</div>
					<div class="col-md-4 col-lg-2 ftco-animate">
						<a href="images/gallery-2.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/gallery-2.jpg);">
							<div class="icon mb-4 d-flex align-items-center justify-content-center">
    						<span class="icon-instagram"></span>
    					</div>
						</a>
					</div>
					<div class="col-md-4 col-lg-2 ftco-animate">
						<a href="images/gallery-3.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/gallery-3.jpg);">
							<div class="icon mb-4 d-flex align-items-center justify-content-center">
    						<span class="icon-instagram"></span>
    					</div>
						</a>
					</div>
					<div class="col-md-4 col-lg-2 ftco-animate">
						<a href="images/gallery-4.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/gallery-4.jpg);">
							<div class="icon mb-4 d-flex align-items-center justify-content-center">
    						<span class="icon-instagram"></span>
    					</div>
						</a>
					</div>
					<div class="col-md-4 col-lg-2 ftco-animate">
						<a href="images/gallery-5.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/gallery-5.jpg);">
							<div class="icon mb-4 d-flex align-items-center justify-content-center">
    						<span class="icon-instagram"></span>
    					</div>
						</a>
					</div>
					<div class="col-md-4 col-lg-2 ftco-animate">
						<a href="images/gallery-6.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/gallery-6.jpg);">
							<div class="icon mb-4 d-flex align-items-center justify-content-center">
    						<span class="icon-instagram"></span>
    					</div>
						</a>
					</div>
        </div>
    	</div>
    </section>

    <footer class="ftco-footer ftco-section">
      <div class="container">
      	<div class="row">
      		<div class="mouse">
						<a href="#" class="mouse-icon">
							<div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
						</a>
					</div>
      	</div>
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">I-rish</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Menu</h2>
              <ul class="list-unstyled">
                <li><a href="shop.php" class="py-2 d-block">Shop</a></li>
                <li><a href="about.php" class="py-2 d-block">About</a></li>
                <li><a href="contact.php" class="py-2 d-block">Contact Us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Help</h2>
              <div class="d-flex">
	              <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
	                <li><a href="#" class="py-2 d-block">Shipping Information</a></li>
	                <li><a href="#" class="py-2 d-block">Returns &amp; Exchange</a></li>
	                <li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li>
	                <li><a href="#" class="py-2 d-block">Privacy Policy</a></li>
	              </ul>
	              <ul class="list-unstyled">
	                <li><a href="#" class="py-2 d-block">FAQs</a></li>
	                <li><a href="#" class="py-2 d-block">Contact</a></li>
	              </ul>
	            </div>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Chimuga Technologies
						  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						</p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
  <script>
	$(document).ready(function(){
		$(".but").click(function(){
			var pid = $(this).parent().next().html();
			var price = $(this).parent().prev().find(".pricee").html();
			//var price = $(".pricee").eq(0).html();
			//var name = $("#name").html();
			var name = $(this).parent().prev().prev().find("a").html();
			var cart = "<?php echo $_SESSION['id'] ?>";
			$.post("ajx.php", {name:name, cart:cart, price:price, pid:pid, colour:"default", size:"default"}, function(data){
				$('#cart').html(data);
			})
		});
		
		$(".but1").click(function(){
			var pid = $(this).parent().next().html();
			var price = $(this).parent().prev().find(".pricee").html();
			//var price = $(".pricee").eq(0).html();
			//var name = $("#name").html();
			var name = $(this).parent().prev().prev().find("a").html();
			var cart = "<?php echo $_SESSION['id'] ?>";
			$.post("ajx.php", {name:name, cart:cart, price:price, pid:pid, colour:"default", size:"default"}, function(data){
				//$('#cart').html(data);
				location.assign("cart.php");
			})
		});
		
		function confirmInput() {
			document.forms[1].submit();
		}
	});
  </script>
  </body>
</html>