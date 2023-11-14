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
                        <h4><strong class="text-light">Registration Form</strong></h4>
                    </div>
                    <div class="card-body">
                        <form action="functions/authcode.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label text-dark fw-bold">Name</label>
                                <input type="text" name="name" required class="form-control" placeholder="Enter your name" autocomplete="off" onkeypress="return validateKeyPress(event)">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label text-dark fw-bold">Email Address</label>
                                <input type="email" name="email" required class="form-control" placeholder="Enter your email" id="exampleInputEmail1" aria-describedby="emailHelp" autocomplete="off">
                                
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-dark fw-bold">Contact No.</label>
                                <input type="number" name="phone" required class="form-control" placeholder="Enter number" id="numbers" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" oninput="limitInputRegister(this, 11)">
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-dark fw-bold">Address </label>
                                <textarea name="address" required class="form-control" rows="2" placeholder="Enter Address" autocomplete="off"></textarea>
                                <!-- <input type="text"  name="phone" required class="form-control" placeholder="Enter number" id="numbers" autocomplete="off">                         -->
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-dark fw-bold">ZIP Code </label>
                                <input type="number"  name="zip" required class="form-control" placeholder="Enter zipcode" id="numbers" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label text-dark fw-bold">Password</label>
                                <input type="password"  name="password" required class="form-control" placeholder="Enter password" id="exampleInputPassword1" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label  class="form-label text-dark fw-bold">Confirm Password</label>
                                <input type="password"  required name="cpassword" class="form-control"placeholder="Confirm password" autocomplete="off">
                            </div>
                           
                            <button type="submit" name="register_btn" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>