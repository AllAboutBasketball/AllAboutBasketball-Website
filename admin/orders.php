<?php

include('../middleware/adminMiddleware.php'); 
include('includes/header.php');


?>

<div class="container">
    <div class="row">
        <div class="colmd-12">
           <div class="card">
               <div class="card-header bg-info">
                   <h4 class="text-white">Orders
                        <a href="order_history.php" class="btn btn-danger float-end"><i class="fa fa-history me-1"></i>Order History</a>
                   </h4>
               </div>
               <div class="card-body" id="">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-success fw-bold text-center">ID</th>
                                <th class="text-success fw-bold text-center">Users</th>
                                <th class="text-success fw-bold text-center">Tracking No.</th>
                                <th class="text-success fw-bold text-center">Price</th>
                                <th class="text-success fw-bold text-center">Date Ordered</th>
                                <th class="text-success fw-bold text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $orders = getAllOrders();

                                if(mysqli_num_rows($orders) > 0)
                                {
                                    foreach ($orders as $items) {
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $items['id']; ?></td>
                                                <td class="text-center"><?= $items['name']; ?></td>
                                                <td class="text-center"><?= $items['tracking_no']; ?></td>
                                                <td class="text-center">₱ <?= $items['total_price']; ?>.00</td>
                                                <td class="text-center"><?= $items['created_at']; ?></td>
                                                <td class="text-center">
                                                    <a href="view-order.php?t=<?= $items['tracking_no']; ?>" class="btn btn-success">View Details</a>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                        <tr>
                                            <td colspan="5">No Orders Yet</td>
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