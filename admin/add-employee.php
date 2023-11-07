<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php');
?>


<div class="container">
    <div class="row">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header bg-info">
                   <h4 class="text-white">Add Employee
                   <a href="employee.php" class = "btn btn-warning float-end"><i class="fa fa-reply me-1"></i>Back</a> 
                   </h4>
               </div>
               <div class="card-body">
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                    <div class="col-md-6">
                                        <label class="mb-0 text-dark fw-bold" for="">Fullname</label>
                                        <input type="text" required name="e_name" placeholder="Enter Fullname" class="form-control mb-2" autocomplete="off" pattern="[A-Za-z\s]+" title="Please enter alphabetic characters only (whitespace allowed)" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                                    </div>
                                        <div class="col-md-6">
                                                <label class ="mb-0 text-dark fw-bold" for="">Age</label>
                                                <input type="number" required name = "e_age" placeholder = "Enter Age" class="form-control mb-2" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                         </div>
                                            <div class="col-md-3">
                                                <label class="mb-0 text-dark fw-bold" for=""> Date of Birth</label>
                                                <br>
                                                <input type="date" required name="e_date" id="set-time" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="mb-0 text-dark fw-bold" for=""> Hiring Date</label>
                                                <br>
                                                <input type="datetime-local" required name="e_date_hiring_local" id="set-date" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mb-0 text-dark fw-bold" for="sizeSelect">Gender</label>
                                                    <select id="sizeSelect" required name="e_gender" class="form-select mb-2">
                                                        <option readonly selected hidden>Choose</option>
                                                        <option value="MALE">MALE</option>
                                                        <option value="FEMALE">FEMALE</option>
                                                    </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mb-0 text-dark fw-bold" for="">Contact No.</label>
                                                <input type="tel" required name="e_contact" placeholder="Enter Contact" class="form-control mb-2" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11">
                                            </div>
                                             <div class="col-md-6">
                                            <label class="mb-0 text-dark fw-bold" for="">Email</label>
                                            <input type="email" required name="e_email" placeholder="Enter email" class="form-control mb-2" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-6">
                                                <label class ="mb-0 text-dark fw-bold" for="">Monthly Salary</label>
                                                <input type="number" required name="e_salary" placeholder="Enter Price" class="form-control mb-2" autocomplete="off" oninput="limitDigits(this, 6)">
                                        </div>
                                        <div class="col-md-6">
                                                <label class="mb-0 text-dark fw-bold" for="sizeSelect">Position</label>
                                                    <select id="sizeSelect" required name="e_position" class="form-select mb-2">
                                                        <option readonly selected hidden>Choose</option>
                                                        <option value="CEO">CEO</option>
                                                        <option value="VICE-PRES">VICE PRESIDENT</option>
                                                        <option value="EXECUTIVE">EXECUTIVE</option>
                                                        <option value="MANAGER">MANAGER</option>
                                                        <option value="EMPLOYEE">EMPLOYEE</option>
                                                        <option value="SEC-GUARD">SECURITY GUARD</option>
                                                    </select>
                                            </div>
                                        <div class="col-md-6">
                                            <label class="mb-0 text-dark fw-bold" for="">Upload Image</label>
                                            <input type="file" required name="image" class="form-control mb-2">
                                        </div>
                                        <div class="col-md-6">
                                                <label class ="mb-0 text-dark fw-bold" for="">Employee User ID</label>
                                                <input type="number" required name = "e_emp_id" placeholder = "Enter ID" class="form-control mb-2" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                             </div>
                                        <div class="col-md-12">
                                            <label class="mb-0 text-dark fw-bold" for="">Address</label>
                                            <textarea rows="2" required name="e_address" placeholder="Enter Address" class="form-control mb-2" autocomplete="off" required></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-success" name="add_emp_btn"><i class="fa fa-save me-1"></i>Save</button>
                                        </div>
                                    </div>
                    </form>
               </div>
           </div>
       </div>
    </div>



    <?php include('includes/footer.php'); ?>