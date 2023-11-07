<?php

include('functions/userfunctions.php');
include('includes/header.php');
include('authenticate.php');

?>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class = "text-white">
            <a href="index.php" class = "text-white">
            Home / 
            </a>
            <a href="my-profile.php" class = "text-white">
            My Profile
            </a> 
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="card card-body shadow">
            <div class="row">
                <div class="col-md-12">
                   <div class="card">
                       <div class="card-header bg-primary">
                           <span class="text-white fs-4">My Profile</span>                          
                           <a href="my-profile.php" class="btn btn-warning float-end"><i class="fa fa-reply"></i>Back</a>
                       </div>
                       <div class="card-body">
                           <div class="row">
                           
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                           <h4>Change Password</h4>
                                   <hr>
                               <div class="col-md-8">
                                   
                                    <div class="row">
                                       
                                                        
                                                        <div class="col-md-12 mb-2">
                                                            <input type="hidden" name="id" value = "<?= $data['id']?>">
                                                            <label class="fw-bold">Old Password</label>
                                                            <input type="password" name = "password"  required placeholder = "Enter Old Password" class="form-control">
                                                        </div>
                                                        <div class="col-md-12 mb-2">
                                                            <label class="fw-bold">New Password</label>
                                                            <input type="password" name = "npassword"  required placeholder = "Enter New Password" class="form-control">
                                                        </div>
                                                        <div class="col-md-12 mb-2">
                                                            <label class="fw-bold">Confirm New Password</label>
                                                            <input type="password" name = "cnpassword"  required placeholder = "Confirm New Password" class="form-control">
                                                        </div>
                                                        
                                    </div>
                                </div>
                                
                                                        <div class="col-md-6 mb-2 mt-2">
                                                        <button type = "submit" class = "btn btn-success" name = "change_pass_btn"><i class="fa fa-refresh me-1"></i>Update</button>
                                                        </div>
                                    </div>
                               </div>
                              
                                            </form>   
                                        
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