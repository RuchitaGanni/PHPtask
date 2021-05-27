<?php 

require_once'products.php';
// Object creation
$updatedata=new DB_con();
session_start();


        $pid=$_POST['ppid'];
        $name=$_POST['pname'];
        $fileName = basename($_FILES["pimage"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(!in_array($fileType, $allowTypes)){ 

        }
        else{
        $image = $_FILES['pimage']['tmp_name'];

        $imgContent = addslashes(file_get_contents($image));
        $price=$_POST['pprice'];
        $description=$_POST['pdesc'];
        $sku=$_POST['psku'];
        $sql=$updatedata->update($pid,$name,$sku,$imgContent,$price,$description);


        if ($sql) {
            $_SESSION["pass"]= 'Product Data updated.'; 
        } 
        else {
            $_SESSION["error"] = "File upload failed, please try again. Reason - ".mysqli_error($updatedata); 
            
        }
        //mysqli_close($db);
    }
        
header("Location: http://localhost/productsView.php");
exit();

?>