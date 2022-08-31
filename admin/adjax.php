<?php
	include "../conn.php";
	include "../myclasses.php";
	
	//inventcharts.php
	if(isset($_REQUEST['kin'])){
		$sql2 = "select prodid, name from _products";
		$result = $conn->query($sql2);
		$obj = array();
		$pad = array();
		$sing = array();
		while($row = $result->fetch_assoc()){
			$obj[] = $row['prodid'];
			$sing[] = $row['name'];
		}
		$pad[] = $sing; // pad is an array contains has sing. sing is an array too.
		foreach($obj as $r){
			$sql = "SELECT prod_name, quant from _carts where prodid='$r'";
			$res = $conn->query($sql);
			foreach($res as $q){
				$pad[] = $q; // each q added to pad is an object in javascript.
			}
			
		}
		
		$row = json_encode($pad);
		echo $row;
	}
	
	if(isset($_REQUEST['kit'])){
		$sql = "SELECT prod_name, SUM(quant) AS sumofsales from _carts where status='paid' GROUP BY prod_name";
		$result = $conn->query($sql);
		$obj = array();
		foreach($result as $row){
			$obj[] = $row;
		}
		$row = json_encode($obj);
		echo $row;
	}
	
	//index.php
	if(isset($_REQUEST['kid'])){
		$sql = "SELECT name, SUM(quantity) AS quant from _products GROUP BY name";
		$result = $conn->query($sql); // result is a collection rows
		$obj = array();
		foreach($result as $row){
			$obj[] = $row; // each row is stored as a different array in the array
		}
		$row = json_encode($obj);
		echo $row;
	}
	
	if(isset($_REQUEST['kun'])){
		$sql = "SELECT prod_name, sum(quant) as s from _carts where status='paid' GROUP BY prod_name";
		$result = $conn->query($sql); // result is a collection rows
		$obj = array();
		foreach($result as $row){
			$obj[] = $row; // each row is stored as a different array in the array
		}
		$row = json_encode($obj);
		echo $row;
	}
	
	if(isset($_REQUEST['dat1'])){
		$dat1 = $_REQUEST['dat1'];
		$dat2 = $_REQUEST['dat2'];
		$sql = "SELECT prod_name, sum(quant) as s from _carts where status='paid' and date between '$dat1' and '$dat2' GROUP BY prod_name";
		$result = $conn->query($sql); // result is a collection rows
		$obj = array();
		foreach($result as $row){
			$obj[] = $row; // each row is stored as a different array in the array
		}
		$row = json_encode($obj);
		echo $row;
	}
	
	if(isset($_REQUEST['lat'])){
		$lat = $_REQUEST['lat'];
		$lng = $_REQUEST['lng'];
		$ses = $_REQUEST['ses'];
		$dat = date("H:i:s");
		$sql = "update _track set lng=$lng, lat=$lat, time='$dat' where handler='$ses' ";
		if(!$conn->query($sql)){
			echo "Error:".$conn->error;
		}
	}
	
	//redr.php
	if(isset($_GET['q'])){
		$q = $_GET['q'];
		$w = date("Y-m-d");
		$sql = "update _shipments set status='shipped', ship_date='$w' where orderid='$q'";
		if(!$conn->query($sql)){
			echo $conn->error;
		}else{
			echo "<script>location.assign('refill.php')</script>";
		}
	}
	
?>