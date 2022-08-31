<?php
	$host = "localhost";
	$username = "chymdy";
	$password = "chymdy";
	$database = "ecom";
	
	$conn = new mysqli($host,$username,$password,$database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
?>