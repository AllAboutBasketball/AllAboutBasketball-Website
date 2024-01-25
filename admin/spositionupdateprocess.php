<?php
session_start();
$uid=$_SESSION['login_id'];
include 'dbconnection.php';
$id=strtoupper(mysqli_real_escape_string($mysqli,$_POST['id']));
$position=strtoupper(mysqli_real_escape_string($mysqli,$_POST['position']));
$tdate=date('Y-m-d');
$mysqli->query("update tbl_position set position='$position' where id='$id'")or die("Error description: ". $mysqli -> error);
?>