<?php
	// fileupload function
    function upload($inputname,$path){
        $target_dir = $path;
        $target_file = $target_dir . basename($_FILES["$inputname"]["name"]);
        $uploadOk = 1;
		$error = "";
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		
		// Check if image file is a actual image or fake image
		/* $check = getimagesize($_FILES["$inputname"]["tmp_name"]);
		if($check !== false) {
			$uploadOk = 1;
		} else {
			$error .=  "File is not an image;";
			$uploadOk = 0;
		} */
		
		// Check file size
		if ($_FILES["$inputname"]["size"] > 2000000) {
			$error .= "Your file is too large. Max=2mb;";
			$uploadOk = 0;
		}
  
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<script>alert('Sorry, your file was not uploaded due to $error')</script>";
			die();
        // if everything is ok, try to upload file
        } else {
            if (!move_uploaded_file($_FILES["$inputname"]["tmp_name"], $target_file)) {
				echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
                die();
            }
        }
        return basename($_FILES["$inputname"]["name"]);
    }
	
	// input validation funtion
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>