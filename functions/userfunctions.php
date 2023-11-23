<?php

session_start();
include('./config/dbcon.php');

function getAllInfo($table)
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM $table WHERE id='$userId'";
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

function getAllTrending()
{
    global $con;
    $query = "SELECT * FROM products WHERE trending = '1'";
    return $query_run = mysqli_query($con, $query);
    exit();

}

function getSlugActive($table, $slug)
{
    global $con;
    $query = "SELECT * FROM $table WHERE slug = '$slug' AND status = '0' LIMIT 1";
    return $query_run = mysqli_query($con, $query);
    exit();
}

function getProdByCategory($category_id)
{
    global $con;
    $query = "SELECT * FROM products WHERE category_id = '$category_id' AND status = '0'";
    return $query_run = mysqli_query($con, $query);
    exit();
}

function getIDActive($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id = '$id' AND status = '0'";
    return $query_run = mysqli_query($con, $query);
    exit();
}

function getCartItems()
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.size, p.image, p.selling_price, p.qty 
                FROM carts c, products p WHERE c.prod_id=p.id AND c.user_id='$userId' ORDER BY c.id DESC "; 
    return $query_run = mysqli_query($con, $query);
    
}

function getOrders()
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    
    $query = "SELECT * FROM orders WHERE user_id='$userId' AND status='0' ORDER BY id DESC ";
    return $query_run = mysqli_query($con, $query);
}

function getConfirmedOrders()
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    
    $query = "SELECT * FROM orders WHERE user_id='$userId' AND status='1' ORDER BY id DESC ";
    return $query_run = mysqli_query($con, $query);
}

function getCompletedOrders()
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    
    $query = "SELECT * FROM orders WHERE user_id='$userId' AND status='2' ORDER BY id DESC ";
    return $query_run = mysqli_query($con, $query);
}

function getDeliveredOrders()
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    
    $query = "SELECT * FROM orders WHERE user_id='$userId' AND status='3' ORDER BY id DESC ";
    return $query_run = mysqli_query($con, $query);
}
function getCanceledOrders()
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    
    $query = "SELECT * FROM orders WHERE user_id='$userId' AND status='4' ORDER BY id DESC ";
    return $query_run = mysqli_query($con, $query);
}

function getCollab()
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    
    $query = "SELECT * FROM upload ORDER BY id DESC";
    return $query_run = mysqli_query($con, $query);
    
}

function checkTrackingNoValid($trackingNo)
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];

    $query = "SELECT * FROM orders WHERE tracking_no='$trackingNo' AND user_id='$userId' ";
    return mysqli_query($con, $query);

}

function getByID($table, $userId)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id = '$userId'";
    return $query_run = mysqli_query($con, $query);
    exit();
}

function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();
}

function getOrderDetails($orderId){
    global $con;
    $query = "SELECT * FROM `order_items` WHERE order_id = '$orderId'";
    return mysqli_query($con, $query);
}


function publishFeedback($orderId, $feedbackHeader, $feedbackDetails, $rating){
    global $con;
    $orderId = intval($orderId);
    $feedbackHeader = mysqli_real_escape_string($con, $feedbackHeader);
    $feedbackDetails = mysqli_real_escape_string($con, $feedbackDetails);
    $rating = intval($rating); 

    $query = "INSERT INTO feedbacks (order_id, feedback_heading, feedback_description, feedback_rating)
              VALUES ('$orderId', '$feedbackHeader', '$feedbackDetails', '$rating')";
    
    $result = mysqli_query($con, $query);

    if($result){
        return true;
    } else {
        return false;
    }
}
?>