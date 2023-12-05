<?php 
session_start();
include('includes/header.php'); 
?>


<div class="py-5">


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
               <?php if(isset($_SESSION['msg'])) {?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong></strong> <?= $_SESSION['msg'];?> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                unset($_SESSION['msg']);
               }
            ?>
                
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4>Change Password Form</h4>
                    </div>
                    <div class="card-body">
                        <form action="functions/authcode.php" method="POST">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label text-dark fw-bold" autocomplete="off">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" id="exampleInputEmail1" aria-describedby="emailHelp" autocomplete="off">   
                            </div>
                           
                            </i>
                            <button type="submit" name="reset_btn" class="btn btn-primary"><i class = "fa fa-sign-in me-2"></i>Send Reset Link</button>
                            <div class="social-icons">
                            <br> <a href="login.php">Back To Login</a>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>