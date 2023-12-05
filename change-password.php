<?php 
session_start();

if(isset($_SESSION['auth']))
{
    $_SESSION['message'] = "Your already logged in";
    header('Location: index.php');
    exit();
}
include('includes/header.php'); 
include('./config/dbcon.php');

if (isset($_POST['submit'])) {
    if (isset($_GET['reset'])) {
        if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE code='{$_GET['reset']}'")) > 0) {
            $password = mysqli_real_escape_string($con, md5($_POST['password']));
            $confirm_password = mysqli_real_escape_string($con, md5($_POST['cpassword']));
        
            if ($password == $confirm_password) {
                $updatedPassword = $encrypted_password = password_hash(md5($_POST['password']), PASSWORD_DEFAULT);
                $query = mysqli_query($con, "UPDATE users SET password='{$updatedPassword}', code='' WHERE code='{$_GET['reset']}'");
                if ($query) {
                    $_SESSION["message"] = "Succesfully Reset Your Password";
                    header("Location: ./login.php");
                    exit();
                }else{
                    $msg = "<div class='alert alert-danger'>Password Change ERROR!</div>";
                    $_SESSION["msg"] = $msg;
                    header('Location: ./change-password.php?reset='.$_GET["reset"]);
                    exit();
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match.</div>";
                $_SESSION["msg"] = $msg;
                header('Location: ./change-password.php?reset='.$_GET["reset"]);
                exit();
            }
        } else {
            $msg = "<div class='alert alert-danger'>Reset Link do not match.</div>";
            $_SESSION["msg"] = $msg;
            header('Location: ./change-password.php?reset='.$_GET["reset"]);
            exit();
        }
    } else {
        $_SESSION["message"] = "NULL INDEX";
        header("Location: ../index.php");
        exit();
    }
}
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
                        <h4>Change Password</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
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