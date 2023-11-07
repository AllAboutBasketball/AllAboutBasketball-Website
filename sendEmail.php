<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['name']) && isset($_POST['email'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $inquiries = $_POST['inquiries'];
    $message = $_POST['message'];

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail = new PHPMailer(true);

    // SMTP settings
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "allaboutbasketball6@gmail.com";
    $mail->Password = 'allaboutbasketball66666';
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";

    // Email settings
    $mail->isHTML(true);
    $mail->setFrom($email, $name);
    $mail->addAddress("allaboutbasketball6@gmail.com");
    $mail->Subject = "New Contact Form Submission";
    $mail->Body = "Name: $name<br>Email: $email<br>Contact: $contact<br>Address: $address<br>Inquiries: $inquiries<br>Message: $message";

    if ($mail->send()) {
        $status = "success";
        $response = "Email is sent!";
    } else {
        $status = "failed";
        $response = "Something went wrong! Error: " . $mail->ErrorInfo;
    }

    exit(json_encode(array("status" => $status, "response" => $response)));
}
?>
