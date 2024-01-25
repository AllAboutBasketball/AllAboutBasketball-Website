<?php
date_default_timezone_set('Asia/Manila');
session_start();
require 'auth.php';
include 'dbconnection.php';
$uid=$_SESSION['login_id'];
$mysqli -> autocommit(FALSE);
function RandomString($length) {
    $keys = array_merge(range(0,9));
    $key = "";
    for($i=0; $i < $length; $i++) {
        $key .= $keys[mt_rand(0, count($keys) - 1)];
    }
    return $key;
}

$image = $_FILES['image']['name'];
$collection=strtoupper(mysqli_real_escape_string($mysqli,$_POST['collection']));
$inventory=strtoupper(mysqli_real_escape_string($mysqli,$_POST['inventory']));
$oprice=strtoupper(mysqli_real_escape_string($mysqli,$_POST['oprice']));
$sprice=strtoupper(mysqli_real_escape_string($mysqli,$_POST['sprice']));
$description=strtoupper(mysqli_real_escape_string($mysqli,$_POST['description']));
$tagging=strtoupper(mysqli_real_escape_string($mysqli,$_POST['tagging']));
$status=strtoupper(mysqli_real_escape_string($mysqli,$_POST['status']));
$transcode = RandomString(12);

$result = $mysqli->query("select * from inventory where id='$inventory'");
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$size = $row['size'];
$quantity = $row['qty'];

$path = "uploads";
$image_ext = pathinfo($image, PATHINFO_EXTENSION);
$filename = time() . '.' . $image_ext;

$mysqli->query("INSERT INTO products (category_id, name, slug, size, qty, original_price, selling_price, description, image, status, trending, meta_keywords) values ('$collection','$name', '$transcode','$size','$quantity','$oprice','$sprice','$description','$filename','$status','1','$tagging')")or die("Error description: " . $mysqli -> error);
move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);

mysqli_commit($mysqli);	
?>
