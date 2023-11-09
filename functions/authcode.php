<?php
session_start();
include('../config/dbcon.php');
?>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

if (isset($_POST["register_btn"]))
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $zip = $_POST["zip"];
    $password = $_POST["password"];

    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Enable verbose debug output
        $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;

        //Send using SMTP
        // $mail->isSMTP();

        //Set the SMTP server to send through
        $mail->Host = 'smtp.gmail.com';

        //Enable SMTP authentication
        $mail->SMTPAuth = true;

        //SMTP username
        $mail->Username = 'allaboutbasketball6@gmail.com';

        //SMTP password
        $mail->Password = 'vawmztaylpyszdci';

        //Enable TLS encryption;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('allaboutbasketball6@gmail.com', 'AllAboutBasketClothing');

        //Add a recipient
        $mail->addAddress($email, $name);

        //Set email format to HTML
        $mail->isHTML(true);

        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

        $mail->Subject = 'Email verification';
        $mail->Body    = '<p>Your Email Verification Code Is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';

        $mail->send();
        // echo 'Message has been sent';

        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

        // connect with database
        $host = 'localhost';
        $username ='u992665783_aabofficial';
        $password = 'oATnan?3$';
        $database = 'u992665783_aab'; 
        $conn = mysqli_connect($host, $username, $pass, $database);

        // insert in users table
        $sql = "INSERT INTO users(name, email, phone, address, zip, password, verification_code, email_verified_at) VALUES ('" . $name . "', '" . $email . "', '" . $phone . "', '" . $address . "', '" . $zip . "', '" . $encrypted_password . "', '" . $verification_code . "', NULL)";
        mysqli_query($conn, $sql);

        header("Location: ../email-verification.php?email=" . $email);
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
else if(isset($_POST["verify_email"]))
{
    $email = $_POST["verify_email"];
    $verification_code = $_POST["verification_code"];

    // connect with database
    $conn = mysqli_connect("localhost", "kaelreyes", "03028138646k@eL!", "vitabella");

    // mark email as verified
    $sql = "UPDATE users SET email_verified_at = NOW() WHERE email = '" . $email . "' AND verification_code = '" . $verification_code . "'";
    $result  = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            if(password_verify($password, $row['password']))
                {        
                    $_SESSION['auth'] = true;

                
                    $userid = $row['id'];
                    $username = $row['name'];
                    $useremail = $row['email'];
                    $role_as = $row['role_as'];
            
            
                    $_SESSION['auth_user'] = [
                        'user_id' => $userid,
                        'name' => $username,
                        'email' => $useremail
                    ];
            
                    $_SESSION['role_as'] = $role_as;
       
                
                    if($role_as == 1)
                    {
                    
                   
                        
                        $_SESSION['message'] = "Welcome to Dashboard";
                        header('Location: ../admin/index.php');
            
                    }
                    else
                    {
                        $_SESSION['message'] = "Logged In Successfully";
                        header('Location: ../index.php');
                    }
           
        
                            
                        
            }
            else
            {
                $_SESSION['message'] = "You can now login";
                header('Location: ../login.php');
            
            }
        }
        
    }
            
    else
    {
        $_SESSION['message'] = "You can now login";
        header('Location: ../login.php');
    
        
        
    }
}

else if(isset($_POST['login_btn']))
{
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);
    $userId = $_SESSION['auth_user']['user_id'];
    

    $login_query = "SELECT * FROM users WHERE email = '$email'";
    $login_query_run = mysqli_query($con, $login_query);
    
    if( mysqli_num_rows($login_query_run)> 0)
    {
                
        while($row = mysqli_fetch_assoc($login_query_run))
        {
            if(password_verify($password, $row['password']))
                {        
                    $_SESSION['auth'] = true;

                
                    $userid = $row['id'];
                    $username = $row['name'];
                    $useremail = $row['email'];
                    $role_as = $row['role_as'];
            
            
                    $_SESSION['auth_user'] = [
                        'user_id' => $userid,
                        'name' => $username,
                        'email' => $useremail
                    ];
            
                    $_SESSION['role_as'] = $role_as;
       
                
                    if($role_as == 1)
                    {
                    
                   
                        
                        $_SESSION['message'] = "Welcome to Dashboard";
                        header('Location: ../admin/index.php');
            
                    }
                    else
                    {
                        $_SESSION['message'] = "Logged In Successfully";
                        header('Location: ../index.php');
                    }
           
        
                            
                        
            }
            else
            {
                $_SESSION['message'] = "Invalid email or password";
                header('Location: ../login.php');
            
            }
        }
        
    }
            
    else
    {
        $_SESSION['message'] = "Invalid email or password";
        header('Location: ../login.php');
    
        
        
    }
}

if (isset($_POST['reset_btn'])) {
    $conn = mysqli_connect("localhost", "kaelreyes", "03028138646k@eL!", "vitabella");
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $code = mysqli_real_escape_string($conn, md5(rand()));

    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
        $query = mysqli_query($conn, "UPDATE users SET code='{$code}' WHERE email='{$email}'");

        if ($query) {        
            echo "<div style='display: none;'>";
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->CharSet =  "utf-8";
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'allaboutbasketball6@gmail.com';                     //SMTP username
                $mail->Password   = 'vawmztaylpyszdci';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('allaboutbasketball6@gmail.com', 'AllAboutBasketClothing');
                $mail->addAddress($email);

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Password Reset';
                $mail->Body    = 'Here is the verification link <b><a href="http://localhost/V411/change-password.php? reset='.$code.'">http://localhost/V411/change-password.php?reset='.$code.'</a></b>';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            echo "</div>";        
            $msg = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>$email - This email address do not found.</div>";
    }
}



else if (isset($_GET['reset'])) {
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['reset']}'")) > 0) {
        if (isset($_POST['submit'])) {
            $password = mysqli_real_escape_string($conn, md5($_POST['password']));
            $confirm_password = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

            if ($password === $confirm_password) {
                $query = mysqli_query($conn, "UPDATE users SET password='{$password}', code='' WHERE code='{$_GET['reset']}'");

                if ($query) {
                    header("Location: login.php");
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match.</div>";
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>Reset Link do not match.</div>";
    }
} else {
    // header("Location: ../index.php");
}
        
?>