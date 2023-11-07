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
                    $category = getByID("categories", $id);

                    if(mysqli_num_rows($category) > 0)
                    {
                        $data = mysqli_fetch_array($category);

                        ?>
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h4 class="text-white">Edit Category
                                    <a href="category.php" class = "btn btn-warning float-end"><i class="fa fa-reply me-1"></i>Back</a>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="" class="mb-0 text-dark fw-bold">Product Sale</label>
                                                <input type="hidden" name="category_id" value="<?= $data['id'] ?>">
                                                <select required name="slug" class="form-select mb-2">
                                                    <option readonly hidden value="<?= $data['slug'] ?>"><?= $data['slug'] ?></option>
                                                    <option value="LIMITED OFFER">LIMITED OFFER</option>
                                                    <option value="HOT SALES">HOT SALES</option>
                                                    <!-- Add more options as needed -->
                                                </select>
                                            </div>    
                    
                                            <div class="col-md-6">
                                            <label for="" class="mb-0 text-dark fw-bold">Collection</label>
                                                <select required name="name" class="form-select mb-2">
                                                    <option readonly hidden value="<?= $data['name'] ?>"><?= $data['name'] ?></option>
                                                    <option value="TSHIRT">TSHIRT</option>
                                                    <option value="SHORT">SHORT</option>
                                                    <option value="ACCESSORIES">ACCESSORIES</option>
                                                    <option value="LIMITED">LIMITED RANDOM DESIGN</option>
                                                    <!-- Add more options as needed -->
                                                </select>
                                             </div>
                                        <div class="col-md-12">
                                            <label for="" class ="mb-0 text-dark fw-bold">Description</label>
                                            <textarea row = "3" name = "description" placeholder = "Enter description" class="form-control"><?= $data['description']?></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="" class ="mb-0 text-dark fw-bold">Upload Image</label>
                                            <input type="file" name = "image" class="form-control">
                                            
                                            <label for="" class ="mb-0 text-danger fw-bold"> <strong> Current Image </strong></label>
                                            <input type="hidden" name="old_image" value = "<?= $data['image']?>">
                                            <img src="../uploads/<?= $data['image']?>" width="50px" height="50px" alt="">   
                                        </div>
                                        <div class="col-md-12">  
                                            <label for="" class ="mb-0 text-dark fw-bold">Tagging</label>
                                            <textarea row = "3" name = "meta_keywords" placeholder = "Enter meta keywords" class="form-control"><?= $data['meta_keywords']?></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class ="mb-0 text-dark fw-bold">Hidden</label>
                                            <input type="checkbox" <?= $data['status'] ? "checked":""?> name = "status">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class ="mb-0 text-dark fw-bold">Visible</label>
                                            <input type="checkbox" <?= $data['popular'] ? "checked":""?> name = "popular">
                                        </div>
                                        <div class="col-md-12">
                                            <button type = "submit" class = "btn btn-success" name = "update_cate_btn"><i class="fa fa-refresh me-1"></i>Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php
                    }
                    else
                    {
                        echo "Category not Found";
                    }
                }
                else
                {
                    echo "ID Missing From URL";
                }
                  ?>
         </div>
     </div>
 </div>



    <?php include('includes/footer.php'); ?>