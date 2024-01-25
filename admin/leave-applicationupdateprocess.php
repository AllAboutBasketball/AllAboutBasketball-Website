<?php
session_start();
$uid=$_SESSION['login_id'];
include 'dbconnection.php';
$id=strtoupper(mysqli_real_escape_string($mysqli,$_POST['id']));
$status=strtoupper(mysqli_real_escape_string($mysqli,$_POST['status']));
$mysqli->query("update app_leave set status='$status' where id='$id'")or die("Error description: ". $mysqli -> error);
?>