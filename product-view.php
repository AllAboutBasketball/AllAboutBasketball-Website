<?php
include('functions/userfunctions.php');
include('includes/header.php');

if(isset($_GET['product']))
{
    $product_slug = $_GET['product'];
    $product_data = getSlugActive("products", $product_slug);
    $product = mysqli_fetch_array($product_data);
    

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