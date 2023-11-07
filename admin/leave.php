<?php 
include('../middleware/adminMiddleware.php');
include('includes/header.php'); 


?>

<div class="container">
    <div class="row">
        <div class="colmd-12">
           <div class="card">
               <div class="card-header bg-info">
                   <h4 class="text-white">Leave Info
                   <a href="add-leave-application.php" class = "btn btn-warning float-end"><i class="fas fa-plus me-3"></i>Leave Application</a> 
                   </h4>
               </div>
               <div class="card-body" id="leave_table">
                   <table class="table table-bordered table-striped">
                       <thead>
                           <tr>
                                <th class="text-success fw-bold text-center">No.</th>
                               <th class="text-success fw-bold text-center">Employee ID</th>
                               <th class="text-success fw-bold text-center">Days</th>
                               <th class="text-success fw-bold text-center">Image</th>
                               <th class="text-success fw-bold text-center">Start Date</th>
                               <th class="text-success fw-bold text-center">End Date</th>
                               <th class="text-success fw-bold text-center">Leave Type</th>
                               <th class="text-success fw-bold text-center">Status</th>
                               <th class="text-success fw-bold text-center">Action 1</th>
                               <th class="text-success fw-bold text-center">Action 2</th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php
                                $leaves = getAll('app_leave');

                                if(mysqli_num_rows($leaves) > 0)
                                {
                                    foreach($leaves as $item)
                                    {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $item['id']; ?></td>
                                           <td class="text-center"><?= $item['emp_name']; ?></td>
                                           <td class="text-center"><?= $item['days']; ?></td>
                                           <td class="text-center">
                                                <img src="../uploads/<?= $item['image']; ?>" width = "50px" height = "50px">
                                            </td>
                                           <td class="text-center"><?= $item['start_date']; ?></td>
                                           <td class="text-center"><?= $item['end_date']; ?></td>
                                           <td class="text-center"><?= $item['leave_type']; ?></td>
                                            <td class="text-center"><?= $item['status']; ?></td>
                                            <td class="text-center">
                                                <a href="edit-leave.php?id=<?= $item['id']; ?>" class="btn btn-success"><i class="fa fa-edit me-1"></i>Edit</a>
                                            </td>  
                                            <td class="text-center">                                         
                                                    <!--<form action="code.php" method = "POST">
                                                    <input type="hidden" name="category_id" value = "<?= $item['id']; ?>">
                                                    <button type="submit" class = "btn btn-danger" name = "delete_cate_btn">Delete</button>
                                                </form>-->
                                                <button type="button" class = "btn btn-danger delete_leave_btn" value = "<?= $item['id']; ?>"><i class="fa fa-trash me-1"></i>Delete</button>
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