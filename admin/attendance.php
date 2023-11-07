<?php 
include('../middleware/adminMiddleware.php');
include('includes/header.php'); 


?>

<div class="container">
    <div class="row">
        <div class="colmd-12">
           <div class="card">
               <div class="card-header bg-info">
                   <h4 class="text-white">Attendance
                   <a href="add-attendance.php" class = "btn btn-warning float-end"><i class="fas fa-plus me-3"></i>Add Attendance</a> 
                   </h4>
               </div>
               <div class="card-body" id="attendance_table">
                   <table class="table table-bordered table-striped">
                       <thead>
                           <tr>
                                <th class="text-success fw-bold text-center" >No.</th>
                               <th class="text-success fw-bold text-center" >Name</th>
                               <th class="text-success fw-bold text-center">Date</th>
                               <th class="text-success fw-bold text-center">Log In</th>
                               <th class="text-success fw-bold text-center">Log Out</th>
                               <th class="text-success fw-bold text-center">Place</th>
                               <th class="text-success fw-bold text-center">Status</th>
                               <th class="text-success fw-bold text-center">Action 1</th>
                               <th class="text-success fw-bold text-center">Action 2</th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php
                                $attendances = getAll('attendance');

                                if(mysqli_num_rows($attendances) > 0)
                                {
                                    foreach($attendances as $item)
                                    {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $item['id']; ?></td>
                                            <td class="text-center"><?= $item['name']; ?></td>
                                           <td class="text-center"><?= $item['date']; ?></td>
                                           <td class="text-center"><?= $item['sign_in']; ?></td>
                                            <td class="text-center"><?= $item['sign_out']; ?></td>
                                            <td class="text-center"><?= $item['place']; ?></td>
                                            <td class="text-center"><?= $item['status']; ?></td>
                                            <td class="text-center">
                                                <a href="edit-attendance.php?id=<?= $item['id']; ?>" class="btn btn-success"><i class="fa fa-edit me-1"></i>Edit</a>
                                            </td>  
                                            <td class="text-center">                                         
                                                    <!--<form action="code.php" method = "POST">
                                                    <input type="hidden" name="category_id" value = "<?= $item['id']; ?>">
                                                    <button type="submit" class = "btn btn-danger" name = "delete_cate_btn">Delete</button>
                                                </form>-->
                                                <button type="button" class = "btn btn-danger delete_attend_btn" value = "<?= $item['id']; ?>"><i class="fa fa-trash me-1"></i>Delete</button>
                                            </td>
                                            
                                        </tr>

                                        <?php  

                                    }

                                }
                                else
                                {
                                    echo "No Records Found";
                                }
                           ?>
                           
                       </tbody>
                   </table>
               </div>
           </div>
        </div>
    </div>
    
    <?php include('includes/footer.php'); ?>