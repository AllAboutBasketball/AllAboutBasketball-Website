<?php

include('functions/userfunctions.php');
include('includes/header.php');
include('authenticate.php');

if(isset($_GET['t']))
{
    $tracking_no = $_GET['t'];

    $orderData = checkTrackingNoValid($tracking_no);
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

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class = "text-white">
            <a href="index.php" class = "text-white">
            Home / 
            </a>
            <a href="my-orders.php" class = "text-white">
            Track Orders /
            </a> 
            <a href="#" class = "text-white">
            View Orders
            </a> 
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="card card-body shadow">
            <div class="row">
                <div class="col-md-12">
                   <div class="card">
                       <div class="card-header bg-primary">
                           <span class="text-white fs-4">View Order</span>                          
                           <a href="my-orders.php" class="btn btn-warning float-end"><i class="fa fa-reply"></i>Back</a>
                       </div>
                       <div class="card-body">
                           <div class="row">
                               <div class="col-md-6">
                                   <h4>Delivery Details</h4>
                                   <hr>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Name</label>
                                            <div class="border p-1">
                                                <?= $data['name']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">E-mail</label>
                                            <div class="border p-1">
                                                <?= $data['email']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Phone</label>
                                            <div class="border p-1">
                                                <?= $data['phone']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Tracking No.</label>
                                            <div class="border p-1">
                                                <?= $data['tracking_no']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Address</label>
                                            <div class="border p-1">
                                                <?= $data['address']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">ZIP Code</label>
                                            <div class="border p-1">
                                                <?= $data['zip_code']; ?>
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
                                               <th>Poduct</th>
                                               <th>Price</th>
                                               <th>Quantity</th>
                                           </tr>
                                        </thead>
                                        <tbody>                                      
                                                <?php
                                                        $userId = $_SESSION['auth_user']['user_id'];

                                                        $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*, oi.qty as orderqty, p.* FROM
                                                            orders o, order_items oi, products p WHERE o.user_id='$userId' AND 
                                                            oi.order_id=o.id AND p.id=oi.prod_id AND o.tracking_no='$tracking_no' ";
                                                        $order_query_run = mysqli_query($con, $order_query);

                                                        if(mysqli_num_rows($order_query_run) > 0)
                                                        {
                                                            foreach ($order_query_run as $item) {
                                                                ?>
                                                                    <tr>
                                                                        <td class="align-middle">
                                                                            <img src="uploads/<?= $item['image']; ?>" width="50px" height="50px" alt="<?= $item['name']; ?>">
                                                                            <?= $item['name']; ?>
                                                                        </td>
                                                                        <td class="align-middle">₱ 
                                                                            <?= $item['price']; ?>.00
                                                                        </td>    
                                                                        <td class="align-middle">
                                                                            <?= $item['orderqty']; ?>x
                                                                        </td>                       
                                                                    </tr>   
                                                                <?php
                                                                
                                                            }
                                                        }
                                                ?>
                                            </tbody>
                                   </table>
                                   <hr>
                                   <h5><strong> Total Price: </strong> <span class="float-end fw-bold text-danger"> <strong>₱<?= $data['total_price']; ?>.00 </strong></span></h5>
                                   
                                    <hr>
                                    <?php
                                    if($data['payment_id'] != "")
                                    {
                                        ?>
                                            <label class="fw-bold">Transaction Code</label>
                                            <div class="border p-1 mb-3">
                                                 <?= $data['payment_id']?>
                                            </div>
                                        <?php
                                    }
                                    ?>
                                    
                                    <label class="fw-bold">Payment Method</label>
                                   <div class="border p-1 mb-3">
                                        <?= $data['payment_mode']?>
                                   </div>
                                   <label class="fw-bold">Status</label>
                                   <div class="border p-1 mb-3">
                                   <?php
                                    $status = $data['status'];
                                    $statusLabel = '';

                                    switch ($status) {
                                        case 0:
                                            $statusLabel = "Order Placed";
                                            break;
                                        case 1:
                                            $statusLabel = "Pending";
                                            break;
                                        case 2:
                                            $statusLabel = "Order Packaged";
                                            break;
                                        case 3:
                                            $statusLabel = "Picked up by courier";
                                            break;
                                        case 4:
                                            $statusLabel = "Arrived at Sorting Station";
                                            break;
                                        case 5:
                                            $statusLabel = "Departed at Sorting Station";
                                            break;
                                        case 6:
                                            $statusLabel = "Arrived at Delivery Hub";
                                            break;
                                        case 7:
                                            $statusLabel = "Out for Delivery";
                                            break;
                                        case 8:
                                            $statusLabel = "Delivered";
                                            break;
                                        default:
                                            $statusLabel = "Unknown";
                                            break;
                                    }

                                    echo $statusLabel;
                                    ?>: 
                                    <strong>
                                        <?php 
                                            if($data['current_location']){
                                                echo $data["current_location"];
                                            }
                                        ?>
                                    </strong>
                                   </div>
                                   <label class="fw-bold">Remarks</label>
                                   <div class="border p-1 mb-3">
                                        <?php 
                                            
                                            if($data['status'] == 0 || $data['status'] == 1)
                                            {
                                                echo "On Progress";
                                            }
                                            else if($data['status'] == 2 || $data['status'] == 3 || $data['status'] == 4 || $data['status'] == 5 || $data['status'] == 6 || $data['status'] == 7)
                                            {
                                                echo "On Shipping";
                                            }
                                            else if($data['status'] == 8)
                                            {
                                                echo "Thankyou! AAB Likes You!";
                                            }
                                            else if($data['status'] == 10)
                                            {
                                                echo "Technical Issue";
                                            }else if($data['status'] == 11)
                                            {
                                                echo "Canceled";
                                            }
                                            else
                                            {
                                                echo "Unknown";
                                            }
                                        ?>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>