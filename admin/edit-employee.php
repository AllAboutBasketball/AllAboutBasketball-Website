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

                $employees = getByID("employee", $id);

                if(mysqli_num_rows($employees) > 0)
                {
                    $data = mysqli_fetch_array($employees);
                    ?>
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="text-white">Edit Employee
                                    <a href="employee.php" class = "btn btn-warning float-end"><i class="fa fa-reply me-1"></i>Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <input type="hidden" name="employee_id" value = "<?= $data['id'];?>">
                                        <div class="col-md-6">
                                            <label class="mb-0 text-dark fw-bold" for="">Fullname</label>
                                            <input type="text" required name="e_name" placeholder="Enter Fullname" value = "<?= $data['name'];?>" class="form-control mb-2" autocomplete="off" pattern="[A-Za-z\s]+" title="Please enter alphabetic characters only (whitespace allowed)" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                                        </div>
                                        <div class="col-md-6">
                                                <label class ="mb-0 text-dark fw-bold" for="">Age</label>
                                                <input type="text"  name = "e_age" value = "<?= $data['age'];?>" placeholder = "Enter Age" class="form-control mb-2">
                                        </div>
                                        <div class="col-md-3">
                                                    <label class="mb-0 text-dark fw-bold" for=""> Date of Birth</label>
                                                    <br>
                                                    <input type="date" name="e_date" class="form-control" value="<?= $data['date_birth'];?>" readonly>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="mb-0 text-dark fw-bold" for=""> Hiring Date</label>
                                                    <br>
                                                    <input type="datetime-local"  name="e_date_hiring_local" class="form-control" value="<?= $data['date_hiring'];?>" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="mb-0 text-dark fw-bold" for="sizeSelect">Gender</label>
                                                        <select id="sizeSelect" name="e_gender" class="form-select mb-2">
                                                        <option hidden value="<?= $data['gender'] ?>"><?= $data['gender'] ?></option>
                                                            <option value="MALE">MALE</option>
                                                            <option value="FEMALE">FEMALE</option>
                                                        </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="mb-0 text-dark fw-bold" for="">Contact No.</label>
                                                    <input type="tel" required name="e_contact" value="<?= $data['contact'] ?>" placeholder="Enter Contact" class="form-control mb-2" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11">
                                                </div>
                                                <div class="col-md-6">
                                                <label class="mb-0 text-dark fw-bold" for="">Email</label>
                                                <input type="email" name="e_email" placeholder="Enter email" value="<?= $data['email'];?>" class="form-control mb-2" autocomplete="off" >
                                            </div>
                                            <div class="col-md-6">
                                                    <label class ="mb-0 text-dark fw-bold" for="">Monthly Salary</label>
                                                    <input type="number"  name = "e_salary" placeholder = "Enter Salary" value="<?= $data['salary'];?>" class="form-control mb-2" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                            </div>
                                            <div class="col-md-6">
                                                    <label class="mb-0 text-dark fw-bold" for="sizeSelect">Position</label>
                                                        <select id="sizeSelect" name="e_position" class="form-select mb-2">
                                                        <option hidden value="<?= $data['position'] ?>"><?= $data['position'] ?></option>
                                                            <option value="CEO">CEO</option>
                                                            <option value="VICE-PRES">VICE PRESIDENT</option>
                                                            <option value="EXECUTIVE">EXECUTIVE</option>
                                                            <option value="MANAGER">MANAGER</option>
                                                            <option value="EMPLOYEE">EMPLOYEE</option>
                                                            <option value="SEC-GUARD">SECURITY GUARD</option>
                                                        </select>
                                                </div>
                                            <div class="col-md-6">
                                                <label class ="mb-0 text-dark fw-bold" for="">Upload Image</label>
                                                <input type="hidden" name="old_image" value = "<?= $data['image'];?>">
                                                <input type="file" name = "image" class="form-control mb-2"></input>
                                                <label class ="mb-0 text-dark fw-bold" for="">Current Image</label>
                                                <img src="../uploads/<?= $data['image'];?>" alt="Product image" height="50px" width="50px">
                                            </div>
                                            <div class="col-md-6">
                                                    <label class ="mb-0 text-dark fw-bold" for="">Employee User ID</label>
                                                    <input type="number"  name = "e_emp_id"  value = "<?= $data['emp_id'];?>" placeholder = "Enter ID" class="form-control mb-2" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" readonly>
                                                </div>
                                            <div class="col-md-12">
                                                <label class="mb-0 text-dark fw-bold" for="">Address</label>
                                                <textarea rows="2" name="e_address"  placeholder="Enter Address" class="form-control mb-2" autocomplete="off"> <?= $data['address'];?> </textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success" name="update_emp_btn"><i class="fa fa-save me-1"></i>Save</button>
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