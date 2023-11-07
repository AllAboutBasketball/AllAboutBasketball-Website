<?php


include('../config/dbcon.php');
include('functions/userfunctions.php');


if(isset($_POST['cart_id']));
{
    $_SESSION['cart_id']= $_SESSION['cart_id'].','.$_POST['cart_id'];
}
if(isset($_POST['update_profile_btn']))
{

    $userId = $_SESSION['auth_user']['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    $check_email_query = "SELECT email FROM users WHERE email = '$email'";
    $check_email_query_run = mysqli_query($con,$check_email_query);

    if(mysqli_num_rows($check_email_query_run) > 0)
    {
        //redirect("../register.php", "Email Already Used");
        $_SESSION['message'] = "Email Already Used";
        header('Location: ../edit-profile.php');
    }

    if($new_image != "")
    {
        //$update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else
    {
        $update_filename = $old_image;
    }
    $path = 'userimage';

    $update_query = "UPDATE users SET name='$name', email='$email', phone='$phone', image='$update_filename' WHERE id='$userId'";

    $update_query_run = mysqli_query($con, $update_query);

    if($update_query_run)
    {
        if($_FILES['image']['name'] != "")
        {
            
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("userimage/".$old_image))
            {
                unlink("userimage/".$old_image);
            }
        }
        redirect("edit-profile.php", "Update Successful");
    }
    else
    {
        redirect("edit-profile.php", "Something Went Wrong");
    }
}

if(isset($_POST['change_pass_btn']))
{
    $userId = $_SESSION['auth_user']['user_id'];
    $password = $_POST['password'];
    $npassword = $_POST['npassword'];
    $cnpassword = $_POST['cnpassword'];

    $hashed_password = password_hash($npassword, PASSWORD_DEFAULT);

    $check_password = "SELECT * FROM users WHERE id='$userId'";
    $check_password_run = mysqli_query($con, $check_password);
    $row = mysqli_fetch_assoc($check_password_run);

    if(mysqli_num_rows($check_password_run) > 0)
    {
                 
        
            if(password_verify($password, $row['password']))
            {
        
                if($npassword != $cnpassword)
                {
                    redirect("changepass.php", "New Password Does Not Match");
                }
                else
                {
                    $update_password = "UPDATE users SET password='$hashed_password' WHERE id='$userId'";
                    mysqli_query($con, $update_password);
                    redirect("changepass.php", "Changed Password Successfully");

                }
            }
            else
            {
                redirect("changepass.php", "Incorect Password");
            }
        
        
        
    
    }
    else
    {
        redirect("changepass.php", "Incorect Password");

    }

}

if(isset($_POST['help_btn'])) 
{
    $fullname = mysqli_real_escape_string($con,$_POST['Name']);
    $email = mysqli_real_escape_string($con,$_POST['Email']);
    $contact = mysqli_real_escape_string($con,$_POST['Contact']);
    $address = mysqli_real_escape_string($con,$_POST['Address']);
    $inquiries = mysqli_real_escape_string($con,$_POST['Inquiries']);
    $message = mysqli_real_escape_string($con,$_POST['Message']);

    $help_query = "INSERT INTO form (fullname, email, contact, address, inquiries, message)
    VALUES ('$fullname', '$email', '$contact', '$address', '$inquiries','$message')";
    
    $help_query_run = mysqli_query($con, $help_query);    

    if($help_query_run)
    { 
        header("Location: help.php?message= Thankyou! We Appreciate Your Feedback!");
        exit();
    }
    else
    {
        header("Location: help.php?message= Something Wrong!");
        exit();
    }
}
 
?>