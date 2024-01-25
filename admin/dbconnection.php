<?php
$mysqli=new mysqli("localhost","root","","u992665783_aab");
if($mysqli->connect_errno){
	echo "Failed to connect:(" .$mysqli->connect_errno. ")".$mysqli->connect_error;
}

$connect = new PDO('mysql:host=localhost;dbname=u992665783_aab', 'root', '');


$conn = mysqli_connect("localhost","root","","u992665783_aab") ;
if (!$conn)
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$host = 'localhost';
$username ='root';
$password = '';
$database = 'u992665783_aab';  

$con = mysqli_connect($host, $username, $password, $database);

if(!$con)
{
	die("Connection Failed: " .mysqli_connect_error());
}
else
{
   // echo "Connected Successfully";
}

?>
