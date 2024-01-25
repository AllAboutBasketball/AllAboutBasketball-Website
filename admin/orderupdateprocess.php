<?php
date_default_timezone_set('Asia/Manila');
session_start();
require 'auth.php';
include 'dbconnection.php';
$uid=$_SESSION['login_id'];
$mysqli -> autocommit(FALSE);
$id=strtoupper(mysqli_real_escape_string($mysqli,$_POST['eid']));
$status=strtoupper(mysqli_real_escape_string($mysqli,$_POST['status']));

$mysqli->query("UPDATE orders set status = '$status' where id = '$id'")or die("Error description: " . $mysqli -> error);

mysqli_commit($mysqli);	
?>
