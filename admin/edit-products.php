<?php

include('../middleware/adminMiddleware.php'); 

include('includes/header.php');


?>

<div class="container">
    <div class="row">
       <div class="col-md-12">
           <?php 
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                $product = getByID("products", $id);

                if(mysqli_num_rows($product) > 0)
                {
                    $data = mysqli_fetch_array($product);
                    ?>
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="text-white">Edit Product
                                    <a href="products.php" class = "btn btn-warning float-end"><i class="fa fa-reply me-1"></i>Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                        <div class="col-md-12">
                                            <label class ="mb-0 text-dark fw-bold" for="">Select Colllection</label>
                                            <select name = "category_id" class="form-select mb-2">
                                            <option readonly selected hidden>Choose</option>                                                     
                                            <?php
                                                $categories = getAll("categories");

                                                if(mysqli_num_rows($categories) > 0) {
                                                    foreach ($categories as $item) {
                                                        $slug = str_replace('+', ' ', $item['slug']);
                                                        ?>
                                                        <option value="<?= $item['id']; ?>" <?= $data['category_id'] == $item['id']?'selected':'' ?>><?= $item['slug']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    echo "No category available";
                                                }
                                            ?>
                                            </select>
                                    </div>
                                    <input type="hidden" name="product_id" value = "<?= $data['id'];?>">
                                    <div class="col-md-6">
                                        <label class="mb-0 text-dark fw-bold" for="">Name</label>
                                        <input type="text" required name="name" value = "<?= $data['name'];?>" placeholder="Enter category name" class="form-control mb-2" autocomplete="off" pattern="[A-Za-z\s]+" title="Please enter alphabetic characters only (whitespace allowed)" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '').toUpperCase();">
                                    </div>
                                    <div class="col-md-6">
                                            <label class ="mb-0 text-dark fw-bold" for="">Tag No.</label>
                                            <input type="text" required name = "slug" value = "<?= $data['slug'];?>" placeholder = "Enter slug" class="form-control mb-2" oninput="disableSpecialCharacters(this)" autocomplete="off">
                                    </div>
                                    <div class="col-md-6">
                                            <label class="mb-0 text-dark fw-bold" for="">Choose Size</label>
                                            <select required name="size" required class="form-select mb-2">
                                            <option readonly hidden value="<?= $data['size'] ?>"><?= $data['size'] ?></option>
                                                    <option value="ALL AVAILABLE">ALL AVAILABLE</option>
                                                    <option value="SMALL">SMALL</option>
                                                    <option value="MEDIUM">MEDIUM</option>
                                                    <option value="LARGE">LARGE</option>
                                                    <option value="XL">XL</option>
                                                    <!-- Add more options as needed -->
                                             </select>
                                    </div>
                                    <div class="col-md-6">
                                                    <label class ="mb-0 text-dark fw-bold" for="">Quantity</label>
                                                    <input type="number" required name = "qty" value = "<?= $data['qty'];?>"placeholder = "Enter quantity" class="form-control mb-2" autocomplete="off">
                                            </div>
                                 
                                    <div class="col-md-6">
                                            <label class ="mb-0 text-dark fw-bold" for="">Original Price</label>
                                            <input type="text" required name = "original_price" value = "<?= $data['original_price'];?>" placeholder = "Enter original price" class="form-control mb-2" autocomplete="off">
                                    </div>
                                    <div class="col-md-6">
                                            <label class ="mb-0 text-dark fw-bold" for="">Selling Price</label>
                                            <input type="text" required name = "selling_price" value = "<?= $data['selling_price'];?>"placeholder = "Enter selling price" class="form-control mb-2" autocomplete="off">
                                    </div>
                                    <div class="col-md-12">
                                        <label class ="mb-0 text-dark fw-bold" for="">Description</label>
                                        <textarea row = "3" required name = "description" placeholder = "Enter description" class="form-control mb-2" autocomplete="off"><?= $data['description'];?></textarea>
                                    </div>
                                  
                                    <div class="row">
                                            <div class="col-md-6">
                                                <label class ="mb-0 text-dark fw-bold" for="">Upload Image</label>
                                                <input type="hidden" name="old_image" value = "<?= $data['image'];?>">
                                                <input type="file" name = "image" class="form-control mb-2"></textarea>
                                                <label class ="mb-0 text-dark fw-bold" for="">Current Image</label>
                                                <img src="../uploads/<?= $data['image'];?>" alt="Product image" height="50px" width="50px">
                                            </div>
                                            <div class="col-md-3">
                                                <br>
                                                    <label class ="mb-0 text-dark fw-bold" for="">Hidden</label>
                                                    <input type="checkbox" name = "status" <?= $data['status'] == '0'?'':'checked' ?>>
                                            </div>
                                            <div class="col-md-3">
                                                <br>
                                                    <label class ="mb-0 text-dark fw-bold" for="">Visible</label>
                                                    <input type="checkbox" name = "trending" <?= $data['trending'] == '0'?'':'checked' ?>>
                                            </div>
                                    </div>
                                    <div class="col-md-12">  
                                        <label for="" class ="mb-0 text-dark fw-bold"> Tagging</label>
                                        <textarea row = "3" required name = "meta_keywords" placeholder = "Enter keywords" class="form-control mb-2" autocomplete="off"><?= $data['meta_keywords'];?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <button type = "submit" class = "btn btn-success" name = "update_prod_btn"><i class="fa fa-refresh me-1"></i>Update</button>
                                    </div>
                                    </form>
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
               echo "Id missing from url";
            }
           ?>
       </div>
    </div>
</div>



    <?php include('includes/footer.php'); ?>