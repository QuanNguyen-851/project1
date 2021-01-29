<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../../vendor/autoload.php';
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    $user = "Unknown";
}
if (isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['noidung'])) {
    $mail = new PHPMailer();
    $mail->isSMTP();
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPAuth = true;
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $noidung = $_POST["noidung"];

    //mail người gửi
    $mail->Username = $email;
    $mail->Password = $pass;
    $mail->setFrom($email, $user);
    // người nhận
    $mail->addAddress('nguyenmanhquan08052001@gmail.com', 'Quan Nguyen');
    $mail->isHTML(true);
    $mail->Subject = 'Customer';
    $mail->Body    = $noidung;
    if (!$mail->send()) {
        //sai mk tai khoan
        header('location:send_mail.php?err=1');
    } else {
        //thanh cong
        header('location:send_mail.php?err=2');
    }
} else {
    header('location:send_mail.php');
}
