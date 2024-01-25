<?php
date_default_timezone_set('Asia/Manila');
session_start();
require 'auth.php';
include 'dbconnection.php';
$uid=$_SESSION['login_id'];
$mysqli -> autocommit(FALSE);
$id=strtoupper(mysqli_real_escape_string($mysqli,$_POST['eid']));
$cname=strtoupper(mysqli_real_escape_string($mysqli,$_POST['cname']));
$cnum=strtoupper(mysqli_real_escape_string($mysqli,$_POST['cnum']));
$cperson=strtoupper(mysqli_real_escape_string($mysqli,$_POST['cperson']));
$cemail=strtoupper(mysqli_real_escape_string($mysqli,$_POST['cemail']));
$product=strtoupper(mysqli_real_escape_string($mysqli,$_POST['product']));
$cost=strtoupper(mysqli_real_escape_string($mysqli,$_POST['cost']));
$status=strtoupper(mysqli_real_escape_string($mysqli,$_POST['status']));
$supplydate=strtoupper(mysqli_real_escape_string($mysqli,$_POST['supplydate']));

if($_FILES['image']['name']){
    $image = $_FILES['image']['name'];
    $path = "uploads";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;
    $mysqli->query("UPDATE supplier set cname = '$cname', phone = '$cnum', cperson = '$cperson', email = '$cemail', product = '$product', image = '$filename', cost = '$cost', date_time='$supplydate' where id = '$id'")or die("Error description: " . $mysqli -> error);
    move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
}else{
    $mysqli->query("UPDATE supplier set cname = '$cname', phone = '$cnum', cperson = '$cperson', email = '$cemail', product = '$product', cost = '$cost', date_time='$supplydate' where id = '$id'")or die("Error description: " . $mysqli -> error);
}

mysqli_commit($mysqli);	
?>
