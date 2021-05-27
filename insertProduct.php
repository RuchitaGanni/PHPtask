<?php

// include database connection file
require_once'products.php';
// Object creation
$insertdata=new DB_con();
session_start();
if(isset($_POST['insertProduct'])){
	$_SESSION["error"]='';
	$_SESSION["pass"]='';
	$status = $statusMsg = ''; 

	$status = 'error'; 
	// if(!empty($_FILES["aimage"]["name"])) { 
	// $fileName = basename($_FILES["aimage"]["name"]); 
	// $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
	// $allowTypes = array('jpg','png','jpeg','gif'); 
	// if(in_array($fileType, $allowTypes)){ 
	// $image = $_FILES['aimage']['tmp_name'];

	// $imgContent = addslashes(file_get_contents($image)); 
	$name =$_POST['aname'];
	$sku =$_POST['asku'];
	$price =$_POST['aprice'];
	$desc =$_POST['adesc'];
	if(!empty($_FILES["aimage"]["name"])) { 
	$fileName = basename($_FILES["aimage"]["name"]);
		$fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
		$allowTypes = array('jpg','png','jpeg','gif'); 
		if(in_array($fileType, $allowTypes)){ 
		$image = $_FILES['aimage']['tmp_name'];
		$imgContent = addslashes(file_get_contents($image)); 
		$sql=$insertdata->insertProduct($name,$sku,$imgContent,$price,$desc);
	}

	}
	else{
		$_SESSION["error"] ="Please select image to upload";
		header("Location: http://localhost/productsView.php");
		exit();
	}
	if($sql)
	{
		$_SESSION["pass"]= 'success'; 
		$statusMsg = "File uploaded successfully."; 
	}
	else{ 

		$_SESSION["error"] = "File upload failed, please try again. Reason - ".mysqli_error($insertdata); 
	}  
}
header("Location: http://localhost/productsView.php");
exit();
?>