<?php 

require_once'products.php';
// Object creation
$deletedata=new DB_con();
session_start();//Deletion
if(isset($_POST['ids']))
{
	$pid=$_POST['ids'];

	$sql=$deletedata->delete($pid);
	if($sql)
	{
		$_SESSION["pass"]= 'Product deleted.'; 
	}else
	{
		$_SESSION["error"]= 'Filed to delete product.Reason - '.mysqli_error($deletedata);
	} 

}
return true;
	?>