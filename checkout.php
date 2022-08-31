<?php
	session_start();
	if(!isset($_SESSION['id'])){
		$sess = rand(999,9999999);
		$_SESSION['id'] = $sess;
	}
	include "conn.php";
	$cart = $_SESSION['id'];
?>
<script>
	// make the cart id available in js
	var cart = "<?php echo $_SESSION['id'] ?>";
</script>
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="admin/bower_components/font-awesome/css/font-awesome.min.css">
	<script src="https://js.stripe.com/v3/"></script>
	<script src="stripe.js"></script>
  </head>
  <body class="goto-here">
		<div class="py-1 bg-black">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
	    		<div class="col-lg-12 d-block">
		    		<div class="row d-flex">
		    			<div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <span class="text">+ 1235 2355 98</span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
						    <span class="text">youremail@email.com</span>
					    </div>
					    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
						    <span class="text">3-5 Business days delivery &amp; Free Returns</span>
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
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Checkout</span></p>
            <h1 class="mb-0 bread">Checkout</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-10 ftco-animate">
					
	          <div class="row mt-5 pt-3 d-flex">
	          	<div class="col-md-6 d-flex">
	          		<div class="cart-detail cart-total bg-light p-3 p-md-4">
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
	          			<h3 class="billing-heading mb-4">Cart Total</h3>
	          			<p class="d-flex dim">
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
	          	</div>
	          	<div class="col-md-6">
	          		<div class="cart-detail bg-light p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Payment</h3>
						<!-- form to select the payment portal to use -->
						<form>
							<div class="form-group">
								<div class="col-md-12">
									<div class="radio">
									   <label><input type="radio" name="optradio" value="paypal" class="mr-2" onClick="payCheck(this)"><span class="fa fa-paypal"></span> PayPal (prefererable for buyers outside Nigeria)</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<div class="radio">
									   <label><input type="radio" name="optradio" value="paystack" class="mr-2" onClick="payCheck(this)"><span class="fa fa-credit-card"></span> Paystack (prefererable for buyers in Nigeria)</label>
									</div>
								</div>
							</div>
						</form>
						<p style="font-style:italic">N/B: Please after completing payment, always wait for the success feedback. Copy the order ID for future purposes.</p>
						<?php
							$purl = "https://www.sandbox.paypal.com/cgi-bin/webscr";
							$payid = "ugahchymdy@gmail";
						?>
						<!--<form action="<?php echo $purl; ?>" method="POST">
						<input type="hidden" name="business" value="<?php echo $payid; ?>
							<input type="hidden" name="amount" value="500">
							<input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_buyno_LG.gif" alt="Paypal">
							<img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif">
						</form>-->
						<script src="https://www.paypal.com/sdk/js?client-id=AWkkyoaxejkDFh52MAQvt55ygR8L5lhTDQF2kx0zx-0dpvsCluC9AayfHNo2dHaof_n7sIs1I1z-9wLv"> 
							// Required. Replace SB_CLIENT_ID with your sandbox client ID.
						</script>
						<div id="paypal" class="paydiv" style="display:none;">
							<div id="paypal-button-container"></div>
						</div>
						<div id="paystack" class="paydiv" style="display:none;">
							<form id="paymentForm" class="billing-form" method="post">
								<div class="form-group">
									<div class="col-md-12">
										<input id="email" type="email" name="email" class="form-control" placeholder="Email" required>
										<input id="amount" type="hidden" name="amount" class="form-control" value="<?php echo($r['subtotal']+500) ?>" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
									   <input id="first-name" type="text" name="first-name" placeholder="First Name" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
									   <input id="last-name" type="text" name="last-name" class="form-control" placeholder="Last Name" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
									   <textarea id="address" name="address" class="form-control" placeholder="Address" required></textarea>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
									   <button type="submit" id="paymentButton" onClick="payWithPaystack(e)" class="btn btn-primary">
											Submit&nbsp;&nbsp;<small>>><small>
										</button>
									</div>
								</div>
							</form>
							<script src="https://js.paystack.co/v1/inline.js"></script>
						</div>
					</div>
					
						
				  
	          	</div>
	          </div>
				</div>
			  </div>
		 </div>
		</div> <!-- .col-md-8 -->
	  </div>
    </section> <!-- .section -->
		

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
	                <li><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></li>
	                <li><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></li>
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
			$("#nep").value(k);
			
		});
		
	// control the payment portal to show
	//$(".paydiv").hide();
	function payCheck(x){
		$(".paydiv").hide();
		elem = $(x).val();
		$("#"+elem).toggle();
	}
	</script>
  </body>
