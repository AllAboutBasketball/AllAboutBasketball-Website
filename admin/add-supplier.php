<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php');
?>


<div class="container">
    <div class="row">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header bg-info">
                   <h4 class="text-white">Add Supplier
                   <a href="supplier.php" class = "btn btn-warning float-end"><i class="fa fa-reply me-1"></i>Back</a> 
                   </h4>
               </div>
               <div class="card-body">
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="mb-0 text-dark fw-bold" for=""> Name</label>
                                            <input type="text" required name="cname" placeholder="Enter Supplier Name" class="form-control mb-2" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="mb-0 text-dark fw-bold" for="">Contact No.</label>
                                            <input type="tel" required name="phone" placeholder="Enter Contact" class="form-control mb-2" autocomplete="off" oninput="checkPhone(this)" maxlength="11">
                                        </div>
                                    <div class="col-md-6">
                                        <label class="mb-0 text-dark fw-bold" for="">Contact Person</label>
                                        <input type="text" required name="cperson" placeholder="Enter Fullname" class="form-control mb-2" autocomplete="off" pattern="[A-Za-z\s]+" title="Please enter alphabetic characters only (whitespace allowed)" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                                    </div>
                                        <div class="col-md-6">
                                            <label class="mb-0 text-dark fw-bold" for="">Email</label>
                                            <input type="email" required name="email" placeholder="Enter email" class="form-control mb-2" autocomplete="off" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="mb-0 text-dark fw-bold" for="">Product</label>
                                                <select required name="product" required class="form-select mb-2" required>
                                                    <option disabled selected hidden>Choose</option>
                                                    <option value="TSHIRT">TSHIRT</option>
                                                    <option value="SHORT">SHORT</option>
                                                    <option value="ACCESSORIES">ACCESSORIES</option>
                                                    <!-- Add more options as needed -->
                                                </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="mb-0 text-dark fw-bold" for="">Cost</label>
                                            <input type="number" required name="cost" placeholder="Enter Cost" class="form-control mb-2" autocomplete="off" required oninput="checkInput(this)" maxlength="6">
                                        </div>
                                        <!-- <div class="col-md-3">
                                            <label class="mb-0 text-dark fw-bold" for="">Quantity</label>
                                            <input type="number" required name="qty" placeholder="Enter quantity" class="form-control mb-2" autocomplete="off" required onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                        </div> -->
                                        <div class="col-md-6">
                                            <label class="mb-0 text-dark fw-bold" for="">Status</label>
                                                <select id="" name="status" class="form-select mb-2">
                                                    <option readonly selected hidden>Choose</option>
                                                    <option value="ACTIVE">ACTIVE</option>
                                                    <option value="INACTIVE">INACTIVE</option>
                                                </select>
                                        </div>
                                        <div class="col-md-6">
                                                <label class="mb-0 text-dark fw-bold" for=""> Product Supplied Date</label>
                                                <br>
                                                <input type="datetime-local"  name="date_time_local" id="product-supplied" class="form-control">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="mb-0 text-dark fw-bold" for="" required>Upload Image</label>
                                            <input type="file" required name="image" class="form-control mb-2">
                                        </div>
                                        <!-- <div class="col-md-6">
                                                <label class="mb-0 text-dark fw-bold" for=""> Product Supplied Date</label>
                                                <br>
                                                <input type="datetime-local" required name="date_time_local" id="product-supplied" class="form-control">
                                            </div> -->
                                        <!-- <div class="col-md-12">
                                            <label class="mb-0 text-dark fw-bold" for="">Description</label>
                                            <textarea row="3" required name="description" placeholder="Enter description" class="form-control mb-2" autocomplete="off" required></textarea>
                                        </div> -->

                                        <!-- <div class="col-md-6">
                                            <label class="mb-5 text-dark fw-bold" for=""> Product Supplied Date</label>
                                            <input type="datetime-local" required name="date_time_local" id="set-time" class="form-control mb">
                                        </div> -->
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-success" name="add_supp_btn"><i class="fa fa-save me-1"></i>Save</button>
                                        </div>
                                    </div>
                    </form>
               </div>
           </div>
       </div>
    </div>



    <?php include('includes/footer.php'); ?>