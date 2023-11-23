<?php
include('functions/userfunctions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['order_id'], $_POST['feedback_header'], $_POST['feedback_details'], $_POST['rating'])) {
        $order_id = $_POST['order_id'];
        $user_id = getCurrentUserID();
        $feedback_header = $_POST['feedback_header'];
        $feedback_details = $_POST['feedback_details'];
        $rating = $_POST['rating'];
        if (publishFeedback($order_id, $user_id, $feedback_header, $feedback_details, $rating)) {
            redirect('reviews.php', "Review Published Successfully!");
            exit();
        } else {
            header('Location: reviews.php');
            exit();
        }
    } else {
        echo "Error: Missing form data.";
    }
}