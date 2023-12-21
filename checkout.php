<?php

include('functions/userfunctions.php');
include('includes/header.php');
include('authenticate.php');
include('vendor/autoload.php');



// use Payment\Payment;

// $payment = new Payment();

?>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a href="index.php" class="text-white">
                Home /
            </a>
            <a href="cart.php" class="text-white">
                Cart /
            </a>
            <a href="checkout.php" class="text-white">
                Checkout
            </a>
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="card shadow">
            <div class="card-body shadow">
            <form action="functions/placeorder.php" method="POST">
                <div class="row">
                    <div class="col-md-7">
                        <!-- Basic Details -->
                        <h5 class="text-dark"><strong>Basic Details</strong></h5>
                        <hr>
                        <?php
                        $user = getAllInfo('users');
                    
                        if (!empty($user)) {
                            
                            foreach ($user as $name) {
                                ?>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold text-dark">Name</label>
                                        <input type="text" name="name" required placeholder="Enter your full name" class="form-control" autocomplete="off" value="<?= $name['name']; ?>" readonly>
                                        <!--<input type="text" name="name" required placeholder="Enter your full name" class="form-control" autocomplete="off" value="<?= $str; ?>" readonly>-->
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold text-dark">E-mail</label>
                                        <input type="email" name="email" required placeholder="Enter your email" class="form-control" autocomplete="off" value="<?= $name['email']; ?>" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold text-dark">Phone</label>
                                        <input type="text" name="phone" required placeholder="Enter your phone number" class="form-control" autocomplete="off" value="<?= $name['phone']; ?>" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold text-dark">ZIP Code</label>
                                        <input type="text" name="zip_code" required placeholder="Enter your zip code" class="form-control" autocomplete="off" value="<?= $name['zip']; ?>" readonly>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="fw-bold text-dark">Address</label>
                                        <textarea name="address" required class="form-control" rows="5" autocomplete="off"><?= $name['address']; ?></textarea>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "No Records Found";
                        }
                        ?>
                    </div>

                    <div class="col-md-5">
                        <!-- Order Details -->
                        <h5 class="text-danger"><strong>Order Details</strong></h5>
                        <hr>
                        <?php
                            if(isset($_GET['product'])){
                                if(isset($_GET['qty'])){
                                    $items[] = instantAddProductToCart($_GET['product'], $_GET['qty']);
                                }
                            }else{
                                $items = getCartItems();
                            }
                            $totalPrice = 0;
                            
                            if($items){
                                foreach ($items as $citem) {
                                    if ($citem['qty'] >= $citem['prod_qty']) {
                                        ?>
                                        <div class="mb-1 border">
                                            <div class="row align-items-center">
                                                <div class="col-md-2">
                                                    <img src="uploads/<?= $citem['image'] ?>" alt="Image" width="90px" height="80px">
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="ms-4">
                                                        <label class="text-dark"><?= $citem['name'] ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="text-success">₱ <?= $citem['selling_price'] ?>.00</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="ms-5">
                                                        <label class="text-dark"><?= $citem['size'] ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="text-danger"><?= $citem['prod_qty'] ?>x</label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        // Include the selected cart item in the form
                                        ?>
                                        <input type="hidden" name="selected_items[]" value="<?= $citem['prod_id'] ?>">
                                        <?php
                                        $totalPrice += $citem['selling_price'] * $citem['prod_qty'];
                                    }
                                }
                                unset($_SESSION["cart_id"]);
                            }
                        ?>
                        <hr>
                        <h5 class="fw-bold text-danger">Total Price: <span class="float-end text-success">₱ <?= $totalPrice ?>.00</span></h5>
                        <hr>
                        <div class="row d-flex flex-column justify-content-center">
                            <h5 class="fw-bold text-dark">Place Order</h5>
                            <input type="hidden" name="payment_mode" value="COD">
                            <input type="hidden" name="payment_modes" value="Gcash">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-5 d-flex justify-content-center">
                                    <button type="submit" name="placeOrderBtn" class="btn btn-outline-primary mt-2">Cash On Delivery</button>
                                </div>
                                <div class="col-md-5 d-flex justify-content-center">
                                    <button type="button" name="GcashBtn" class="btn btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#gcash-form"><img src="assets/images/gcash.png" alt="" height="25px" width="25px">Gcash</button>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <div id="paypal-button-container"></div>  
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="modal" id="gcash-form" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content" style="height: 600px;">
                            <div class="modal-header" style="background: #1B72FB;">
                                <h5 class="modal-title text-light"><img src="assets/images/gcash.png" class="img-fluid text-light" alt="" height="50px" width="50px"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-flex align-items-center">
                                <div class="card w-100">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center justify-content-between">Merchant: <p>AllAboutBasketball Official</p></div>
                                        <div class="d-flex align-items-center justify-content-between">Amount Due: <p>₱ <?= $totalPrice ?>.00</p></div>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="text-center mt-4 mb-4">
                                            <strong>
                                                Login to Pay with Gcash
                                            </strong>
                                        </h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">+63</span>
                                            <input type="number" require class="form-control" placeholder="9*********" aria-label="9*********" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-center align-items-center">
                                <button type="button"  data-bs-toggle="modal" data-bs-target="#gcash-confirm" class="btn btn-primary w-100">Proceed</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Confirmation -->
                <div class="modal" id="gcash-confirm" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content" style="height: 600px;">
                            <div class="modal-header" style="background: #1B72FB;">
                                <h5 class="modal-title text-light"><img src="assets/images/gcash.png" class="img-fluid text-light" alt="" height="50px" width="50px"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-flex align-items-center">
                                <div class="card w-100">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center justify-content-between">Merchant: <p>AllAboutBasketball Official</p></div>
                                        <div class="d-flex align-items-center justify-content-between">Us*** B.  <p>+63 - 9*********</p></div>
                                    </div>
                                    <div class="card-body">
                                        <div class="mt-4 mb-4 d-flex align-items-center justify-content-between">
                                            <h4 class="text-center">
                                                <strong>
                                                    Total Price
                                                </strong>
                                            </h4>

                                            <p>₱ <?= $totalPrice ?>.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-center align-items-center">
                            <button type="submit" name="GcashBtn" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">Pay</button>
                              
                        </div>
                        </div>
                    </div>
                </div>
            </form>

            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<script src="https://www.paypal.com/sdk/js?client-id=AVdS_posENfhM0iIDrMn65L8X_YFCqYRumC71tbUVa5xLV8vdmCf63BrszerC7F7Q_YB0pOo0JtofdNE&currency=PHP"></script>

    <script>
      paypal.Buttons({
        createOrder: (data, actions) => {
            return actions.order.create({
              purchase_units: [{
                amount: {
                    value: <?= $totalPrice ?>
                }
              }]
            })
        },

        onApprove: (data, action) => {
          return actions.order.capture().then(orderData => {
            console.log("Payment Approved!")
            var name = $('input[name="name"]').val();
            var email = $('input[name="email"]').val();
            var phone = $('input[name="phone"]').val();
            var zipCode = $('input[name="zip_code"]').val();
            var address = $('textarea[name="address"]').val();
            $.ajax({
                method: "POST",
                url: "functions/placeorder.php",
                data: {
                    "Paypal": true,
                    "name": name,
                    "email": email,
                    "phone": phone,
                    "zip_code": zipCode,
                    "address": address,
                    "payment_modes": "paypal" 
                },
                success: function(response) {
                    console.log("POST request successful:", response);
                },
                error: function(err) {
                    console.error("Error sending POST request:", err);
                }
            });
          })
        }
      }).render('#paypal-button-container')
    </script>
