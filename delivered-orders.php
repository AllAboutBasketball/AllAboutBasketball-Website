<?php

include('functions/userfunctions.php');
include('includes/header.php');
include('authenticate.php');

?>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class = "text-white">
            <a href="index.php" class = "text-white">
            Home / 
            </a>
            <a href="my-orders.php" class = "text-white">
            My Orders
            </a> 
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="card card-body shadow">
<?php 
    $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/") + 1);
?>
<!-- <nav class="navbar navbar-expand-lg navbar-secondary sticky-top bg-info shadow">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="text-white">   
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="my-orders.php">Pending</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="confirmed-orders.php">Confirmed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="forpickup-orders.php">Pick Up by Courier</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="canceled-orders.php">Canceled</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?= $page == "delivered-orders.php"? 'active text-white':''; ?>" href="delivered-orders.php">Delivered</a>
                </li>    
            </ul>
            </div> 
        </div>
    </div>
</nav> -->

<nav class="navbar navbar-expand-lg navbar-secondary sticky-top bg-info shadow" style="z-index: 100;">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="text-white">   
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="my-orders.php">Pending</a>
                </li>
                <li>
                    <a class="nav-link text-dark" href="transit.php">In Transit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark<?= $page == "my-orders.php"? 'active text-white':''; ?>" href="delivered-orders.php">Delivered</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark<?= $page == "canceled-orders.php"? 'active text-white':''; ?>" href="canceled-orders.php">Canceled</a>
                </li>
            </ul>
            </div> 
        </div>
    </div>
</nav>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-success fw-bold">ID</th>
                                <th class="text-success fw-bold">Tracking No.</th>
                                <th class="text-success fw-bold">Price</th>
                                <th class="text-success fw-bold">Date Ordered</th>
                                <th class="text-success fw-bold">View</th>
                                <th class="text-success fw-bold">Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $orders = getDeliveredOrders();

                                if(mysqli_num_rows($orders) > 0)
                                {
                                    foreach ($orders as $items) {
                                        ?>
                                            <tr>
                                                <td><?= $items['id']; ?></td>
                                                <td><?= $items['tracking_no']; ?></td>
                                                <td>₱ <?= $items['total_price']; ?>.00</td>
                                                <td><?= $items['created_at']; ?></td>
                                                <td>
                                                    <a href="view-order.php?t=<?= $items['tracking_no']; ?>" class="btn btn-outline-primary">View Details</a>
                                                </td>
                                                <td>
                                                    <a href="review-order.php?order_id=<?= $items['id']; ?>" class="btn btn-outline-primary">Leave Review</a>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                        <tr>
                                            <td colspan="6">No Confirmed Orders Yet</td>
                                        </tr>
                                    <?php   
                                }
                            ?>
                           
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>