<?php
include("admin/dbconnection.php");
session_start();
if(isset($_POST['p'])){
	$username=mysqli_real_escape_string($mysqli,$_POST['u']);
	$password=mysqli_real_escape_string($mysqli,$_POST['p']);
	$password=md5($password);
	$result=$mysqli->query("select * from employee where emp_id='$username' and password='$password'")or die("Error: ". $mysqli -> error);
	$row=mysqli_fetch_assoc($result);
		if(mysqli_num_rows($result)>0){
			$id=$row['id'];
			$_SESSION['login_id']=$row['id'];
			$_SESSION['login_username']=$row['emp_id'];
			$_SESSION['user_name']=$row['name'];
			$_SESSION['login_userlevel']=$row['userlevel'];
		}else{
			die('Error: Incorrect username / password.');
		}
	}
?>