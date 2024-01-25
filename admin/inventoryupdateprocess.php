<?php
session_start();
require 'auth.php';
include 'dbconnection.php';
$uid=$_SESSION['login_id'];
$mysqli -> autocommit(FALSE);
$image = $_FILES['image']['name'];
$id=strtoupper(mysqli_real_escape_string($mysqli,$_POST['eid']));
$supplier=strtoupper(mysqli_real_escape_string($mysqli,$_POST['supplier']));
$name=strtoupper(mysqli_real_escape_string($mysqli,$_POST['name']));
$pdate=strtoupper(mysqli_real_escape_string($mysqli,$_POST['pdate']));
$category=strtoupper(mysqli_real_escape_string($mysqli,$_POST['category']));
$size=strtoupper(mysqli_real_escape_string($mysqli,$_POST['size']));
$quantity=strtoupper(mysqli_real_escape_string($mysqli,$_POST['quantity']));
$price=strtoupper(mysqli_real_escape_string($mysqli,$_POST['price']));
$category=strtoupper(mysqli_real_escape_string($mysqli,$_POST['category']));
$remarks=strtoupper(mysqli_real_escape_string($mysqli,$_POST['remarks']));
$status=strtoupper(mysqli_real_escape_string($mysqli,$_POST['status']));
$path = "uploads";
$image_ext = pathinfo($image, PATHINFO_EXTENSION);
$filename = time() . '.' . $image_ext;

if($_FILES['image']['name']){
    $image = $_FILES['image']['name'];
    $path = "uploads";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;
    $mysqli->query("UPDATE inventory set supplier_id = '$supplier', name = '$name', date_time = '$pdate', qty = '$quantity', price = '$price', size = '$size', type = '$category', status='$status', remarks = '$remarks', image = '$filename' where id = '$id'")or die("Error description: " . $mysqli -> error);
    move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
}else{
    $mysqli->query("UPDATE inventory set supplier_id = '$supplier', name = '$name', date_time = '$pdate', qty = '$quantity', price = '$price', size = '$size', type = '$category', status='$status', remarks = '$remarks' where id = '$id'")or die("Error description: " . $mysqli -> error);
}

mysqli_commit($mysqli);	
?>
