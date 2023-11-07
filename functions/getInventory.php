<?php
session_start();
include('../config/dbcon.php');
$inventory_id=$_POST['id'];
global $con;
$query = "SELECT * FROM inventory WHERE id='$inventory_id'";
return $query_run = mysqli_query($con, $query);

?>