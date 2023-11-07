
<?php 
session_start();

if(isset($_SESSION['auth']))
{
    $_SESSION['message'] = "Your already logged in";
    header('Location: index.php');
    exit();
}
include('includes/header.php'); 
?>


<div class="py-5">


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
               <?php if(isset($_SESSION['message'])) {?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong></strong> <?= $_SESSION['message'];?> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                unset($_SESSION['message']);
               }
            ?>
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4>Change Password</h4>
                    </div>
                    <div class="card-body">
                        <form action="functions/authcode.php" method="POST">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label text-dark fw-bold">New Password</label>
                                <input type="password"  name="password" required class="form-control" placeholder="Enter password" id="exampleInputPassword1" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label  class="form-label text-dark fw-bold">Confirm Password</label>
                                <input type="password"  required name="cpassword" class="form-control"placeholder="Confirm password" autocomplete="off">
                            </div>
                           
                            <button type="submit" name="submit" class="btn btn-primary">Change Password</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>