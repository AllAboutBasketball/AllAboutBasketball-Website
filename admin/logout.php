<?php
function getUserIP() {
    if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
            $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($addr[0]);
        } else {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
session_start();
include 'dbconnection.php';

					$name=$_SESSION['login_username'];
					$ip=getUserIP();
					$action='Logout';
					$details='Logout';
					$status='Successful';
					$mysqli->query("insert into tbl_logs(name,action,details,status,ip_address) value ('$name','$action','$details','$status','$ip')");
					
session_destroy();
header('location:../index.php');
?>