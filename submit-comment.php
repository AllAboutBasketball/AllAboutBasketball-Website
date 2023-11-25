<?php
include('functions/userfunctions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['comment'], $_POST['feedback_id'], $_POST['user_id'])) {
        $comment = $_POST['comment'];
        $feedback_id = $_POST['feedback_id'];
        $user_id = $_POST['user_id'];

        $comment = mysqli_real_escape_string($con, $comment);

        $query = "INSERT INTO feedback_comments (text, user_id, feedback_id) VALUES ('$comment', '$user_id', '$feedback_id')";
        $result = mysqli_query($con, $query);

        if ($result) {
            redirect('product-view.php', "Comment Submitted!");
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Error: Missing form data";
    }
}