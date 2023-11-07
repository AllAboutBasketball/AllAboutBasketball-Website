<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php');
?>

<div class="container">
    <div class="row">
       <div class="col-md-12">  
           <div class="card">
               <div class="card-header bg-info">
                   <h4 class="text-white">Add Employee Attendance
                   <a href="attendance.php" class = "btn btn-warning float-end"><i class="fa fa-reply me-1"></i>Back</a>
                   </h4>
               </div>
               <div class="card-body">
                   <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label class ="mb-0 text-dark fw-bold" for="">Employee List</label>
                                    <select  required  name="name" class="form-select mb-2 ">
                                        <option disabled selected hidden selected>Choose</option>                                                       
                                      <?php
                                        $employees = getAll("employee");

                                        if (mysqli_num_rows($employees) > 0) {
                                            foreach ($employees as $item) {
                                                ?>
                                                <option value="<?= $item['name']; ?>"><?= $item['name']; ?></option>
                                                <?php
                                            }
                                        } else {
                                            echo "No List of Employee available";
                                        }
                                        ?>
                                    </select>
                            </div>
                       <div class="col-md-6">
                                 <label class="mb-0 text-dark fw-bold" for=""> Attendance Date</label>
                                <br>
                                 <input type="date" required name="date" id="set-time" class="form-control">
                         </div>
                         <div class="col-md-6">
                            <label class="mb-0 text-dark fw-bold" for="sign_in_time">Log-In Time</label>
                            <input type="time" required id="sign_in_time" name="sign_in" class="form-control mb-2">
                        </div>
                        <div class="col-md-6">
                            <label class="mb-0 text-dark fw-bold" for="sign_out_time">Log-Out Time</label>
                            <input type="time" id="sign_out_time" name="sign_out" class="form-control mb-2" readonly>
                        </div>
                        <div class="col-md-6">
                             <label class="mb-0 text-dark fw-bold" for="">Place</label>
                                <select required name="place" class="form-select mb-2">
                                    <option disabled selected hidden>Choose</option>
                                    <option value="SHOP">SHOP</option>
                                    <option value="WFH">WORK-FROM-HOME</option>
                                 </select>
                         </div>
                         <div class="col-md-6">
                             <label class="mb-0 text-dark fw-bold" for="">Status</label>
                                <select required name="status" class="form-select mb-2">
                                    <option disabled selected hidden>Choose</option>
                                    <option value="PRESENT">PRESENT</option>
                                    <option value="ABSENT">ABSENT</option>
                                    <option value="LEAVE">ON LEAVE</option>
                                    <option value="INACTIVE">INACTIVE</option>
                                 </select>
                         </div>
                       <div class="col-md-12">
                           <button type = "submit" class = "btn btn-success" name = "add_attendance_btn"><i class="fa fa-save me-1"></i>Save</button>
                       </div>
                    </form>
               </div>
           </div>
       </div>
    </div>


    <?php include('includes/footer.php'); ?>