<?php

include('../config/dbcon.php');
include('functions/userfunctions.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust the path as needed

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assign form data to variables
    $fullname = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $inquiries = $_POST['inquiries'];
    $message = $_POST['message'];

    // Instantiate PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'allaboutbasketball6@gmail.com'; // Your SMTP username
        $mail->Password = 'vawmztaylpyszdci'; // Your SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port = 587; // TCP port to connect to

        //Recipients
        $mail->setFrom($email, $fullname);

        //Add a recipient
        $mail->addAddress('allaboutbasketball6@gmail.com', 'AllAboutBasketClothing');

        // Email content
        $mail->isHTML(false);
        $mail->Subject = $inquiries;
        $mail->Body = "Name: $fullname\nEmail: $email\nContact: $contact\nAddress: $address\n\nMessage: $message";

        // Send email
        $mail->send();
        redirect("index.php", "Email has been sent!");
    } catch (Exception $e) {
        redirect("index.php", "Message could not be sent. Mailer Error Email: {$email}");
    }
} else {
    redirect("index.php", "Invalid request");
}
?>
