<?php
session_start();
require 'auth.php';
include 'dbconnection.php';
$uid=$_SESSION['login_id'];
$mysqli -> autocommit(FALSE);
$image = $_FILES['image']['name'];
$cname=strtoupper(mysqli_real_escape_string($mysqli,$_POST['cname']));
$cnum=strtoupper(mysqli_real_escape_string($mysqli,$_POST['cnum']));
$cperson=strtoupper(mysqli_real_escape_string($mysqli,$_POST['cperson']));
$cemail=strtoupper(mysqli_real_escape_string($mysqli,$_POST['cemail']));
$product=strtoupper(mysqli_real_escape_string($mysqli,$_POST['product']));
$cost=strtoupper(mysqli_real_escape_string($mysqli,$_POST['cost']));
$status=strtoupper(mysqli_real_escape_string($mysqli,$_POST['status']));
$supplydate=strtoupper(mysqli_real_escape_string($mysqli,$_POST['supplydate']));
$path = "uploads";
$image_ext = pathinfo($image, PATHINFO_EXTENSION);
$filename = time() . '.' . $image_ext;


$result = $mysqli->query("select * from supplier where cname='$cname'");
if(mysqli_num_rows($result)>0){
    die("Error description: Supplier name already used.");
}

$mysqli->query("INSERT INTO `supplier` (`id`, `cname`, `phone`, `cperson`, `email`, `product`, `cost`, `description`, `image`, `date_time`, `status`, `created_at`) VALUES (NULL, '$cname', '$cnum', '$cperson', '$cemail', '$product', '$cost', '', '$filename', '$supplydate', '$status', CURRENT_TIMESTAMP);")or die("Error description: " . $mysqli -> error);

move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);

mysqli_commit($mysqli);	
?>
