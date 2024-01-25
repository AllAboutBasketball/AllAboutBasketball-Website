<?php
session_start();
require 'auth.php';
include 'dbconnection.php';
$uid=$_SESSION['login_id'];
$mysqli -> autocommit(FALSE);
function calculateAge($birthdate) {
    $today = new DateTime();
    $birthDate = new DateTime($birthdate);
    $age = $today->diff($birthDate)->y;
    return $age;
}
$eid=strtoupper(mysqli_real_escape_string($mysqli,$_POST['eid']));
$empid=strtoupper(mysqli_real_escape_string($mysqli,$_POST['empid']));
$dhired=strtoupper(mysqli_real_escape_string($mysqli,$_POST['dhired']));
$userlvl=strtoupper(mysqli_real_escape_string($mysqli,$_POST['userlvl']));
$pword=mysqli_real_escape_string($mysqli,$_POST['pword']);
$position=strtoupper(mysqli_real_escape_string($mysqli,$_POST['position']));
$fname=strtoupper(mysqli_real_escape_string($mysqli,$_POST['fname']));
$address=strtoupper(mysqli_real_escape_string($mysqli,$_POST['address']));
$salary=strtoupper(mysqli_real_escape_string($mysqli,$_POST['salary']));
$cnum=strtoupper(mysqli_real_escape_string($mysqli,$_POST['cnum']));
$sex=strtoupper(mysqli_real_escape_string($mysqli,$_POST['sex']));
$email=strtoupper(mysqli_real_escape_string($mysqli,$_POST['email']));
$bday=strtoupper(mysqli_real_escape_string($mysqli,$_POST['bday']));
$age = calculateAge($bday);

$result = $mysqli->query("select * from employee where id='$eid'");
$row = mysqli_fetch_assoc($result);
if($row['password'] == ''){
	$pword=md5(mysqli_real_escape_string($mysqli,$_POST['pword']));
	$mysqli->query("UPDATE employee set emp_id='$empid',password='$pword', date_hiring='$dhired', userlevel='$userlvl', name='$fname', age='$age', date_birth='$bday', gender='$sex', contact='$cnum', salary='$salary', email='$email', position='$position', address='$address'  where id='$eid'")or die("Error description: " . $mysqli -> error);
}else{
	if($row['password']==$pword){
		$pword=mysqli_real_escape_string($mysqli,$_POST['pword']);
        $mysqli->query("UPDATE employee set emp_id='$empid',password='$pword', date_hiring='$dhired', userlevel='$userlvl', name='$fname', age='$age', date_birth='$bday', gender='$sex', contact='$cnum', salary='$salary', email='$email', position='$position', address='$address'  where id='$eid'")or die("Error description: " . $mysqli -> error);
	}else{
		$pword=md5(mysqli_real_escape_string($mysqli,$_POST['pword']));
        $mysqli->query("UPDATE employee set emp_id='$empid',password='$pword', date_hiring='$dhired', userlevel='$userlvl', name='$fname', age='$age', date_birth='$bday', gender='$sex', contact='$cnum', salary='$salary', email='$email', position='$position', address='$address'  where id='$eid'")or die("Error description: " . $mysqli -> error);
	}
}

mysqli_commit($mysqli);	
?>