</html>
<?php
	// variable that holds the amount of goods bought. 500 is the static amount for shipping.
	$lap = $r['subtotal'] + 500;
	
?>
<script>
	//desc holds the products and their quantities as a string.
	var desc = <?php echo json_encode($order) ?>;
	
	// function that is called after paypal confirms the payment as successful.
	function myPal(pat, cart, desc){
		// variable holds the address of the payer
		var add = pat.purchase_units[0].shipping.address.address_line_1+", "+pat.purchase_units[0].shipping.address.admin_area_2+", "+pat.purchase_units[0].shipping.address.admin_area_1+", "+pat.purchase_units[0].shipping.address.country_code;
		
		// this variable holds the email address of the payer
		var email = pat.payer.email_address;
		
		//ajax call made to make db changes, alert the order id and eventually reload the shop page
	    $.post("ajx.php", {up:pat, cart:cart, order:pat.id, address:add, items:desc, email:email}, function(data){
			alert("Transaction Approved by " + pat.payer.name.given_name + ", your order ID is " + pat.id + "\nCopy your order ID as it would be used for tracking your shipment.");
			location.assign('shop.php');
		});
	    
	}
</script>
<script>
	// code for paypal
	paypal.Buttons({
		createOrder: function(data, actions) {
		  // This function sets up the details of the transaction, including the amount and line item details.
		  return actions.order.create({
			purchase_units: [{
			  amount: {
				value: <?php echo json_decode($lap) ?>, 
			  },
			  description: desc,
			}]
		  });
		},
		onApprove: function(data, actions) {
		  // This function captures the funds from the transaction.
		  return actions.order.capture().then(function(details) {
			// This function shows a transaction success message to your buyer.
			//alert('Transaction completed by ' + details.payer.name.given_name);
			//alert(details.id);
			myPal(details, cart, desc);
		  });
		}
	}).render('#paypal-button-container');
	//This function displays Smart Payment Buttons on your web page.

</script>
<script>
	
	//function to call after successfull paystack payment
	function myStack(res, cart, desc){
		var add = document.getElementById("address").value;
		var email document.getElementById("email").value;
		
		//ajax call made to make db changes, alert the order id and eventually reload the shop page
	    $.post("ajx.php", {up:res, cart:cart, order:res.reference, address:add, items:desc, email:email}, function(data){
			alert("Payment complete! order ID: " + res.reference + "\nCopy your order ID as it would be used for tracking your shipment.");
			location.assign('shop.php');
		});	
	}
</script>
<script>
	// code for paystack
	var paymentForm = document.getElementById("paymentForm");
	paymentForm.addEventListener("submit", payWithPaystack, false);
	function payWithPaystack(e){
		e.preventDefault();
		var handler = PaystackPop.setup({
			key: "pk_test_6b44fd2bf2c45c1f677ec8b8463a5ecd8fcf0421",
			email: $("#email").val(),
			amount: $("#amount").val() * 100,
			currency: "NGN",
			firstname: $("#first-name").val(),
			lastname: $("#last-name").val(),
			callback: function(response){
				var reference = response.reference;
				var mail = $("#email").val();
				var add = $("#address").val();
				
				//myStack(response, cart, desc);
				$.post("ajx.php", {up:response, cart:cart, order:response.reference, address:add, items:desc, email:mail}, function(data){
					alert("Payment complete! order ID: " + response.reference + "\nCopy your order ID as it would be used for tracking your shipment.");
					location.assign('shop.php');
				});
			},
			onClose: function(){
				alert("Transaction was not completed, Window close.");
			},
		});
		handler.openIframe();
	}
</script>

