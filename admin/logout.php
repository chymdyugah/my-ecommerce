<?php
	session_start();
	session_unset();
	
	echo "<script>location.replace('login.php')</script>";
?>