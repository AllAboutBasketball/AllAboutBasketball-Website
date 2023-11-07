<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php');



?>

<div class="container">
    <div class="row">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header bg-info">
                   <h4 class="text-white">Add Collection
                   <a href="category.php" class = "btn btn-warning float-end"><i class="fa fa-reply me-1"></i>Back</a>
                   </h4>
               </div>
               <div class="card-body">
                   <form action="code.php" method="POST" enctype="multipart/form-data">
                   <div class="row">
                       <div class="col-md-6">
                            <label class="mb-0 text-dark fw-bold" for="">Product Sales</label>
                            <select required name="slug" required class="form-select mb-2">
                                <option readonly selected hidden>Choose</option>
                                <option value="LIMITED OFFER">LIMITED OFFER</option>
                                <option value="HOT SALES">HOT SALES</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="mb-0 text-dark fw-bold" for="">Collection</label>
                            <select required name="name" required class="form-select mb-2">
                                <option readonly selected hidden>Choose</option>
                                <option value="TSHIRT">TSHIRT</option>
                                <option value="SHORT">SHORT</option>
                                <option value="ACCESSORIES">ACCESSORIES</option>
                                <option value="LIMITED">LIMITED RANDOM DESIGN</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                       <div class="col-md-12">
                           <label class ="mb-0 text-dark fw-bold" for="">Description</label>
                           <textarea row = "3" required name = "description" placeholder = "Enter description" class="form-control mb-2" autocomplete="off"></textarea>
                       </div>
                       <div class="col-md-12">
                           <label class ="mb-0 text-dark fw-bold" for="">Upload Image</label>
                           <input type="file"  required name = "image" class="form-control mb-2"></textarea>
                       </div>
                       <div class="col-md-12">  
                           <label for="" class="text-dark fw-bold">Tagging</label>
                           <textarea row = "3"  required name = "meta_keywords" placeholder = "Enter keywords" class="form-control mb-2" autocomplete="off"></textarea>
                       </div>
                       <div class="col-md-3">
                                    <label class ="mb-0 text-dark fw-bold" for="">Hidden</label>
                                    <input type="checkbox" name = "status">
                            </div>
                            <div class="col-md-3">
                                
                                    <label class ="mb-0 text-dark fw-bold" for="">Visible</label>
                                    <input type="checkbox" name = "popular">
                            </div>
                       <div class="col-md-12">
                           <button type = "submit" class = "btn btn-success mt-2" name = "add_cate_btn"><i class="fa fa-save me-1"></i>Save</button>
                       </div>
                       </form>
               </div>
           </div>
       </div>
    </div>



    <?php include('includes/footer.php'); ?>