<?php
include('functions/userfunctions.php');
include('includes/header.php');

if(isset($_GET['product']))
{
    $product_slug = $_GET['product'];
    $product_data = getSlugActive("products", $product_slug);
    $product = mysqli_fetch_array($product_data);

    $product_reviews = getProductReviews($product['id']);

    


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
                                <div class="col-md-3">
                                <?php 
                                if($product['qty'] > 0)
                                {
                                    ?>
                                        <label  class = "btn btn-warning text-white">Limited Stock</label><span class="ms-1 fs-5 fw-bold">:</span>
                                        <span class="ms-1 fw-bold mt-2 fs-4"><?= $product['qty'];?></span>
                                    
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
                                <div class="col-md-2 mt-1 text-end">
                                <button id="smallBtn" type="button" name="size" value="SMALL" class="btn btn-outline-dark btn-sm custom-hover-color modal-button" style="margin-right: -10px;" data-bs-toggle="modalsize" data-bs-target="#exampleSize">Small</button> 
                                </div>
                                <div class="col-md-1 mt-1 text-end">
                                <button id="mediumBtn" type="button" name="size" value="MEDIUM" class="btn btn-outline-dark btn-sm custom-hover-color modal-button" style="margin-right: 80%;" data-bs-toggle="modalsize" data-bs-target="#exampleSize">Medium</button> 
                                </div>
                                <div class="col-md-1 mt-1 text-end">
                                <button id="largeBtn" type="button" name="size" value="LARGE" class="btn btn-outline-dark btn-sm custom-hover-color modal-button" style="margin-left: 30%;" data-bs-toggle="modalsize" data-bs-target="#exampleSize">Large</button> 
                                </div>
                                <div class="col-md-1 mt-1 text-end">
                                <button id="xlBtn" type="button" name="size" value="XL" class="btn btn-outline-dark btn-sm custom-hover-color modal-button" style="margin-left: 20%;" data-bs-toggle="modalsize" data-bs-target="#exampleSize">XL</button> 
                                </div>
                                <input type="hidden" id="selectedSize" name="selectedSize">
                            <div class="row">
                            <div class="col-md-3 mt-4">
                                    <div class="input-group mb-3" style = "width:130px">
                                        <button class="input-group-text decrement-btn">-</button>
                                        <input type="text" class="form-control input-qty text-center bg-white" value = "1" disabled>
                                        <button class="input-group-text increment-btn">+</button>
                                    </div>                                                                                   
                                </div>
                                <div class="col-md-3 mt-4 text-end">
                                    <h4>₱ <span class ="text-success fw-bold"><?= $product['selling_price']?>.00</span></h4>
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
                                                <button class = "btn btn-success px-4 AddTooCart-btn" value="<?= $product['id']?>"><i class = "fa fa-shopping-cart me-2"></i>Add to Cart</button>
                                            
                        
                                            <?php 

                                        }
                                        else
                                        {
                                            ?>
                                            <?php 
                                        }   
                                    ?>   
                                        <div class="float-end">
                                            <a href="cart.php" class="btn btn-info"><i class="fa fa-money"></i> Proceed to Checkout</a>
                                        </div>    
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