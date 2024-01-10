<?php
session_start();
include('../config/dbcon.php');

function getAllInfo($table)
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM $table WHERE id='$userId'";
    return $query_run = mysqli_query($con, $query);
    exit();

}

function getAllInfos($table)
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM $table WHERE role_as != '1'";
    return $query_run = mysqli_query($con, $query);
    exit();

}

function getAll($table)
{
    global $con;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($con, $query);
    exit();

}

function getByID($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id = '$id'";
    return $query_run = mysqli_query($con, $query);
    exit();
}

function getAllActive($table)
{
    global $con;
    $query = "SELECT * FROM $table WHERE status = '0'";
    return $query_run = mysqli_query($con, $query);
    exit();

}

function getAllOrders()
{
    global $con;
    $query = "SELECT * FROM orders WHERE status IN(0, 1, 2, 3, 4, 5, 6, 7) ORDER BY id ASC ";
    return $query_run = mysqli_query($con, $query);
}

function getAllCollab()
{
    global $con;
    $query = "SELECT * FROM upload WHERE status='0' ORDER BY id ASC ";
    return $query_run = mysqli_query($con, $query);
    
}

function checkTrackingNoValid($trackingNo)
{
    global $con;
    $query = "SELECT * FROM orders WHERE tracking_no='$trackingNo'";
    return mysqli_query($con, $query);

}

function getOrdersHistory()
{
    global $con;
    $query = "SELECT * FROM orders WHERE status = '8' AND status = -1 ORDER BY id DESC";
    return $query_run = mysqli_query($con, $query);
}

function getConfirmedOrders()
{
    global $con;
    $query = "SELECT * FROM orders WHERE status='1' ORDER BY id DESC";
    return $query_run = mysqli_query($con, $query);
}

function getOnDeliverOrders()
{
    global $con;
    $query = "SELECT * FROM orders WHERE status='2' ORDER BY id DESC";
    return $query_run = mysqli_query($con, $query);
}
// function generateEmployeeID() {
//     // Generate a unique ID here based on your requirements
//     // Example implementation:
//     $prefix = "EMP"; // You can customize the prefix
//     $random_number = mt_rand(100000, 999999); // Generate a random number
//     $employee_id = $prefix . $random_number; // Concatenate prefix and random number
//     return $employee_id;
// }

function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();
}

?>