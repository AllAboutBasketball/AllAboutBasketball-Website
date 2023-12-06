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
        // Check if the reset code exists and retrieve the user's data
        $reset_code = $_GET['reset'];
        $stmt = $con->prepare("SELECT * FROM users WHERE code = ?");
        $stmt->bind_param("s", $reset_code);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $password = $_POST['password'];
            $confirm_password = $_POST['cpassword'];

            if ($password === $confirm_password) {
                // Hash the password securely
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Update the user's password in the database
                $query = $con->prepare("UPDATE users SET password = ?, code = '' WHERE code = ?");
                $query->bind_param("ss", $hashed_password, $reset_code);
                $query->execute();

                if ($query->affected_rows > 0) {
                    $_SESSION["message"] = "Successfully reset your password.";
                    header("Location: ./login.php");
                    exit();
                } else {
                    $_SESSION["msg"] = "<div class='alert alert-danger'>Password change error.</div>";
                    header('Location: ./change-password.php?reset=' . $reset_code);
                    exit();
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match.</div>";
                $_SESSION["msg"] = $msg;
                header('Location: ./change-password.php?reset=' . $reset_code);
                exit();
            }
        } else {
            $msg = "<div class='alert alert-danger'>Reset Link does not match.</div>";
            $_SESSION["msg"] = $msg;
            header('Location: ./change-password.php?reset=' . $reset_code);
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