<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php');
?>

<div class="container">
    <div class="row">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header bg-info">
                   <h4 class="text-white">Add Inventory
                   <a href="inventory.php" class = "btn btn-warning float-end"><i class="fa fa-reply me-1"></i>Back</a>
                   </h4>
               </div>
               <div class="card-body">
               <form action="code.php" method="POST" enctype="multipart/form-data">
                     <div class="row">
                     <div class="col-md-12">
                            <label class ="mb-0 text-dark fw-bold" for="">Select Supplier</label>
                            <select name = "supplier_id" class="form-select mb-2 ">
                                <option disabled selected hidden selected>Choose</option>                                                       
                                <?php
                                        $suppliers = getAll("supplier");

                                        if (mysqli_num_rows($suppliers) > 0) {
                                            foreach ($suppliers as $item) {
                                                ?>
                                                <option  value="<?= $item['id']; ?>"><?= $item['cperson']; ?></option>
                                                <?php
                                            }
                                        } else {
                                            echo "No category available";
                                        }
                                        ?>
                            </select>
                       </div>
                            <div class="col-md-6">
                                <label class="mb-0 text-dark fw-bold" for="">Name</label>
                                <input type="text" required name="name" placeholder="Enter Name" class="form-control mb-2" autocomplete="off" pattern="[A-Za-z\s]+" title="Please enter alphabetic characters only (whitespace allowed)" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '').toUpperCase();">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 text-dark fw-bold" for="">Product Date</label>
                                <br>
                                <input type="datetime-local" name="date_time_local" id="stock" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 text-dark fw-bold" for="">Category</label>
                                <select required name="type" class="form-select mb-2">
                                    <option disabled selected hidden>Choose</option>
                                    <option value="TSHIRT">TSHIRT</option>
                                    <option value="SHORT">SHORT</option>
                                    <option value="ACCESSORIES">ACCESSORIES</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 text-dark fw-bold" for="">Size</label>
                                <select required name="size" class="form-select mb-2">
                                    <option disabled selected hidden>Choose</option>
                                    <option value="SMALL">SMALL</option>
                                    <option value="MEDIUM">MEDIUM</option>
                                    <option value="LARGE">LARGE</option>
                                    <option value="XL">XL</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 text-dark fw-bold" for="">Quantity</label>
                                <input type="number" required name="qty" placeholder="Enter quantity" class="form-control mb-2" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 text-dark fw-bold" for="">Price</label>
                                <input type="number" required name="price" placeholder="Enter Price" class="form-control mb-2" autocomplete="off" oninput="limitDigits(this, 6)">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 text-dark fw-bold" for="">Status</label>
                                <select required name="status" class="form-select mb-2">
                                    <option disabled selected hidden>Choose</option>
                                    <option value="ACTIVE">ACTIVE</option>
                                    <option value="INACTIVE">INACTIVE</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 text-dark fw-bold" for="">Remarks</label>
                                <input type="text" required name="remarks" placeholder="Enter Remarks" class="form-control mb-2" autocomplete="off" pattern="[A-Za-z\s]+" title="Please enter alphabetic characters only (whitespace allowed)" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0 text-dark fw-bold" for="">Upload Image</label>
                                <input type="file" name="image" class="form-control mb-2">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success" name="add_inv_btn"><i class="fa fa-save me-1"></i>Save</button>
                            </div>
                        </div>
                    </form>
               </div>
           </div>
       </div>
    </div>



    <?php include('includes/footer.php'); ?>