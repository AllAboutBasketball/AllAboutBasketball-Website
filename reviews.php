<?php
include('functions/userfunctions.php');
include('includes/header.php');
include('authenticate.php');

$user_id = getCurrentUserID();
$feedbacks = getFeedbacks($user_id);
?>

<div class="container mt-4">
    <?php
    if (empty($feedbacks)) {
        echo "<p>You don't have any Reviews Published.</p>";
    } else {
        foreach ($feedbacks as $feedback) {
            ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Order ID: <?php echo $feedback['order_id']; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Feedback Heading: <?php echo $feedback['feedback_heading']; ?></h6>
                    <p class="card-text">Feedback Details: <?php echo $feedback['feedback_description']; ?></p>
                    <div class="rating" style="direction: ltr;">
                        <?php
                        $rating = intval($feedback['feedback_rating']);
                        for ($i = 1; $i <= 5; $i++) {
                            $checked = $i <= $rating ? "checked" : "";
                            $starClass = $i <= $rating ? "checked-star" : "unchecked-star";
                            ?>
                            <input type="radio" id="star<?php echo $i ?>" name="rating" value="<?php echo $i ?>" <?php echo $checked ?>>
                            <label for="star<?php echo $i ?>" class="<?php echo $starClass ?>" title="<?php echo $i ?> stars"></label>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>

<?php include('includes/footer.php'); ?>