<?php
date_default_timezone_set('Asia/Manila');
session_start();
require 'auth.php';
include 'dbconnection.php';
$uid=$_SESSION['login_id'];
$mysqli -> autocommit(FALSE);
$image = $_FILES['image']['name'];
$empid=strtoupper(mysqli_real_escape_string($mysqli,$_POST['empid']));
$ltype=strtoupper(mysqli_real_escape_string($mysqli,$_POST['ltype']));
$ldates=strtoupper(mysqli_real_escape_string($mysqli,$_POST['ldates']));
$reason=strtoupper(mysqli_real_escape_string($mysqli,$_POST['reason']));

$path = "uploads";
$image_ext = pathinfo($image, PATHINFO_EXTENSION);
$filename = time() . '.' . $image_ext;

list($start, $end) = explode(' - ', $ldates);
$startDate = new DateTime($start);
$endDate = new DateTime($end);
$sdate = $startDate->format("Y-m-d");
$edate = $endDate->format("Y-m-d");

$interval = $startDate->diff($endDate);
$nodays = $interval->days;
$days = $nodays + 1;

$result = $mysqli->query("select * from employee where id = '$empid'");
$row = mysqli_fetch_assoc($result);
$name = $row['name'];

$mysqli->query("INSERT INTO app_leave (emp_id, emp_name, days, start_date, end_date, leave_type, image, remarks, status) values ('$empid','$name','$days','$sdate','$edate','$ltype','$filename', '$reason', 'PENDING')")or die("Error description: " . $mysqli -> error);

move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
mysqli_commit($mysqli);	
?>
