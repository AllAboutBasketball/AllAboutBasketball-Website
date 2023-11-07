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
                    $users = "SELECT * FROM users WHERE id='$id'";
                    $user_run = mysqli_query($con, $users);

                    if(mysqli_num_rows($user_run) > 0)
                    {
                        foreach ($user_run as $data) 
                        {
                            # code...

                        ?>
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h4 class="text-white">View User
                                    <a href="all-users.php" class = "btn btn-warning float-end"><i class="fa fa-reply me-1"></i>Back</a>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" name="id" value = "<?= $data['id']?>">
                                            <label for="" class ="mb-0 text-dark fw-bold">Name</label>
                                            <input disabled type="text" name = "name" value = "<?= $data['name']?>"  placeholder = "Enter name" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class ="mb-0 text-dark fw-bold">Email</label>
                                            <input disabled type="emial" name = "email" value = "<?= $data['email']?>"placeholder = "Enter email" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class ="mb-0 text-dark fw-bold">Phone</label>
                                            <input disabled type="number" name = "phone" value = "<?= $data['phone']?>"placeholder = "Enter phone" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class ="mb-0 text-dark fw-bold">Date Created</label>
                                            <input disabled type="text" name = "created_at" value = "<?= $data['created_at']?>"placeholder = "Enter phone" class="form-control">
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="" class ="mb-0 text-dark fw-bold">Role as</label>
                                            <select name="role_as" required class="form-control">
                                                <option value="">--Select Role--</option>
                                                <option value="1"<?= $data['role_as'] == '1' ? 'selected':''?>>Admin</option>
                                                <option value="0"<?= $data['role_as'] == '0' ? 'selected':''?>>User</option>
                                            </select>
                                        </div>
                                       
                                        <div class="col-md-6 mt-4">
                                            <input disabled type="file" name = "image" class="form-control">
                                            <label for="" class ="mb-0 text-danger fw-bold">Current Image</label>
                                            <input type="hidden" name="old_image" value = "<?= $data['image']?>">
                                            <img src="../userimage/<?= $data['id']; ?>/<?= $data['image']?>" width="50px" height="50px" alt="">
                                            
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <button type = "submit" class = "btn btn-success" name = "update_user_btn"><i class="fa fa-refresh me-1"></i>Update</button>
                                        </div>
                                        </form>
                                </div>
                            </div>
                        <?php
                        }

                    }
                    else
                    {
                        echo "No Record Found";
                    }
                }
                else
                {
                    echo "ID Missing From URL";
                }
                  ?>
         </div>
     </div>
 </div>



    <?php include('includes/footer.php'); ?>