<?php

// $linkdb=mysqli_connect("localhost","root","","ruchita");
// if($linkdb === false){
//     die("ERROR: Could not connect. " . mysql_connect_error());
// }

class DB_con
{
function __construct()
{
	$linkdb=mysqli_connect("localhost","root","","ruchita");
	$this->db=$linkdb;
	// Check connection
	if($linkdb === false)
	{
    die("ERROR: Could not connect. " . mysql_connect_error());
	}
	
}

//insert 

public function insertProduct($name,$sku,$imgContent,$price,$desc)
	{
	$ret=mysqli_query($this->db,"INSERT into products (name, sku,images,quantity,price,description,status) VALUES('$name','$sku','$imgContent','20','$price','$desc','1')");
	return $ret;
	}
public function insertProductImages($pid,$imgContent)
	{

	$ret=mysqli_query($this->db,"INSERT into images (product_id,imageblob) VALUES('$pid','imgContent')");
	return $ret->insert_id;
	}
public function fetchdata(){
	$result=mysqli_query($this->db,"select * from products where status=1");
	return $result;
	}
public function fetchonerecord($pid){
	$oneresult=mysqli_query($this->db,"select * from products where pid=".$pid);
	return $oneresult;
}
public function update($pid,$name,$sku,$imgContent,$price,$description)
	{
		echo $description;
	$updaterecord=mysqli_query($this->db,"UPDATE `products` SET `name`='$name',`sku`='$sku',`description`='$description',`images`='$imgContent',`price`='$price' WHERE pid=$pid ");
	return $updaterecord;
	}
public function delete($pid)
	{
	$deleterecord=mysqli_query($this->db,"UPDATE `products` SET `status`=0  where pid=".$pid);
	return $deleterecord;
	}

// echo json_encode( array("status" => 1,"data" => $data) );

// $linkdb->close();
}

?>