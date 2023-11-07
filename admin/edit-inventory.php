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

                $inventories = getByID("inventory", $id);

                if(mysqli_num_rows($inventories) > 0)
                {
                    $data = mysqli_fetch_array($inventories);
                    ?>
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="text-white">Edit Inventory
                                    <a href="inventory.php" class = "btn btn-warning float-end"><i class="fa fa-reply me-1"></i>Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                    <input type="hidden" name="inventory_id" value = "<?= $data['id'];?>">
                                    <div class="col-md-12">
                                            <label class ="mb-0 text-dark fw-bold" for="">Select Supplier</label>
                                            <select name = "supplier_id" class="form-select mb-2">
                                            <option readonly selected hidden>Choose</option>                                                     
                                            <?php
                                                $suppliers = getAll("supplier");

                                                if(mysqli_num_rows($suppliers) > 0) {
                                                    foreach ($suppliers as $item) {
                                                        $cperson = str_replace('+', ' ', $item['cperson']);
                                                        ?>
                                                        <option value="<?= $item['id']; ?>" <?= $data['supplier_id'] == $item['id']?'selected':'' ?>><?= $item['cperson']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    echo "No Supplier available";
                                                }
                                            ?>
                                            </select>
                                    </div>
                                        <input type="hidden" name="inv_id" value = "<?= $data['id'];?>">
                            <div class="col-md-6">
                                <label class="mb-0 text-dark fw-bold" for="">Name</label>
                                <input type="text"  name="name" value = "<?= $data['name'];?>" placeholder="Enter Name" class="form-control mb-2" autocomplete="off" pattern="[A-Za-z\s]+" title="Please enter alphabetic characters only (whitespace allowed)" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '').toUpperCase();">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 text-dark fw-bold" for="">Product Date</label>
                                <br>
                                <input type="datetime-local" name="date_time_local" value = "<?= $data['date_time'];?>" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 text-dark fw-bold" for="">Quantity</label>
                                <input type="number"  name="qty" value = "<?= $data['qty'];?>" placeholder="Enter quantity" class="form-control mb-2" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 text-dark fw-bold" for="">Price</label>
                                <input type="number"  name="price" value = "<?= $data['price'];?>" placeholder="Enter Price" class="form-control mb-2" autocomplete="off" oninput="limitDigits(this, 6)">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 text-dark fw-bold" for="">Choose Size</label>
                                <select  name="size" class="form-select mb-2">
                                    <option readonly selected hidden><?= $data['size'];?></option>
                                    <option value="SMALL">SMALL</option>
                                    <option value="MEDIUM">MEDIUM</option>
                                    <option value="LARGE">LARGE</option>
                                    <option value="XL">XL</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 text-dark fw-bold" for="">Type</label>
                                <select  name="type" class="form-select mb-2">
                                    <option readonly selected hidden><?= $data['type'];?></option>
                                    <option value="TSHIRT">TSHIRT</option>
                                    <option value="SHORT">SHORT</option>
                                    <option value="ACCESSORIES">ACCESSORIES</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 text-dark fw-bold" for="">Status</label>
                                <select  name="status" class="form-select mb-2">
                                    <option readonly selected hidden><?= $data['status'];?></option>
                                    <option value="ACTIVE">ACTIVE</option>
                                    <option value="INACTIVE">INACTIVE</option>
                                </select>
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
                                                <button type="submit" class="btn btn-success" name="update_inv_btn"><i class="fa fa-save me-1"></i>Save</button>
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