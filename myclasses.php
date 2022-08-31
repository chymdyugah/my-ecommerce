<?php
 
 class Product {
	function __construct($prodid){
		$this->prodid = $prodid;
		$this->size = "False";
		$this->colours = "Null";
	}
	# making public accessible properties
	public $name;
	public $price;
	public $image;
	public $quantity;
	public $description;
	public $tags;
	
	# public accessible methods
	function dbInsert($c, $image){
		$this->image = $image;
		$sql = "insert into _products (prodid,name,price,image,description,categories,size,colour) values ('$this->prodid', '$this->name', $this->price, '$image', '$this->description', '$this->tags', '$this->size', '$this->colours')";
		if($c->query($sql)){
			return "New Product";
		}else{
			return $c->error;
		}
	}
	
	function getDetails($c){
		$sql = "select * from _products where prodid='$this->prodid'";
		if($result=$c->query($sql)){
			$row = $result->fetch_assoc();
			$this->name = $row['name'];
			$this->price = $row['price'];
			$this->image = $row['image'];
			$this->description = $row['description'];
			$this->tags = $row['categories'];
			$this->size = $row['size'];
			$this->colours = $row['colour'];
			return true;
		}else{
			return $c->error;
		}
	}
	
 }
 
 class User {
	function __construct($email){	
		$this->email = $email;
	}
	public $name;
	public $image;
	public $position;
	# public accessible methods
	function getUserDetails($c){
		$e = $this->email;
		$sql = "select * from _users where email= '$e'";
		$result = $c->query($sql);
		$rows = $result->fetch_assoc();
		$this->name = $rows['name'];
		$this->image = $rows['image'];
		$this->position = $rows['position'];
	}
 }

?>