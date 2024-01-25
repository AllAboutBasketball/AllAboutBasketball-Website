<?php
date_default_timezone_set('Asia/Manila');
session_start();
require 'auth.php';
include 'dbconnection.php';
$uid=$_SESSION['login_id'];
$mysqli -> autocommit(FALSE);
$image = $_FILES['image']['name'];
$psales=strtoupper(mysqli_real_escape_string($mysqli,$_POST['psales']));
$collection=strtoupper(mysqli_real_escape_string($mysqli,$_POST['collection']));
$description=strtoupper(mysqli_real_escape_string($mysqli,$_POST['description']));
$tagging=strtoupper(mysqli_real_escape_string($mysqli,$_POST['tagging']));
$status=strtoupper(mysqli_real_escape_string($mysqli,$_POST['status']));

$path = "uploads";
$image_ext = pathinfo($image, PATHINFO_EXTENSION);
$filename = time() . '.' . $image_ext;

$resultcheck = $mysqli->query("select * from categories where name = '$collection' and slug = '$psales'");
if(mysqli_num_rows($resultcheck) > 0){
    die("Error description: This collection is already exist");
}

$mysqli->query("INSERT INTO categories (name, slug, description, status, popular, image, meta_keywords) values ('$collection','$psales', '$description','$status','1','$filename','$tagging')")or die("Error description: " . $mysqli -> error);
move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);

mysqli_commit($mysqli);	
?>
