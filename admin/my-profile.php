<?php

include('../middleware/adminMiddleware.php');
include('includes/header.php');


?>


<div class="py-5">
    <div class="container">
        <div class="card card-body shadow">
            <div class="row">
                <div class="col-md-12">
                   <div class="card">
                       <div class="card-header bg-info">
                           <span class="text-white fs-4">My Profile</span>                          
                           <a href="index.php" class="btn btn-warning float-end"><i class="fa fa-reply"></i>Back</a>
                       </div>
                       <div class="card-body">
                           <div class="row">
                           <h4>User Datails</h4>
                                   <hr>
                               <div class="col-md-8">
                                   
                                    <div class="row">
                                        <?php
                                            $info = getAllInfo('users');

                                            if(mysqli_num_rows($info) > 0)
                                            {
                                                foreach ($info as $data) {
                                                   
                                                    ?>
                                                        <div class="col-md-12 mb-2">
                                                            <label class="fw-bold">Name</label>
                                                            <div class="form-control">
                                                                <?= $data['name']; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mb-2">
                                                            <label class="fw-bold">E-mail</label>
                                                            <div class="form-control">
                                                                <?= $data['email']; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mb-2">
                                                            <label class="fw-bold">Phone</label>
                                                            <div class="form-control">
                                                                <?= $data['phone']; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                        <a href="edit-profile.php" class="btn btn-success"><i class="fa fa-edit"></i>Edit</a>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                        <a href="changepass.php" class="btn btn-danger"><i class="fa fa-edit"></i>Change Password</a>
                                                        </div>
                                       
                                    </div>
                               </div>
                               
                               <div class="col-md-4 mb-2">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                            <img src="userimage/<?= $data['image']; ?>" width="300px" height="250px" alt="Category Image" class="raduis">
                                                </div>
                                            </div>
                                       
                                    </div> 
                                    <?php
                                   
                                }
                            }
                        ?>
                        
                </div>
            </div>
        </div>
    </div>
</div>
<style>
img.raduis{
border-radius: 100%;
}
</style>
<?php include('includes/footer.php'); ?>