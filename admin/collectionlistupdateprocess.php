<?php
date_default_timezone_set('Asia/Manila');
session_start();
require 'auth.php';
include 'dbconnection.php';
$uid=$_SESSION['login_id'];
$mysqli -> autocommit(FALSE);
$id=strtoupper(mysqli_real_escape_string($mysqli,$_POST['eid']));
$psales=strtoupper(mysqli_real_escape_string($mysqli,$_POST['psales']));
$collection=strtoupper(mysqli_real_escape_string($mysqli,$_POST['collection']));
$description=strtoupper(mysqli_real_escape_string($mysqli,$_POST['description']));
$tagging=strtoupper(mysqli_real_escape_string($mysqli,$_POST['tagging']));
$status=strtoupper(mysqli_real_escape_string($mysqli,$_POST['status']));

if($_FILES['image']['name']){
    $image = $_FILES['image']['name'];
    $path = "uploads";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;
    $mysqli->query("UPDATE categories set name = '$collection', slug = '$psales', description = '$description', status = '$status', popular = '1', image = '$filename', meta_keywords = '$tagging' where id = '$id'")or die("Error description: " . $mysqli -> error);
    move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
}else{
    $mysqli->query("UPDATE categories set name = '$collection', slug = '$psales', description = '$description', status = '$status', popular = '1', meta_keywords = '$tagging' where id = '$id'")or die("Error description: " . $mysqli -> error);
}

mysqli_commit($mysqli);	
?>
