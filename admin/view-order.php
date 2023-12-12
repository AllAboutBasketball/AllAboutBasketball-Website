<?php

include('../middleware/adminMiddleware.php'); 
include('includes/header.php');

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


<div class="container">
    <div class="row">
        <div class="colmd-12">
            <div class="card">
                <div class="card-header bg-info">
                    <span class="fs-4 fw-bold text-white">View Order</span>                          
                    <a href="orders.php" class="btn btn-warning float-end"><i class="fa fa-reply me-1"></i>Back</a>
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
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>                                      
                                        <?php
                                                $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*, oi.qty as orderqty, p.* FROM
                                                    orders o, order_items oi, products p WHERE oi.order_id=o.id AND p.id=oi.prod_id AND o.tracking_no='$tracking_no' ";
                                                $order_query_run = mysqli_query($con, $order_query);

                                                if(mysqli_num_rows($order_query_run) > 0)
                                                {
                                                    foreach ($order_query_run as $item) {
                                                        ?>
                                                            <tr>
                                                                <td class="align-middle">
                                                                    <img src="../uploads/<?= $item['image']; ?>" width="50px" height="50px" alt="<?= $item['name']; ?>">
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
                            <h5>Total Price: <span class="float-end fw-bold">₱<?= $data['total_price']; ?>.00</span></h5>
                            
                            <hr>
                            <label class="fw-bold">Payment Method</label>
                            <div class="border p-1 mb-3">
                                <?= $data['payment_mode']?>
                            </div>
                            <label class="fw-bold">Status</label>
                            <div class="mb-3">
                                <?php
                                if($data['status'] > 0)
                                {
                                ?>
                                    <?php
                                        if($data['status'] == 8){
                                    ?>
                                        <strong class="text-secondary">ITEM DELIVERED!</strong>
                                    <?php
                                        }else{
                                    ?>
                                    <form action="code.php" method="POST">
                                        <input type="hidden" name="tracking_no" value="<?= $data['tracking_no'] ?>">
                                        <input type="hidden" name="order_id" value="<?= $data['id'] ?>">
                                        <select name="order_status" class="form-select" onchange="toggleInput(this.value)">
                                            <option value="1" <?= $data['status'] == 1 ? "selected" : "" ?>>Pending</option>
                                            <option value="2" <?= $data['status'] == 2 ? "selected" : "" ?>>Order Packaged</option>
                                            <option value="3" <?= $data['status'] == 3 ? "selected" : "" ?>>Picked up by courier</option>
                                            <option value="4" <?= $data['status'] == 4 ? "selected" : "" ?>>Arrived at Sorting Station</option>
                                            <option value="5" <?= $data['status'] == 5 ? "selected" : "" ?>>Departed at Sorting Station</option>
                                            <option value="6" <?= $data['status'] == 6 ? "selected" : "" ?>>Arrived at Delivery Hub</option>
                                            <option value="7" <?= $data['status'] == 7 ? "selected" : "" ?>>Out for Delivery</option>
                                            <option value="8" <?= $data['status'] == 8 ? "selected" : "" ?>>Delivered</option>
                                        </select>

                                        <div id="locationInput" class="form-control mt-3" style="display: none;">
                                            <label for="location">Current Location:</label>
                                            <input type="text" class="form-control" id="location" name="location">
                                        </div>
                                    <!-- <label class="fw-bold mt-2">Status</label>
                                    <select name="remarks_status" class="form-select">
                                            <option value="0"<?= $data['status'] == 0?"selected":""?>>Order On Progress</option>
                                            <option value="1"<?= $data['status'] == 1?"selected":""?>> On Shipping</option>
                                            <option value="2"<?= $data['status'] == 2?"selected":""?>>Thankyou! AAB Likes you!</option>
                                            <option value="3"<?= $data['status'] == 3?"selected":""?>>Technical Issue</option>
                                        </select>
                                    <br> -->
                                        <button type="submit" name="update_order_btn" class="btn btn-success mt-3"><i class="fa fa-refresh me-1"></i>Update Status</button>
                                        <!--<button type="submit" name="sub_courier_btn" class="btn btn-info mt-3 ms-5"><i class="fas fa-box me-1"></i>Submit to Courier</button>-->
                                    </form>
                                    <?php
                                        }
                                    ?>
                            <?php
                                }else{
                            ?>
                                <strong class="text-primary">CANCELLED</strong>
                            <?php
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

<?php include('includes/footer.php'); ?>