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
                           <a href="my-profile.php" class="btn btn-warning float-end"><i class="fa fa-reply"></i>Back</a>
                       </div>
                       <div class="card-body">
                           <div class="row">
                           <?php
                                            $info = getAllInfo('users');

                                            if(mysqli_num_rows($info) > 0)
                                            {
                                                foreach ($info as $data) {
                                                   
                                                    ?>
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                           <h4>Edit User Details</h4>
                                   <hr>
                               <div class="col-md-8">
                                   
                                    <div class="row">
                                       
                                                        
                                                        <div class="col-md-12 mb-2">
                                                            <input type="hidden" name="id" value = "<?= $data['id']?>">
                                                            <label class="fw-bold">Name</label>
                                                            <input type="text" name = "name" value = "<?= $data['name']?>" placeholder = "Enter name" class="form-control">
                                                        </div>
                                                        <div class="col-md-12 mb-2">
                                                            <label class="fw-bold">E-mail</label>
                                                            <input type="email" name = "email" value = "<?= $data['email']?>" placeholder = "Enter email" class="form-control">
                                                        </div>
                                                        <div class="col-md-12 mb-2">
                                                            <label class="fw-bold">Phone</label>
                                                            <input type="number" name = "phone" value = "<?= $data['phone']?>" placeholder = "Enter phone" class="form-control">
                                                        </div>
                                                        
                                    </div>
                                </div>
                                <div class="col-md-4 mb2">
                                   
                                    <div class="card shadow">
                                        <div class="card-body">
                                            
                                            
                                                    <input type="hidden" name="old_image" value = "<?= $data['image']?>">
                                                    <img src="userimage/<?= $data['image']; ?>" width="300px" height="250px" alt="Category Image" class="raduis">                                                          
                                                    <input type="file" name = "image" class="form-control mt-2" value = "<?= $data['image']?>">
                                                           
                                        </div>
                                                       
                                                        
                                                    

                                         </div>
                                                        <div class="col-md-6 mb-2 mt-2">
                                                        <button type = "submit" class = "btn btn-success" name = "update_profile_btn"><i class="fa fa-refresh me-1"></i>Update</button>
                                                        </div>
                                    </div>
                               </div>
                              
                                            </form>   
                                            <?php
                                        }
                                          
                                        
                                        ?>          
                                    <?php
                                }
                                ?>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
img.raduis{
border-radius: 50%;
}
</style>
<?php include('includes/footer.php'); ?>