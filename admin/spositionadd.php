<?php
session_start();
require 'auth.php';
include 'dbconnection.php';
$uid=$_SESSION['login_id'];
$position=strtoupper(mysqli_real_escape_string($mysqli,$_POST['position']));

$mysqli->query("INSERT INTO `tbl_position` (`position`) VALUES ( '$position')")or die("Error description: " . $mysqli -> error);
?>
