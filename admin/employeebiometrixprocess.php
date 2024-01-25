<?php
date_default_timezone_set('Asia/Manila');
session_start();
require 'auth.php';
include 'dbconnection.php';
$uid=$_SESSION['login_id'];
$mysqli -> autocommit(FALSE);
$empid=strtoupper(mysqli_real_escape_string($mysqli,$_POST['empid']));
$place=strtoupper(mysqli_real_escape_string($mysqli,$_POST['place']));
$status=strtoupper(mysqli_real_escape_string($mysqli,$_POST['status']));
$date = DATE('Y-m-d');
$time = DATE('H:i:s');
$result = $mysqli->query("select * from employee where id = '$empid'");
$row = mysqli_fetch_assoc($result);
$name = $row['name'];

$resultcheck = $mysqli->query("select * from attendance where emp_id = '$empid' and date = '$date' and status = '$status'");
if(mysqli_num_rows($resultcheck) > 0){
    die("Error description: You are already " .$status.'. Please check your biometrix');
}

$mysqli->query("INSERT INTO attendance (emp_id, name, date, time, place, status) values ('$empid','$name','$date','$time','$place','$status')")or die("Error description: " . $mysqli -> error);
echo $status;
mysqli_commit($mysqli);	
?>
