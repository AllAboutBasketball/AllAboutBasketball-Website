<?php
include('functions/userfunctions.php');
include('includes/header.php');
include('authenticate.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['order_id'])) {
    $tracking_no = $_GET['order_id'];
    $orderDetails = getOrderDetails($tracking_no);

    

} else {
    ?>
    <h4>Something Went Wrong</h4>
    <?php
    die();
}

?>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a href="index.php" class="text-white">
                Home /
            </a>
            <a href="my-orders.php" class="text-white">
                Track Orders /
            </a>
            <a href="#" class="text-white">
                Review Order
            </a>
        </h6>
    </div>
</div>

<div class="container mt-4">
    <h3>Order Items</h3>
    <ul>
        <?php
        while ($item = mysqli_fetch_assoc($orderDetails)) {
            $products = getByID('products', $item['prod_id']);
            while ($product_item = mysqli_fetch_assoc($products))
            {
        ?>
                <div class="card p-3 mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?php echo $product_item['image']; ?>" class="img-fluid rounded-start" alt="Product Image">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product_item['name']; ?></h5>
                                <p class="card-text">Quantity: <?php echo $item['qty']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </ul>
</div>

<div class="container mt-4">
    <h2>Review Order</h2>
    <form method="post" action="submit-feedback.php">
        <?php
        $order = mysqli_fetch_assoc($orderDetails);
        ?>
        <input type="hidden" name="order_id" value="<?php echo $tracking_no; ?>">
        <div class="mt-2 mb-3 d-flex align-items-center">
            <span class="h4">Order ID</span> <span class="text-muted h6">:<?php echo $tracking_no ?></span>
        </div>

        <label class="h5">Feedback Header:</label>
        <input type="text" name="feedback_header" class="form-control"><br>
        <label class="h5">Feedback Details:</label>
        <textarea name="feedback_details" rows="4" cols="50" class="form-control"></textarea><br>
        <label>Rating (out of 5):</label>
        <div class="rating">
            <input type="radio" id="star5" name="rating" value="5">
            <label for="star5" title="5 stars"></label>
            <input type="radio" id="star4" name="rating" value="4">
            <label for="star4" title="4 stars"></label>
            <input type="radio" id="star3" name="rating" value="3">
            <label for="star3" title="3 stars"></label>
            <input type="radio" id="star2" name="rating" value="2">
            <label for="star2" title="2 stars"></label>
            <input type="radio" id="star1" name="rating" value="1">
            <label for="star1" title="1 star"></label>
        </div>
        <br>

        <input class="btn btn-success shadow mt-3" type="submit" value="Submit Review">
    </form>
</div>

<?php include('includes/footer.php'); ?>
