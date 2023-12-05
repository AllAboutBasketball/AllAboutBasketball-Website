<?php
session_start();
include('./config/dbcon.php');

if (isset($_GET['reset'])) {
    if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE code='{$_GET['reset']}'")) > 0) {
        if (isset($_POST['submit'])) {
            $password = mysqli_real_escape_string($con, md5($_POST['password']));
            $confirm_password = mysqli_real_escape_string($con, md5($_POST['cpassword']));

            if ($password == $confirm_password) {
                $query = mysqli_query($con, "UPDATE users SET password='{$password}', code='' WHERE code='{$_GET['reset']}'");
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
        }else{
            $msg = "<div class='alert alert-danger'>POST ERROR!</div>";
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
}