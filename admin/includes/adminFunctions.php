<?php
include('./../config/dbcon.php');

function getNewOrdersCount(){
    global $con;
    $query = "SELECT COUNT(*) AS new_orders_count FROM orders WHERE status = '0'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $newOrdersCount = $row['new_orders_count'];
        mysqli_free_result($result);
        return $newOrdersCount;
    } else {
        return -1; 
    }
}

function getCompletedOrdersCount(){
    global $con;
    $query = "SELECT COUNT(*) AS new_completed_count FROM orders WHERE status = '2'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $newOrdersCount = $row['new_completed_count'];
        mysqli_free_result($result);
        return $newOrdersCount;
    } else {
        return -1; 
    }
}

function getUserCount(){
    global $con;
    $query = "SELECT COUNT(*) AS user_count FROM users WHERE role_as = '0'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $newOrdersCount = $row['user_count'];
        mysqli_free_result($result);
        return $newOrdersCount;
    } else {
        return -1; 
    }
}

function getEmployeeCount(){
    global $con;
    $query = "SELECT COUNT(*) AS employee_count FROM users WHERE role_as = '1'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $newOrdersCount = $row['employee_count'];
        mysqli_free_result($result);
        return $newOrdersCount;
    } else {
        return -1; 
    }
}

function getSupplierCount(){
    global $con;
    $query = "SELECT COUNT(*) AS supplier_count FROM supplier";
    $result = mysqli_query($con, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $newOrdersCount = $row['supplier_count'];
        mysqli_free_result($result);
        return $newOrdersCount;
    } else {
        return -1; 
    }
}


function getProductsCount(){
    global $con;
    $query = "SELECT COUNT(*) AS products_count FROM products";
    $result = mysqli_query($con, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $newOrdersCount = $row['products_count'];
        mysqli_free_result($result);
        return $newOrdersCount;
    } else {
        return -1; 
    }
}

function getCollectionCount(){
    global $con;
    $query = "SELECT COUNT(*) AS category_count FROM categories";
    $result = mysqli_query($con, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $newOrdersCount = $row['category_count'];
        mysqli_free_result($result);
        return $newOrdersCount;
    } else {
        return -1; 
    }
}

function approveUploadData($uploadID){
    global $con;
    $query = "UPDATE upload SET status = '1' WHERE id = '$uploadID'";
    return mysqli_query($con, $query);
}

function rejectUploadData($uploadID){
    global $con;
    $query = "UPDATE upload SET status = '2' WHERE id = '$uploadID'";
    return mysqli_query($con, $query);
}

function getAllUploadData(){
    global $con;
    $query = "SELECT * FROM `upload`";
    return mysqli_query($con, $query);
}

function getCollabData($id){
    global $con;
    $query = "SELECT * FROM `upload` WHERE id = '$id'";
    return mysqli_query($con, $query);
}

function redirectAdmin($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();
}
