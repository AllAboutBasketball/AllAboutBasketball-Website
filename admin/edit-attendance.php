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

                $attendances = getByID("attendance", $id);

                if(mysqli_num_rows($attendances) > 0)
                {
                    $data = mysqli_fetch_array($attendances);
                    ?>
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="text-white">Edit Attendance
                                    <a href="attendance.php" class = "btn btn-warning float-end"><i class="fa fa-reply me-1"></i>Back</a>
                                </h4>
                            </div>
                      <div class="card-body">
                         <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                        <input type="hidden" name="attendance_id" value = "<?= $data['id'];?>">
                                 <div class="col-md-6">
                                 <label class="mb-0 text-dark fw-bold" for="">Employee List</label>
                                   <input readonly type="text" required name="name" value = "<?= $data['name'];?>" placeholder="Enter Fullname" class="form-control mb-2" autocomplete="off" pattern="[A-Za-z\s]+" title="Please enter alphabetic characters only (whitespace allowed)" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                                 </div>
                       <div class="col-md-6">
                                 <label class="mb-0 text-dark fw-bold" for=""> Attendance Date</label>
                                <br>
                                 <input type="date" required name="date" id="set-time" class="form-control">
                         </div>
                         <div class="col-md-6">
                            <label class="mb-0 text-dark fw-bold" for="sign_in_time">Log-In Time</label>
                            <input type="time" required name="sign_in" value = "<?= $data['sign_in'];?>" class="form-control mb-2">
                        </div>
                        <div class="col-md-6">
                            <label class="mb-0 text-dark fw-bold" for="sign_out_time">Log-Out Time</label>
                            <input type="time" value = "<?= $data['sign_out'];?>" name="sign_out" class="form-control mb-2" readonly>
                        </div>
                        <div class="col-md-6">
                             <label class="mb-0 text-dark fw-bold" for="">Place</label>
                                <select required name="place" class="form-select mb-2">
                                    <option readonly selected hidden><?= $data['place'];?></option>
                                    <option value="SHOP">SHOP</option>
                                    <option value="WFH">WORK-FROM-HOME</option>
                                 </select>
                         </div>
                         <div class="col-md-6">
                             <label class="mb-0 text-dark fw-bold" for="">Status</label>
                                <select required name="status" class="form-select mb-2">
                                    <option readonly selected hidden><?= $data['status'];?></option>
                                    <option value="PRESENT">PRESENT</option>
                                    <option value="ABSENT">ABSENT</option>
                                    <option value="LEAVE">ON LEAVE</option>
                                    <option value="INACTIVE">INACTIVE</option>
                                 </select>
                         </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success" name="update_attend_btn"><i class="fa fa-save me-1"></i>Save</button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    <?php 
                }
                else
                {
                   echo "Attendance Not Found";
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