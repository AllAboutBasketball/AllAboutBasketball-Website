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
                        <h4><strong class="text-light">Authentication</strong></h4>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <div class="d-flex justify-content-center flex-column" style="width: 80%">
                            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#loginModal">
                                Login
                            </button>

                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#registerModal">
                                Register
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title text-light" id="loginModalLabel">Login Form</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="functions/authcode.php" method="POST">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label text-dark fw-bold" autocomplete="off">Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="Enter your email" id="exampleInputEmail1" aria-describedby="emailHelp" autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label text-dark fw-bold" autocomplete="off">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password" id="exampleInputPassword1">
          </div>
          <p><a href="forgot-password.php" style="margin-bottom: 15px; display: block; text-align: right;">Forgot Password?</a></p>
          <button type="submit" name="login_btn" class="btn btn-primary"><i class="fa fa-sign-in me-2"></i>Login</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title text-light" id="registerModalLabel">Registration Form</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
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
            <label class="form-label text-dark fw-bold">Address</label>
            <textarea name="address" required class="form-control" rows="2" placeholder="Enter Address" autocomplete="off"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label text-dark fw-bold">ZIP Code</label>
            <input type="number" name="zip" required class="form-control" placeholder="Enter zipcode" id="numbers" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label text-dark fw-bold">Password</label>
            <input type="password" name="password" required class="form-control" placeholder="Enter password" id="exampleInputPassword1" autocomplete="off">
          </div>
          <div class="mb-3">
            <label class="form-label text-dark fw-bold">Confirm Password</label>
            <input type="password" required name="cpassword" class="form-control" placeholder="Confirm password" autocomplete="off">
          </div>
          <button type="submit" name="register_btn" class="btn btn-primary">Register</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include('includes/footer.php'); ?>