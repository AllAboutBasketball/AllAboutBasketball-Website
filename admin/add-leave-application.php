<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php');
?>

<div class="container">
    <div class="row">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header bg-info">
                   <h4 class="text-white">Employee Leave Application
                   <a href="leave.php" class = "btn btn-warning float-end"><i class="fa fa-reply me-1"></i>Back</a>
                   </h4>
               </div>
               <div class="card-body">
                   <form action="code.php" method="POST" enctype="multipart/form-data">
                   <div class="row">
                        <div class="col-md-6">
                            <label class ="mb-0 text-dark fw-bold" for="">Select Employee</label>
                            <select name = "employee_name" class="form-select mb-2 ">
                                <option readonly selected hidden selected>Choose</option>                                                       
                                <?php
                                        $employees = getAll("employee");

                                        if (mysqli_num_rows($employees) > 0) {
                                            foreach ($employees as $item) {
                                                ?>
                                                <option  value="<?= $item['name']; ?>"><?= $item['name']; ?></option>
                                                <?php
                                            }
                                        } else {
                                            echo "No category available";
                                        }
                                        ?>
                            </select>
                       </div>
                       <div class="col-md-6">
                            <label class="mb-0 text-dark fw-bold" for="">Days</label>
                            <input type="number" required name="days" id="days" placeholder="Enter Days" class="form-control mb-2" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        </div>
                        <div class="col-md-6">
                                 <label class="mb-0 text-dark fw-bold" for=""> Start Date</label>
                                <br>
                                 <input type="date" required name="select_date" id="app-date" class="form-control">
                         </div>
                         <div class="col-md-6">
                                 <label class="mb-0 text-dark fw-bold" for=""> End Date</label>
                                <br>
                                 <input type="date" required name="end_date" id="app-end-date" class="form-control">
                         </div>
                         <div class="col-md-6">
                            <label class="mb-0 text-dark fw-bold" for="">Leave Type</label>
                                <select id="" name="leave_type" class="form-select mb-2">
                                    <option readonly selected hidden>Choose</option>
                                    <option value="SICK LEAVE">SICK LEAVE</option>
                                    <option value="CASUAL LEAVE">CASUAL LEAVE</option>
                                    <option value="LEAVE WITHOUT PAY">LEAVE WITHOUT PAY</option>
                                    <option value="OPTIONAL LEAVE">OPTIONAL LEAVE</option>
                                </select>
                        </div>
                        <input type="hidden" name="leave_status" value="Pending"> 
                        <!-- <div class="col-md-6">
                            <label class="mb-0 text-dark fw-bold" for="">Status</label>
                                <select id="" name="leave_status" class="form-select mb-2">
                                    <option readonly selected hidden>Choose</option>
                                    <option value="APPROVE">APPROVE</option>
                                    <option value="DISSAPROVE">DISSAPROVE</option>
                                </select>
                        </div> -->
                                <div class="col-md-6">
                                            <label class ="mb-0 text-dark fw-bold" for="">Upload Image</label>
                                            <input type="file" required name = "image" class="form-control mb-2"></textarea>
                                </div>
                                <div class="col-md-12">
                                        <label class="mb-0 text-dark fw-bold" for="">Remarks</label>
                                        <input type="text" required name="leave_remarks" placeholder="Enter Remarks" class="form-control mb-2" autocomplete="off" pattern="[A-Za-z\s]+" title="Please enter alphabetic characters only (whitespace allowed)" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                                    </div>
                            <div class="col-md-12">
                                <button type = "submit" class = "btn btn-success" name = "add_leave_btn"><i class="fa fa-save me-1"></i>Save</button>
                            </div>
                       </form>
               </div>
           </div>
       </div>
    </div>



    <?php include('includes/footer.php'); ?>