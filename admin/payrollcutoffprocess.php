<?php
session_start();
$uid=$_SESSION['login_id'];
include 'dbconnection.php';
$sdate=strtoupper(mysqli_real_escape_string($mysqli,$_POST['sdate']));
$edate=strtoupper(mysqli_real_escape_string($mysqli,$_POST['edate']));
$date = Date('Y-m-d');
$mysqli->query("INSERT INTO tbl_payroll_cutoff (start_date, end_date, statid, createdby, createdt) values ('$sdate','$edate','1','$uid','$date')")or die("Error description: ". $mysqli -> error);
?>