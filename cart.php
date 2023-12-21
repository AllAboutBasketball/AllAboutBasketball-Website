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
            <a href="cart.php" class = "text-white">
            Cart
            </a> 
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="card card-body shadow">
            <div class="row">
                <div class="col-md-12">
                <div id="mycart">
                <?php
                    $items = getCartItems();

                    if(mysqli_num_rows($items) > 0){
                        ?>

                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <h6 class="text-success fw-bold">Product</h6>
                            </div>
                            <div class="col-md-2">
                                <h6 class="text-success fw-bold">Price</h6>
                            </div>
                            <div class="col-md-2">
                                <h6 class="text-success fw-bold">Size</h6>
                            </div>
                            <div class="col-md-2">
                                <h6 class="text-success fw-bold">Quantity</h6>
                            </div>
                        </div>

                        <div id="">

                            <?php
                            if(mysqli_num_rows($items) > 0)
                            foreach ($items as $citem) 
                            {
                                ?>
                                <div class="card product_data product_<?php echo $citem['prod_id']; ?> shadow-ms mb-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-1">
                                            <img src="uploads/<?= $citem['image']?>" alt="Image" width="90px" height="80px">
                                        </div>
                                        <div class="col-md-2">
                                            <h5><?= $citem['name']?></h5>
                                        </div>
                                        <div class="col-md-2">
                                        <h5 id="subtotal_<?php echo $citem['prod_id']; ?>">₱ <?= $citem['selling_price'] * $citem['prod_qty']?>.00</h5>
                                        </div>
                                        <div class="col-md-2">
                                            <h5><?= $citem['size']?></h5>
                                        </div>
                                        <div class="col-md-2">
                                            <?php
                                                if($citem['qty'] > $citem['prod_qty'])
                                                {
                                                    ?>
                                                        <input type="hidden" class="prodId" value="<?= $citem['prod_id']?>">
                                                        <div class="input-group mb-1" style = "width:130px">
                                                            <button class="input-group-text decrement-btn updateQty">-</button>
                                                            <input type="text" class="form-control input-qty text-center bg-white" value = "<?= $citem['prod_qty']?>" disabled>
                                                            <button class="input-group-text increment-btn updateQty">+</button>
                                                        </div>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                         <label  class = "btn btn-danger text-white">Out of stock</label><br>
                                                        
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="checkbox" name="selected_item" class="checkbox-item"  value="<?= $citem['cid']?>">
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-danger btn-sm deleteItem" value="<?= $citem['cid']?>">
                                            <i class="fa fa-trash me-2"></i>Remove</button>
                                        </div>
                                    </div>
                                </div>

                                <?php                  
                            }
                            ?>
                        </div>
                        <div class="float-end">
                            <a id="proceedBtn" class="btn btn-outline-primary" onclick="return validateCheckbox()">Proceed to Checkout</a>
                        </div>
                    <?php
                    }
                    else
                    {
                        ?>
                        <div class="card card-body shadow text-center">
                            <h4 class="py-3">Your Cart is Empty</h4>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<script>
$(document).ready(function () {
    $(document).on('click','.updateQty', function (e) {
        e.preventDefault();
        var clickedButton = $(this);
        var qty = clickedButton.closest('.product_data').find('.input-qty').val();
        var prod_id = clickedButton.closest('.product_data').find('.prodId').val();

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id" : prod_id,
                "prod_qty" : qty,
                "scope" : "update"
            },
            success: function (response) {
                window.location.reload();
            },
            error: function () {
                console.log("Error occurred during AJAX request");
            }
        });
    });
})
</script>