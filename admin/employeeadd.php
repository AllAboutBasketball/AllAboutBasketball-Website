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
$image = $_FILES['image']['name'];
$empid=strtoupper(mysqli_real_escape_string($mysqli,$_POST['empid']));
$dhired=strtoupper(mysqli_real_escape_string($mysqli,$_POST['dhired']));
$userlvl=strtoupper(mysqli_real_escape_string($mysqli,$_POST['userlvl']));
$password=mysqli_real_escape_string($mysqli,$_POST['password']);
$position=strtoupper(mysqli_real_escape_string($mysqli,$_POST['position']));
$fname=strtoupper(mysqli_real_escape_string($mysqli,$_POST['fname']));
$address=strtoupper(mysqli_real_escape_string($mysqli,$_POST['address']));
$salary=strtoupper(mysqli_real_escape_string($mysqli,$_POST['salary']));
$cnum=strtoupper(mysqli_real_escape_string($mysqli,$_POST['cnum']));
$sex=strtoupper(mysqli_real_escape_string($mysqli,$_POST['sex']));
$email=strtoupper(mysqli_real_escape_string($mysqli,$_POST['email']));
$bday=strtoupper(mysqli_real_escape_string($mysqli,$_POST['bday']));
$password=md5($password);
$age = calculateAge($bday);
$path = "uploads";
$image_ext = pathinfo($image, PATHINFO_EXTENSION);
$filename = time() . '.' . $image_ext;


$result = $mysqli->query("select * from employee where emp_id='$empid'");
if(mysqli_num_rows($result)>0){
    die("Error description: Employee ID already used.");
}

$mysqli->query("INSERT INTO `employee` (`id`, `emp_id`, `password`, `userlevel`, `name`, `age`, `date_birth`, `date_hiring`, `gender`, `contact`, `salary`, `email`, `position`, `image`, `address`, `created_at`) VALUES (NULL, '$empid', '$password', '$userlvl', '$fname', '$age', '$bday', '$dhired', '$sex', '$cnum', '$salary', '$email', '$position', '$filename', '$address', CURRENT_TIMESTAMP);")or die("Error description: " . $mysqli -> error);

move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);

mysqli_commit($mysqli);	
?>
