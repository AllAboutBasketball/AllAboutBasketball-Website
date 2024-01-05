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

function getProductSizes($table, $slug){
    global $con;
    $query = "SELECT id, size, selling_price FROM $table WHERE slug = '$slug'";
    $query_run = mysqli_query($con, $query);
    
    if (!$query_run) {
        echo "Error: " . mysqli_error($con);
        return array(); 
    }
    
    $products = array();
    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $products[] = array(
                'prod_id' => $row['id'],
                'size' => $row['size'],
                'selling_price' => $row['selling_price']
            );
        }
    }
    
    return $products;
}


function getProdByCategory($category_id)
{
    global $con;
    $query = "SELECT * FROM products WHERE category_id = '$category_id' AND status = '0' GROUP BY slug";
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
    $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, c.selected, p.id as pid, p.name, p.size, p.image, p.selling_price, p.qty 
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
    
    $query = "SELECT * FROM orders WHERE user_id='$userId' AND status='-1' ORDER BY id DESC ";
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


function addProductToCart($prodId){
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $checkQuery = "SELECT * FROM carts WHERE user_id = $userId AND prod_id = $prodId";
    $checkResult = mysqli_query($con, $checkQuery);

    if(mysqli_num_rows($checkResult) > 0) {
        $updateQuery = "UPDATE carts SET prod_qty = prod_qty + 1 WHERE user_id = $userId AND prod_id = $prodId";
        mysqli_query($con, $updateQuery);
    } else {
        $insertQuery = "INSERT INTO carts (user_id, prod_id, prod_qty) VALUES ($userId, $prodId, 1)";
        mysqli_query($con, $insertQuery);
    }   
}

function instantAddProductToCart($prodId, $qty){
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $checkQuery = "SELECT * FROM carts WHERE user_id = $userId AND prod_id = $prodId";
    $checkResult = mysqli_query($con, $checkQuery);

    if(mysqli_num_rows($checkResult) > 0) {
        $updateQuery = "UPDATE carts SET prod_qty = prod_qty + $qty WHERE user_id = $userId AND prod_id = $prodId";
        mysqli_query($con, $updateQuery);

        return getCartItem($userId, $prodId); 
    } else {
        $insertQuery = "INSERT INTO carts (user_id, prod_id, prod_qty) VALUES ($userId, $prodId, $qty)";
        mysqli_query($con, $insertQuery);

        return getCartItem($userId, $prodId);
    }
}

function getCartItem($userId, $prodId){
    global $con;
    $query = "SELECT c.id as cid, c.prod_id, c.selected, c.prod_qty, p.id as pid, p.name, p.size, p.image, p.selling_price, p.qty, c.selected 
              FROM carts c, products p 
              WHERE c.prod_id = p.id AND c.user_id = '$userId' AND c.prod_id = '$prodId'";
    $result = mysqli_query($con, $query);

    if($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result); 
    }

    return null; 
}



function cancelOrder($trackingNo){
    global $con;
    $query = "UPDATE orders SET status = -1 WHERE tracking_no = '$trackingNo'";
    mysqli_query($con, $query);
}

function checkIfItemChecked($prod_id){
    global $con;
    
    $query = "SELECT selected FROM carts WHERE prod_id = '$prod_id'";
    $result = mysqli_query($con, $query);

    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $selected = $row['selected'];
        return ($selected == 1) ? true : false;
    } else {
        return false;
    }
}

function getSelectedCartItems(){
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid, c.prod_id, c.selected, c.prod_qty, p.id as pid, p.name, p.size, p.image, p.selling_price, p.qty 
                FROM carts c, products p WHERE c.prod_id=p.id AND c.user_id='$userId' AND c.selected = 1 ORDER BY c.id DESC"; 
    return $query_run = mysqli_query($con, $query);
}
?>