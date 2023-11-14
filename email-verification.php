<?php

if (isset($_POST["verify_email"]))
{
    $email = $_POST["email"];
    $verification_code = $_POST["verification_code"];

    // connect with database
    $conn = mysqli_connect("localhost:3306", "root", "", "db_aab");

    // mark email as verified
    $sql = "UPDATE users SET email_verified_at = NOW() WHERE email = '" . $email . "' AND verification_code = '" . $verification_code . "'";
    $result  = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) == 0)
    {
        die("Verification code failed.");
    }

    echo "<p>You can login now.</p>";
    exit();
}

?>

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
                
                <div class="card shadow-lg">
                    <div class="card-header bg-primary">
                        <h4><strong class="text-light">Verification Form</strong></h4>
                    </div>
                    <div class="card-body">
                    <form action="functions/authcode.php" method="POST">
    
    <input type="text" name="verification_code" placeholder="Enter verification code" class="form-control" required /> <br>

   <br> <input type="submit" name="verify_email" class="btn btn-primary" value="Verify Email">
</form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>