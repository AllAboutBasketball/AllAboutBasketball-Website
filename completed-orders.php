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
<nav class="navbar navbar-expand-lg navbar-secondary sticky-top bg-info shadow">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="text-white">   
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-dark " href="my-orders.php">Pending</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark " href="confirmed-orders.php">Confirmed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark<?= $page == "completed-orders.php"? 'active text-white':''; ?>" href="completed-orders.php">Completed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="canceled-orders.php">Canceled</a>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $orders = getCompletedOrders();

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
                                                    <a href="view-order.php?t=<?= $items['tracking_no']; ?>" class="btn btn-outline-success">View Details</a>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                        <tr>
                                            <td colspan="5">No Completed Orders Yet</td>
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