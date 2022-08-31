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
						    <span class="text">7-14 Business days delivery &amp; Free Returns</span>
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
	          <li class="nav-item"><a href="shop.php" class="nav-link">Shop</a></li>
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
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Cart</span></p>
            <h1 class="mb-0 bread">My Wishlist</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row">
    			<div class="col-md-12 ftco-animate">
    				<div class="cart-list">
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <th>&nbsp;</th>
						        <th>Product</th>
						        <th>Price</th>
						        <th>Quantity</th>
						        <th>Total</th>
						      </tr>
						    </thead>
						    <tbody>
								<?php
									$sql = "select * from _carts where cart_id=$cart and status=''";
									$result = $conn->query($sql);
									while($rows = $result->fetch_assoc()){
										echo '<tr class="text-center">
											<td class="product-remove"><a style="cursor:pointer" class="c"><span class="ion-ios-close"></span></a></td>
											
											<td class="product-name">
												<h3>'.$rows["prod_name"].'</h3>
												<p style="display:none">'.$rows["sn"].'</p>
											</td>
											
											<td class="price">$<span>'.$rows["price"].'</span></td>
											
											<td class="quantity">
												<div class="input-group mb-3">
													<button class="qty quantity-left-minus">-</button>
													<input type="text" name="quantity" class="quant quantity form-control input-number" value="'.$rows["quant"].'" min="1" max="100">
													<button class="qty quantity-right-plus">+</button>
												</div>
											</td>
											
											<td class="total">$<span>'.$rows["total"].'</span></td>
										</tr>';
									}
								?>
						      <!--<tr class="text-center">
						        <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>
						        
						        <td class="image-prod"><div class="img" style="background-image:url(images/product-4.jpg);"></div></td>
						        
						        <td class="product-name">
						        	<h3>Nike Free RN 2019 iD</h3>
						        	<p>Far far away, behind the word mountains, far from the countries</p>
						        </td>
						        
						        <td class="price">$15.70</td>
						        
						        <td class="quantity">
						        	<div class="input-group mb-3">
									<button class='quantity-left-minus'>-</button>
					             	<input type="text" id="quantity" name="quantity" class="quantity qty form-control input-number" value="1" min="1" max="100">
									<button class='quantity-right-plus'>+</button>
					          	</div>
					          </td>
						        
						        <td class="total">$15.70</td>
						      </tr>-->
						    </tbody>
						  </table>
					  </div>
    			</div>
    		</div>
    		<div class="row justify-content-start">
    			<div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
    				<div class="cart-total mb-3">
    					<h3>Cart Totals</h3>
    					<p class="d-flex dim">
							<?php
								$sql = "select sum(total) as subtotal from _carts where cart_id=$cart and status=''";
								$sql2 = "select prodid,quant,size,colour from _carts where cart_id=$cart and status=''";
								$result = $conn->query($sql);
								$result2 = $conn->query($sql2);
								$r = $result->fetch_assoc();
								$order = "";
								while($re = $result2->fetch_assoc()){
									$order .= $re['prodid'].",".$re['quant'].",".$re['size'].",".$re['colour'].";";
								}
							?>
    						<span>Subtotal</span>
    						$<span id="subtotal"><?php echo($r['subtotal']) ?></span>
    					</p>
    					<p class="d-flex dim">
    						<span>Delivery</span>
    						$<span>1000</span>
    					</p>
    					<p class="d-flex dim">
    						<span>Discount</span>
    						$<span>-500</span>
    					</p>
    					<hr>
    					<p class="d-flex total-price">
    						<span>Total</span>
    						$<span id="tp"></span>
    					</p>
    				</div>
    				<p class="text-center">
						<a href="checkout.php" class="btn btn-primary py-3 px-4">Proceed to Checkout</a>
					</p>
					<p class="text-center">
						<a href="javascript:payOnDelivery()" class="btn btn-primary py-3 px-4" >Pay On Delivery</a>
					</p>
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
			var k = 0;
			$(".dim span:nth-child(2)").each(function(){
				k += parseInt($(this).html());
			});
			$("#tp").html(k);
					
			var quantity=0;
			
		    $('.quantity-right-plus').click(function(e){
		        
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($(this).prev().val());
		        
		        // If is not undefined
		            
		            $(this).prev().val(quantity + 1);

		          
		            // Increment
		        
		    });

		    $('.quantity-left-minus').click(function(e){
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($(this).next().val());
		        
		        // If is not undefined
		      
		            // Increment
		            if(quantity>1){
						$(this).next().val(quantity - 1);
		            }
		    });
			
			$(".qty").on("click", function(){
				var quant = $(this).siblings().filter("input").val();
				var total = $(this).parent().parent().next().find("span");
				var serial = $(this).parent().parent().prev().prev().find("p").html();
				var price = $(this).parent().parent().prev().find("span").html();
				$.get("ajx.php", {quant:quant, serial:serial, price:price}, function(data){
					total.html(data);
					// update subtotal
					var t=0;
					$(".total span").each(function(){
						t += parseInt($(this).html());
					});
					$("#subtotal").html(t);
					//update grand total
					var g = 0;
					$(".dim span:nth-child(2)").each(function(){
						g += parseInt($(this).html());
					});
					$("#tp").html(g);
				});
			})
			
			$(".quant").on("blur", function(){
				var quant = $(this).val();
				var total = $(this).parent().parent().next().find("span");
				var serial = $(this).parent().parent().prev().prev().find("p").html();
				var price = $(this).parent().parent().prev().find("span").html();
				$.post("ajx.php", {quant:quant, serial:serial, price:price}, function(data){
					total.html(data);
					// update subtotal
					var t=0;
					$(".total span").each(function(){
						t += parseInt($(this).html());
					});
					$("#subtotal").html(t);
					//update grand total
					var g = 0;
					$(".dim span:nth-child(2)").each(function(){
						g += parseInt($(this).html());
					});
					$("#tp").html(g);
				});
			});
			
			$(".c").on("click", function(){
				var serial = $(this).parent().next().find("p").html();
				$.post("ajx.php", {sn:serial}, function(data){
					location.reload(true);
				});
			});
			
		});
		
		function payOnDelivery(){
			var address = prompt("Your Address Please?", "Your Address");
			if(address){
				var ses = "<?php echo($_SESSION['id']) ?>";
				var items = "<?php echo($order) ?>";
				$.post("ajx.php", {add:address, ses:ses, items:items}, function(data){
					alert(ses + " is your order ID, present it to collect your items.");
					location.reload(true);
				})
			}
			
			
		}
	</script>
    
  </body>
</html>