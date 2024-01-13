<?php
include('functions/userfunctions.php');
include('includes/header.php');

if(isset($_GET['product']))
{
    $product_slug = $_GET['product'];
    $product_data = getSlugActive("products", $product_slug);
    $product = mysqli_fetch_array($product_data);

    $product_reviews = getProductReviews($product['id']);

    $qty = 1;


    if($product)
    {
        ?>
        <div class="py-3 bg-primary">
            <div class="container">
                <h6 class = "text-white">
                    <a class = "text-white" href="categories.php">
                        Home / 
                    </a>
                    <a class = "text-white" href="categories.php">
                        Collections / 
                    </a>
                   
                    <?= $product['name']; ?></h6>
            </div>
        </div>
        <div class="bg-light py-4">
            <div class="container product_data mt-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="shadow">
                            <img src="uploads/<?= $product['image']?>" alt="Product Image" class = "w-100">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h4 class = "fw-bold text-dark"> <strong> <?= $product['name']?> </strong>
                            
                        </h4>
                        <hr>
                        <h6 class = "fw-bold text-primary">Description</h6>
                        <p><?= $product['description']?></p>
                        <div class="row">
                            <hr>
                            <div class="row">
                                <div class="col-md-3" id="stock-display" style="display: none;">
                                <?php 
                                if($product['qty'] > 0)
                                {
                                    ?>
                                        <label  class = "btn btn-warning text-white">Limited Stock</label><span class="ms-1 fs-5 fw-bold">:</span>
                                        <span class="ms-1 fw-bold mt-2 fs-4" id="prod_stock"><?= $product['qty'];?></span>
                                    <?php 

                                }
                                else
                                {
                                    ?>
                                        <label class="btn btn-danger text-white">Out of stock</label><br>
                                    <?php 
                                }
                                
                                ?>
                                </div>           

                                <!-- Size Selection -->
                                <?php
                                $allSizes = ["SMALL", "MEDIUM", "LARGE", "XL"]; // Define all possible sizes
                                $slugs = getProductSizes("products", $product['slug']);
                                ?>
                                <div class="col">
                                    <div class="row">
                                        <?php foreach ($allSizes as $size) { ?>
                                            <?php
                                            $sizeInfo = findSizeInfo($slugs, $size); // Custom function to find size information in $slugs array
                                            $disabled = $sizeInfo ? '' : 'disabled'; // Check if size is available in the database
                                            ?>
                                            <div class="col-md-2 mt-1">
                                                <button type="button" name="size" value="<?= $sizeInfo ? $sizeInfo['prod_id'] : '' ?>" 
                                                        data-selling-price="<?= $sizeInfo ? $sizeInfo['selling_price'] : '' ?>" 
                                                        data-stock="<?= $sizeInfo ? $sizeInfo['stock'] : '' ?>" 
                                                        class="btn btn-outline-dark btn-sm custom-hover-color modal-button size-button" 
                                                        style="margin-right: -10px;" 
                                                        data-bs-toggle="modalsize" 
                                                        data-bs-target="#exampleSize" 
                                                        <?= $disabled ?>>
                                                    <?= $size ?>
                                                </button>
                                            </div>
                                        <?php } ?>
                                        <input type="hidden" id="selectedSize" name="selectedSize">
                                    </div>
                                </div>



                            <div class="row">
                                <div class="col-md-3 mt-4">
                                        <div class="input-group mb-3" style = "width:130px">
                                            <button class="input-group-text decrement-btn">-</button>
                                            <input type="text" class="form-control input-qty text-center bg-white" value = "1" disabled>
                                            <button class="input-group-text increment-btn">+</button>
                                        </div>                                                                                   
                                    </div>
                                    <div class="col-md-3 mt-4 text-end">
                                        <h4>₱ <span class="text-success fw-bold" id="price"><?= $product['selling_price']?>.00</span></h4>
                                    </div>
                                    <div class="col-md-5 mt-4">
                                        <h5 style="margin-left: 10%;"> ₱ <s class ="text-danger"><?= $product['original_price']?>.00</s></h5>
                                    </div>
                                </div>     
                            <div class="row">
                                <div class="col-md-6 mt-4">
                                    <?php 
                                        if($product['qty'] > 0)
                                        {
                                            ?>
                                                <button class = "btn btn-success px-4 AddTooCart-btn" id="AddTooCart-btn" type="button" <?php ($product['qty'] == 0) ? "disabled" : "" ?> value="<?= $product['id']?>"><i class = "fa fa-shopping-cart me-2"></i>Add to Cart</button>
                                                <div class="float-end">
                                                    <button class="btn btn-info checkout" id="checkout" type="button">
                                                        <i class="fa fa-money"></i>
                                                        Proceed to Checkout
                                                    </button>
                                                    <!-- <a href="checkout.php?product=<?php echo $product['id']; ?>" class="btn btn-info"><i class="fa fa-money"></i>Proceed to Checkout</a> -->
                                                </div>    
                                            <?php 

                                        }
                                        else
                                        {
                                            ?>
                                            
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


        <div class="container" style="margin-top:130px;">
            <h2 class="mb-5 text-center">User Reviews for this Product</h2>
            <?php foreach($product_reviews as $review) 
                {
                    $userResult = getUserByID(intval($review['user_id']));
                    $currentUserID = getCurrentUserID();
            ?>
                <div class="card mb-3">
                    <div class="card-header">
                        <span style="font-size: 0.9rem;">
                            <?php 
                                if($userResult){
                                    $user = mysqli_fetch_assoc($userResult);
                                    echo $user['name']; 
                                }
                            ?>
                        </span>
                        <br>
                        <strong>
                            <?php echo $review['feedback_heading']; ?>
                        </strong>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <h5 class="card-title"><?php echo $review['feedback_rating']; ?>/5: </h5>
                            <div class="rating" style="direction: ltr;">
                                <?php
                                $rating = intval($review['feedback_rating']);
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
                        <p class="card-text"><?php echo $review['feedback_description']; ?></p>
                        <hr>
                        <!-- Comment Form and Comment  -->
                        <form method="post" action="submit-comment.php">
                            <input type="hidden" name="feedback_id" value="<?php echo $review['id']; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $currentUserID; ?>">
                            <div class="mb-3">
                                <label for="comment" class="form-label">Your Comment:</label>
                                <input class="form-control" id="comment" name="comment" placeholder="Write your comment here" style="outline: none;border-bottom: 1px solid #ced4da;" />
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        <div class="mt-5">
                            <hr>
                            <?php
                                $comments = getFeedbackCommentsByID($review['id']);

                                foreach($comments as $comment){
                                    $userResultTwo = getUserByID($comment['user_id']);
                            ?>
                                <span class="d-flex">
                                    <h5>
                                        <?php 
                                            if($userResultTwo){
                                                $user = mysqli_fetch_assoc($userResultTwo);
                                                echo $user['name']; 
                                            }
                                        ?>
                                    </h5>
                                    :
                                    <p style="margin-left: 16px;">
                                            <?php echo $comment['text']; ?>
                                    </p>
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php
    }
    else
    {
        echo "Product not found";
    }
}
else
{
    echo "Something Went Wrong";
}
 include('includes/footer.php'); ?>


<script>
var focusedButton = null;
$(document).on('click', '.checkout', (e) => {
    var qty = $('.input-qty').val();
    // get the selected size from the button
    var prod_id = getFocusedButtonValue();
    if(prod_id == undefined){
        alertify.error("Select Product Size");
        return;
    }
    window.location.href = `checkout.php?product=${prod_id}&qty=${parseInt(qty)}`;
})

$(document).on('click','.AddTooCart-btn', function (e) {
    
    e.preventDefault();

    var qty = $(this).closest('.product_data').find('.input-qty').val();
    var prod_id = getFocusedButtonValue();
    if(prod_id != undefined){
        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id" : prod_id,
                "prod_qty" : qty,
                "scope" : "add",
            },
            success: function (response) {
                if(response == 201)
                {
                    alertify.success("Product Added To Cart");
    
                }
                else if(response == "existing")
                {
                    alertify.success("Cart Item Updated!");
                }
                else if(response == 401)
                {
                    alertify.success("Login To Continue");
    
                }
                else if(response == 500)
                {
                    alertify.success("Something Went Wrong");
    
                }
                
            }
        });
    }else {
        alertify.error("Select Product Size");
    }
    
});

