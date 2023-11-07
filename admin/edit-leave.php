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

                $leaves = getByID("app_leave", $id);

                if(mysqli_num_rows($leaves) > 0)
                {
                    $data = mysqli_fetch_array($leaves);
                    ?>
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="text-white">Edit Leave Application
                                    <a href="leave.php" class = "btn btn-warning float-end"><i class="fa fa-reply me-1"></i>Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="leave_id" value = "<?= $data['id'];?>">
                                <div class="row">
                                            <div class="col-md-6">
                                                <label class ="mb-0 text-dark fw-bold" for=""> Employee</label>
                                                <div class="border p-1 text-dark">
                                                    <?= $data['emp_name']; ?>
                                                </div>
                                            </div>
                                    <!-- <input type="hidden" name="product_id" value = "<?= $data['id'];?>"> -->
                            <div class="col-md-6">
                                <label class="mb-0 text-dark fw-bold" for="">Days</label>
                                <input readonly type="number" name="days" id="days" value = "<?= $data['days'];?>" placeholder="Enter Days" class="form-control mb-2" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            </div>
                            <div class="col-md-6">
                                 <label class="mb-0 text-dark fw-bold" for=""> Start Date</label>
                                <br>
                                 <input readonly type="date" name="select_date" value = "<?= $data['start_date'];?>" id="app-date" class="form-control">
                             </div>
                            <div class="col-md-6">
                                 <label class="mb-0 text-dark fw-bold" for=""> End Date</label>
                                <br>
                                 <input readonly type="date" name="end_date" id="app-end-date" value = "<?= $data['end_date'];?>" class="form-control">
                            </div>
                            <div class="col-md-6">
                                        <label class="mb-0 text-dark fw-bold" for="">Leave Type</label>
                                        <input type="text" readonly name="leave_type"  value = "<?= $data['leave_type'];?>" class="form-control mb-2" autocomplete="off" pattern="[A-Za-z\s]+" title="Please enter alphabetic characters only (whitespace allowed)" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                                    </div>
                            <div class="col-md-6">
                                        <label class="mb-0 text-dark fw-bold" for="">Remarks</label>
                                        <input type="text" readonly name="leave_type"  value = "<?= $data['remarks'];?>" class="form-control mb-2" autocomplete="off" pattern="[A-Za-z\s]+" title="Please enter alphabetic characters only (whitespace allowed)" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                            </div>
                        <div class="col-md-6">
                            <label class="mb-0 text-dark fw-bold" for="t">Status</label>
                            <select id="" name="leave_status" class="form-select mb-2">
                                    <option readonly selected hidden><?= $data['status'];?></option>
                                    <option value="APPROVED">APPROVED</option>
                                    <option value="DISSAPROVED">DISSAPROVED</option>
                                </select>
                        </div>
                            <div class="col-md-6">
                                <label class ="mb-0 text-dark fw-bold" for="">Upload Image</label>
                                 <input type="hidden" name="old_image" value = "<?= $data['image'];?>">
                                <input type="file" name = "image" class="form-control mb-2"></textarea>
                                <label class ="mb-0 text-dark fw-bold" for="">Current Image</label>
                                <img src="../uploads/<?= $data['image'];?>" alt="Product image" height="50px" width="50px">
                            </div>
                                    <div class="col-md-12 mt-2">
                                        <button type = "submit" class = "btn btn-success" name = "update_leave_btn"><i class="fa fa-refresh me-1"></i>Update</button>
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