<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php');
?>

<div class="container">
    <div class="row">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header bg-info">
                   <h4 class="text-white">Add Products
                   <a href="products.php" class = "btn btn-warning float-end"><i class="fa fa-reply me-1"></i>Back</a>
                   </h4>
               </div>
               <div class="card-body">
                   <form action="code.php" method="POST" enctype="multipart/form-data">
                   <div class="row">
                        <div class="col-md-12">
                            <label class ="mb-0 text-dark fw-bold" for="">Select Product Sales</label>
                            <select name = "category_id" class="form-select mb-2 ">
                                <option readonly selected hidden selected>Collection</option>                                                       
                                <?php
                                        $categories = getAll("categories");

                                        if (mysqli_num_rows($categories) > 0) {
                                            foreach ($categories as $item) {
                                                ?>
                                                <option  value="<?= $item['id']; ?>"><?= $item['slug']; ?></option>
                                                <?php
                                            }
                                        } else {
                                            echo "No category available";
                                        }
                                        ?>
                            </select>
                       </div>
                       <div class="col-md-12">
                            <label class ="mb-0 text-dark fw-bold" for="">Select Inventory</label>
                            <select name = "inventory" id="inventory" class="form-select mb-2 " onchange="getData()">
                                <option readonly selected hidden selected>Inventory</option>                                                       
                                <?php
                                        $inventories = getAll("inventory");

                                        if (mysqli_num_rows($inventories) > 0) {
                                            foreach ($inventories as $inventory) {
                                                ?>
                                                <option  value="<?= $inventory['id']; ?>"><?= $inventory['name']; ?></option>
                                                <?php
                                            }
                                        } else {
                                            echo "No inventory available";
                                        }
                                        ?>
                            </select>
                       </div>
                       <div class="col-md-6">
                            <label class="mb-0 text-dark fw-bold" for="">Name</label>
                            <input type="text" required name="name" id="name" readonly placeholder="Enter name" class="form-control mb-2" autocomplete="off" pattern="[A-Za-z\s]+" title="Please enter alphabetic characters only (whitespace allowed)" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '').toUpperCase();">
                        </div>
                       <div class="col-md-6">
                            <label class ="mb-0 text-dark fw-bold" for="">Tag No.</label>
                            <input type="text" required name = "slug" placeholder = "Enter Tag #" class="form-control mb-2" autocomplete="off" oninput="disableSpecialCharacters(this)">
                       </div>
                        <div class="col-md-6">
                            <label class="mb-0 text-dark fw-bold" >Choose Size</label>
                                <input type="text" required name="size" id="size" readonly placeholder="Enter name" class="form-control mb-2" autocomplete="off" pattern="[A-Za-z\s]+" title="Please enter alphabetic characters only (whitespace allowed)" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '').toUpperCase();">
                        </div>
                        <div class="col-md-6">
                                    <label class ="mb-0 text-dark fw-bold" for="">Quantity</label>
                                    <input type="number" required name = "qty" readonly  id="qty" placeholder = "Enter quantity" class="form-control mb-2" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        </div>
                       <div class="col-md-6">
                            <label class ="mb-0 text-dark fw-bold" for="">Original Price</label>
                            <input type="number" required name = "original_price" placeholder = "Enter original price" class="form-control mb-2" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                       </div>
                       <div class="col-md-6">
                            <label class ="mb-0 text-dark fw-bold" for="">Selling Price</label>
                            <input type="number" required name = "selling_price" placeholder = "Enter selling price" class="form-control mb-2" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                       </div>
                       <div class="col-md-12">
                           <label class ="mb-0 text-dark fw-bold" for="">Description</label>
                           <textarea row = "3" required name = "description" placeholder = "Enter description" class="form-control mb-2" autocomplete="off"></textarea>
                       </div>
                       <div class="row">
                        <div class="col-md-6">
                                    <label class ="mb-0 text-dark fw-bold" for="">Upload Image</label>
                                    <input type="file" required name = "image" class="form-control mb-2"></textarea>
                        </div>
                            <div class="col-md-3">
                                <br>
                                    <label class ="mb-0 text-dark fw-bold" for="">Hidden</label>
                                    <input type="checkbox" name = "status">
                            </div>
                            <div class="col-md-3">
                                <br>
                                    <label class ="mb-0 text-dark fw-bold" for="">VIsible</label>
                                    <input type="checkbox" name = "trending">
                            </div>
                       </div>
                       <div class="col-md-12">  
                           <label class ="mb-0 text-dark fw-bold" for="">Tagging</label>
                           <textarea row = "3" required name = "meta_keywords" placeholder = "Enter keywords" class="form-control mb-2" autocomplete="off"></textarea>
                       </div>
                       <div class="col-md-12">
                           <button type = "submit" class = "btn btn-success" name = "add_prod_btn"><i class="fa fa-save me-1"></i>Save</button>
                       </div>
                       </form>
               </div>
           </div>
       </div>
    </div>



    <?php include('includes/footer.php'); ?>
    