$('.size-button').click(function() {
    focusedButton = $(this); // Store the clicked button
    var newPrice = $(this).data('selling-price');
    var newQty = $(this).data('stock');

    console.log(newQty);
    if(newQty == 0){
        $('#stock-display').css('display', 'block');
        alertify.error("Out of Stock");

        // disable the add to cart button and the checkout button
        $('#AddTooCart-btn').attr('disabled', true);
        $('#checkout').attr('disabled', true);
        let outOfStock = "<label class=\"btn btn-danger text-white\">Out of stock</label><br>";
        $('#stock-display').html(outOfStock);
    }else{
        // check if stock-dsplay is showing out of stock
        if($('#stock-display').html() == "<label class=\"btn btn-danger text-white\">Out of stock</label><br>"){
            let stockHTML = `<label  class = "btn btn-warning text-white">Limited Stock</label><span class="ms-1 fs-5 fw-bold">:</span>
                                        <span class="ms-1 fw-bold mt-2 fs-4" id="prod_stock"><?= $product['qty'];?></span>`;
            $('#stock-display').html(stockHTML);
            $('#AddTooCart-btn').attr('disabled', false);
            $('#checkout').attr('disabled', false);
        }
        $('#stock-display').css('display', 'block');
        $('#prod_stock').text(newQty);
    }
    $('#price').text(newPrice + '.00');
});

function getFocusedButtonValue() {
    if (focusedButton) {
        var value = focusedButton.val();
        return value;
    } else {
        console.log('No button is focused.');
        return undefined;
    }
}
</script>