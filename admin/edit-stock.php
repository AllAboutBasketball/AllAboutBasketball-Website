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

                $stocks = getByID("stock", $id);

                if(mysqli_num_rows($stocks) > 0)
                {
                    $data = mysqli_fetch_array($stocks);
                    ?>
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="text-white">Edit Stock
                                    <a href="stock.php" class = "btn btn-warning float-end"><i class="fa fa-reply me-1"></i>Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                    <input type="hidden" name="stock_id" value="<?= $data['id'];?>">
                                    <div class="col-md-6">
                                            <label class ="mb-0 text-dark fw-bold" for="">Select Inventory Name</label>
                                            <select name = "inv_id" class="form-select mb-2">
                                            <option disabled selected hidden>Choose</option>                                                     
                                            <?php
                                                $stocks = getAll("inventory");

                                                if(mysqli_num_rows($stocks) > 0) {
                                                    foreach ($stocks as $item) {
                                                        ?>
                                                        <option value="<?= $item['supplier_id']; ?>"><?= $item['name']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    echo "No Inventory available";
                                                }
                                            ?>
                                            </select>
                                    </div>
                                    <div class="col-md-6">
                                <label class="mb-0 text-dark fw-bold" for="">Present Product Date</label>
                                <br>
                                <input type="datetime-local" name="date_time_local" value = "<?= $data['date_time'];?>" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class ="mb-0 text-dark fw-bold" for="">Category</label>
                                    <select name = "type" class="form-select mb-2 ">
                                        <option readonly selected hidden selected><?= $data['type'];?></option>                                                       
                                        <?php
                                                $stocks = getAll("inventory");

                                                if (mysqli_num_rows($stocks) > 0) {
                                                    foreach ($stocks as $item) {
                                                        ?>
                                                        <option  value="<?= $item['type']; ?>"><?= $item['type']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    echo "No category available";
                                                }
                                                ?>
                                    </select>
                             </div>
                             <div class="col-md-6">
                                <label class ="mb-0 text-dark fw-bold" for="">Size</label>
                                    <select name = "size" class="form-select mb-2 ">
                                        <option readonly selected hidden selected><?= $data['size'];?></option>                                                       
                                        <?php
                                                $stocks = getAll("inventory");

                                                if (mysqli_num_rows($stocks) > 0) {
                                                    foreach ($stocks as $item) {
                                                        ?>
                                                        <option  value="<?= $item['size']; ?>"><?= $item['size']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    echo "No Size available";
                                                }
                                                ?>
                                    </select>
                             </div>
                             <div class="col-md-6">
                                <label class ="mb-0 text-dark fw-bold" for="">Quantity</label>
                                    <select name = "qty" class="form-select mb-2 ">
                                        <option readonly selected hidden selected><?= $data['qty'];?></option>                                                       
                                        <?php
                                                $stocks = getAll("inventory");

                                                if (mysqli_num_rows($stocks) > 0) {
                                                    foreach ($stocks as $item) {
                                                        ?>
                                                        <option  value="<?= $item['qty']; ?>"><?= $item['qty']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    echo "No Qty available";
                                                }
                                                ?>
                                    </select>
                             </div>
                             <div class="col-md-6">
                                <label class ="mb-0 text-dark fw-bold" for="">Status</label>
                                    <select name = "status" class="form-select mb-2 ">
                                        <option readonly selected hidden selected><?= $data['status'];?></option>                                                       
                                        <?php
                                                $stocks = getAll("inventory");

                                                if (mysqli_num_rows($stocks) > 0) {
                                                    foreach ($stocks as $item) {
                                                        ?>
                                                        <option  value="<?= $item['status']; ?>"><?= $item['status']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    echo "No category available";
                                                }
                                                ?>
                                    </select>
                             </div>
                            <div class="col-md-6">
                                <label class="mb-0 text-dark fw-bold" for="">Price</label>
                                <input type="number"  name="price" value = "<?= $data['price'];?>" placeholder="Enter Price" class="form-control mb-2" autocomplete="off" oninput="limitDigits(this, 6)">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 text-dark fw-bold" for="">Remarks</label>
                                <input type="text"  name="remarks" value = "<?= $data['remarks'];?>" placeholder="Enter Remarks" class="form-control mb-2" autocomplete="off" pattern="[A-Za-z\s]+" title="Please enter alphabetic characters only (whitespace allowed)" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                            </div>
                            <div class="col-md-12">
                                    <label class ="mb-0 text-dark fw-bold" for="">Upload Image</label>
                                    <input type="hidden" name="old_image" value = "<?= $data['image'];?>">
                                    <input type="file" name = "image" class="form-control mb-2"></input>
                                     <label class ="mb-0 text-dark fw-bold" for="">Current Image</label>
                                    <img src="../uploads/<?= $data['image'];?>" alt="Product image" height="50px" width="50px">
                                </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success" name="update_stock_btn"><i class="fa fa-save me-1"></i>Save</button>
                                            </div>
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