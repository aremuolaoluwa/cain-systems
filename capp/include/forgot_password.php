<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require '../vendor/autoload.php';
require 'db.php';

//$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
//$dotenv->load();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailOrUsername = $_POST['email_username'];

    $stmt = $conn->prepare("SELECT email FROM registrations WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $emailOrUsername, $emailOrUsername);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($email);
        $stmt->fetch();
        $resetToken = bin2hex(random_bytes(16));

        $stmt = $conn->prepare("UPDATE registrations SET reset_token = ? WHERE email = ?");
        $stmt->bind_param("ss", $resetToken, $email);
        $stmt->execute();

        $resetLink = "http://localhost/cms/capp/include/new_password.php?token=$resetToken";
        $subject = "Password Reset Request";
        $message = "Click the following link to reset your password: <a href='$resetLink'>$resetLink</a>";

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->CharSet = "utf-8";
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;

            $mail->Username = '';
            $mail->Password = '';

            $mail->setFrom('tech@cainafrica.org', 'CAIN Africa');
            $mail->addAddress($email);
            
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();
            echo "<script>alert('Password reset link has been sent to your email.'); window.location.href='../forgot_password.php';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Message could not be sent. {$mail->ErrorInfo}'); window.location.href='../forgot_password.php';</script>";
        }
    } else {
        echo "<script>alert('No user found with that email or username.'); window.location.href='../forgot_password.php';</script>";
    }

    $stmt->close();
    $conn->close();
}