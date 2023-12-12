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

function getUserByID($userId){
    global $con;
    $query = "SELECT * FROM users WHERE id = '$userId'";
    return mysqli_query($con, $query);
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


function publishFeedback($orderId, $user_id, $feedbackHeader, $feedbackDetails, $rating){
    global $con;
    $orderId = intval($orderId);
    $feedbackHeader = mysqli_real_escape_string($con, $feedbackHeader);
    $feedbackDetails = mysqli_real_escape_string($con, $feedbackDetails);
    $rating = intval($rating); 

    $query = "INSERT INTO feedbacks (order_id, user_id, feedback_heading, feedback_description, feedback_rating)
              VALUES ('$orderId', '$user_id', '$feedbackHeader', '$feedbackDetails', '$rating')";
    
    $result = mysqli_query($con, $query);

    if($result){
        return true;
    } else {
        return false;
    }
}

function getCurrentUserID(){
    if(isset($_SESSION['auth'])){
        return $_SESSION['auth_user']['user_id'];
    }else{
        return null;
    }
}

function getFeedbacks($user_id){
    global $con;
    $query = "SELECT * FROM feedbacks WHERE user_id = '$user_id'";
    return mysqli_query($con, $query);
}

function getProductReviews($product_id){
    global $con;
    $query = "SELECT fb.* 
              FROM feedbacks fb
              JOIN orders o ON fb.order_id = o.id
              JOIN order_items oi ON o.id = oi.order_id
              WHERE oi.prod_id = '$product_id'";
    $result = mysqli_query($con, $query);

    if($result) {
        return $result;
    } else {
        return null;
    }
}

function getFeedbackCommentsByID($id){
    global $con;
    $query = "SELECT * FROM feedback_comments WHERE feedback_id = '$id'";
    return  mysqli_query($con, $query);
}


function uploadCollabData($userId, $name, $filename, $cloth_size, $color){
    global $con;
    $test_query = "INSERT INTO upload (user_id, name, cloth_size, color, image) VALUES ( '$userId' ,'$name', '$cloth_size', '$color', '$filename')";
    $test_query_run = mysqli_query($con, $test_query);
}

function getCollabDataByUserID($userId){
    global $con;
    $query = "SELECT * FROM upload WHERE user_id = '$userId'";
    return mysqli_query($con, $query);
}


function getCollabData($id){
    global $con;
    $query = "SELECT * FROM `upload` WHERE id = '$id'";
    return mysqli_query($con, $query);
}

function getInTransitOrders(){
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM orders WHERE user_id = '$userId' AND status BETWEEN 3 AND 7";
    return $query_run = mysqli_query($con, $query);
}
?>