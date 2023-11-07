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

                $suppliers = getByID("supplier", $id);

                if(mysqli_num_rows($suppliers) > 0)
                {
                    $data = mysqli_fetch_array($suppliers);
                    ?>
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="text-white">Edit Supplier
                                    <a href="supplier.php" class = "btn btn-warning float-end"><i class="fa fa-reply me-1"></i>Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="supplier_id" value = "<?= $data['id'];?>">
                                    <div class="col-md-6">
                                            <label class="mb-0 text-dark fw-bold" for=""> Name</label>
                                            <input type="text"  name="cname" value = "<?= $data['cname'];?>" placeholder="Enter Supplier Name" class="form-control mb-2" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-6">
                                                <label class="mb-0 text-dark fw-bold" for="">Contact No.</label>
                                                <input type="tel" required name="phone" value = "<?= $data['phone'];?>" placeholder="Enter Contact" class="form-control mb-2" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11">
                                            </div>
                                    <div class="col-md-6">
                                        <label class="mb-0 text-dark fw-bold" for="">Contact Person</label>
                                        <input type="text" required name="cperson" value = "<?= $data['cperson'];?>" placeholder="Enter Fullname" class="form-control mb-2" autocomplete="off" pattern="[A-Za-z\s]+" title="Please enter alphabetic characters only (whitespace allowed)" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                                    </div>
                                        <div class="col-md-6">
                                            <label class="mb-0 text-dark fw-bold" for="">Email</label>
                                            <input type="email" required name="email" value = "<?= $data['email'];?>" placeholder="Enter email" class="form-control mb-2" autocomplete="off" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="mb-0 text-dark fw-bold" for="">Product</label>
                                                <select  name="product"  class="form-select mb-2" >
                                                    <option readonly value = "<?= $data['product'];?>" selected hidden><?= $data['product'];?></option>
                                                    <option value="TSHIRT">TSHIRT</option>
                                                    <option value="SHORT">SHORT</option>
                                                    <option value="ACCESSORIES">ACCESSORIES</option>
                                                    <!-- Add more options as needed -->
                                                </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="mb-0 text-dark fw-bold" for="">Cost</label>
                                            <input type="number" name="cost" value="<?= $data['cost']; ?>" placeholder="Enter Cost" class="form-control mb-2" autocomplete="off" oninput="checkInput(this)" maxlength="6">
                                        </div>
                                        <!-- <div class="col-md-3">
                                            <label class="mb-0 text-dark fw-bold" for="">Quantity</label>
                                            <input type="number"  name="qty" placeholder="Enter quantity" class="form-control mb-2" autocomplete="off"  onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                        </div> -->
                                        <div class="col-md-6">
                                            <label class="mb-0 text-dark fw-bold" for="">Status</label>
                                                <select id="" name="status" class="form-select mb-2">
                                                    <option readonly selected hidden><?= $data['status'];?></option>
                                                    <option value="ACTIVE">ACTIVE</option>
                                                    <option value="INACTIVE">INACTIVE</option>
                                                </select>
                                        </div>
                                        <div class="col-md-6">
                                                <label class="mb-0 text-dark fw-bold" for=""> Product Supplied Date</label>
                                                <br>
                                                <input type="datetime-local"  name="date_time_local" value="<?= $data['date_time']; ?>" class="form-control">
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <label class="mb-0 text-dark fw-bold" for="">Description</label>
                                            <textarea row="3"  name="description" placeholder="Enter description" class="form-control mb-2" autocomplete="off" > <?= $data['description'];?></textarea>
                                        </div> -->
                                        <div class="col-md-12">
                                            <label class ="mb-0 text-dark fw-bold" for="">Upload Image</label>
                                            <input type="hidden" name="old_image" value = "<?= $data['image'];?>">
                                            <input type="file" name = "image" class="form-control mb-2"></input>
                                            <label class ="mb-0 text-danger fw-bold" for=""> <strong> Current Image  </strong> </label>
                                            <img src="../uploads/<?= $data['image'];?>" alt="Product image" height="50px" width="50px">
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <label class="mb-5 text-dark fw-bold" for=""> Product Supplied Date</label>
                                            <input type="datetime-local"  name="date_time_local" id="set-time" class="form-control mb">
                                        </div> -->
                                    <div class="col-md-12 mt-2">
                                        <button type = "submit" class = "btn btn-success" name = "update_supp_btn"><i class="fa fa-refresh me-1"></i>Update</button>
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