<?php

// include database connection file
require_once'products.php';
// Object creation
$viewData=new DB_con();
session_start();
$data=[];
$sql=$viewData->fetchonerecord($_POST['ids']);

if ($sql->num_rows > 0) {
  while($row = $sql->fetch_assoc()) {
   $data=array(
        "name" => $row['name'],
        "image" => base64_encode($row['images']),
        "price"=>$row['price'],
        "description" => $row['description'],
        "sku" => $row['sku']
    );
  }
} 
echo json_encode(array('data'=>$data));
?>