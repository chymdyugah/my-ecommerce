<?php
	include "conn.php";
	include "myclasses.php";
	
	if(isset($_REQUEST['name'])){
		// echo "It Worked! ".$_REQUEST['name'];
		$cart = $_REQUEST['cart'];
		$date = date("Y-m-d");
		// create product object
		$product = new Product($_REQUEST['pid']);
		$product->name = $_REQUEST['name'];
		$product->price = $_REQUEST['price'];
		$product->colours = $_REQUEST['colour'];
		$product->size = $_REQUEST['size'];
		
		# check if the product is already in cart
		$sql = "select * from _carts where cart_id='$cart' and status=''";
		$result = $conn->query($sql);
		$sql = "select count(*) as count from _carts where cart_id='$cart' and status=''";
		$results = $conn->query($sql);
		$rows = $results->fetch_assoc();
		if($result->num_rows>0){
			while ($row = $result->fetch_assoc()){
				if($row['prod_name'] == $product->name){
					die($rows['count']); 
				}
			}
		}
		
		#now add to cart
		$cart = $_REQUEST['cart'];
		$quantity = 1;
		$total = $quantity*$product->price;
		$sql = "insert into _carts (cart_id,prodid,date,total,quant,prod_name,price,status,colour,size)values('$cart', '$product->prodid', '$date', '$total', '$quantity', '$product->name', $product->price, '', '$product->colours', '$product->size')";
		$conn->query($sql);
		$sql = "select count(*) as count from _carts where cart_id='$cart' and status=''";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		echo $row['count'];
		
	}
	
	if(isset($_REQUEST['quant'])){
		$quant = $_REQUEST['quant'];
		$sn = $_REQUEST['serial'];
		$total = $quant * $_REQUEST['price'];
		$sql = "update _carts set quant=$quant, total=$total where sn=$sn";
		if($conn->query($sql)){
			echo $total;
		}else{
			echo $conn->error;
		}
	}
	
	if(isset($_REQUEST['sn'])){
		$sn = $_REQUEST['sn'];
		$sql = "delete from _carts where sn=$sn";
		if($conn->query($sql)){
		}
	}
	
	if(isset($_REQUEST['orderID'])){
		$orderID = $_REQUEST['orderID'];
		$cart = $_REQUEST['cart'];
		$sql = "update _carts set status='$orderID' where cart='$cart'";
		if($conn->query($sql)){
			echo $cart;
		}else{
			echo $conn->error;
		}
		
	}
	
	if(isset($_REQUEST['up'])){
	    $cart = $_REQUEST['cart'];
		$id = $_REQUEST['order'];
		$add = $_REQUEST['address'];
		$items = $_REQUEST['items'];
		$dol = date("Y-m-d");
	    $sql = "update _carts set status='paid' where cart_id = $cart";
		$sql2 = "insert into _shipments (orderid, address, date, items, status, ship_date) values ('$id', '$add', '$dol', '$items', '', '')";
	    if($conn->query($sql) and $conn->query($sql2)){
			
		}else{
			echo $conn->error;
		}
	}
	
	if(isset($_REQUEST['lat'])){
		$id = $_REQUEST['lat'];
		$sql = "select * from _track where orderid='$id' limit 1";
		$result = $conn->query($sql);
		if($result->num_rows != 0){
				$obj = array();
			while($rows = $result->fetch_assoc()){
				$obj[] = $rows['lat'];
				$obj[] = $rows['lng'];
			}
			echo json_encode($obj);
		}
	}
	
	if(isset($_REQUEST['add'])){
		$add = $_REQUEST['add'];
		$ses = $_REQUEST['ses'];
		$dol = date("Y-m-d");
		$items = $_REQUEST['items'];
		$sql = "update _carts set status='pending' where cart_id = $ses";
		$sql2 = "insert into _shipments (orderid, address, date, items, status, ship_date) values ('$ses', '$add', '$dol', '$items', '', '')";
	    if(!($conn->query($sql) and $conn->query($sql2))){
			echo $conn->error;
		}
	}
?>














