<?php

include('../middleware/adminMiddleware.php'); 
include('includes/header.php');

if(isset($_GET['t']))
{
    $tracking_no = $_GET['t'];

    $orderData = getAllCollab();
    if(mysqli_num_rows($orderData) < 0)
    {
        ?>
            <h4>Something Went Wrong</h4>
        <?php
        die();
    }

}
else
{
    ?>
        <h4>Something Went Wrong</h4>
    <?php
    die();

}

$data = mysqli_fetch_array($orderData);

?>


<div class="container">
    <div class="row">
        <div class="colmd-12">
            <div class="card">
                <div class="card-header bg-info">
                    <span class="fs-4 fw-bold text-white">View Order</span>                          
                    <a href="collab.php" class="btn btn-warning float-end"><i class="fa fa-reply me-1"></i>Back</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Delivery Details</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label class="fw-bold">Description</label>
                                    <div class="border p-1">
                                        <?= $data['name']; ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="fw-bold">Size</label>
                                    <div class="border p-1">
                                        <?= $data['cloth_size']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Order Details</h4>
                            <hr>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>                                      
                                        <?php
                                                $orders = getAllCollab("upload");
                
                                                if(mysqli_num_rows($orders) > 0)
                                                {
                                                    foreach ($orders as $items) {
                                                        ?>
                                                             
                                                        <?php
                                                        
                                                    }
                                                }
                                        ?>
                                    </tbody>
                            </table>
                            <hr>
                            <h5>Total Price: 700.00</h5>
                            
                            <hr>
                            <label class="fw-bold">Status: </label>
                            <?php
                                $products = getAll('upload');

                                if(mysqli_num_rows($products) > 0)
                                
                                    foreach($products as $item)
                                
                                        ?>
                            <?php 
							 			if ($item['status'] == 0) {
							 				echo "<span class='color: blue'>Pending</span>";
							 			}
							 			if ($item['status'] == 1){
							 				echo "<span class='color: green'> Approved</span>";
							 			}
                                        if ($item['status'] == 2){
                                            echo "<span class='color: red'> Rejected</span>";
                                        } ?>
                                <br><form action="approvedes.php?id=<?php echo $result['id']; ?>" method="POST">
							 				<input type="hidden" name="appid" value="<?php echo $result['id']; ?>">
							 				<input type="submit" class="btn btn-sm btn-success" name="approve" value="Approve">
							 			
                                        <form action="rejectdes.php?id=<?php echo $result['id']; ?>" method="POST">
							 				<input type="hidden" name="appid" value="<?php echo $result['id']; ?>">
							 				<input type="submit" class="btn btn-sm btn-danger" name="reject" value="Reject">
							 			</form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>