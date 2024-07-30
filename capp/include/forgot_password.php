<?php

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailOrUsername = $_POST['email_username'];

    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $emailOrUsername, $emailOrUsername);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($email);
        $stmt->fetch();
        $resetToken = bin2hex(random_bytes(16));
        
        $stmt = $conn->prepare("UPDATE users SET reset_token = ? WHERE email = ?");
        $stmt->bind_param("ss", $resetToken, $email);
        $stmt->execute();
        
        $resetLink = "http://localhost/cms/ams/new_password.php?token=$resetToken";
        $subject = "Password Reset Request";
        $message = "Click the following link to reset your password: $resetLink";
        mail($email, $subject, $message);
        
        echo "Password reset link has been sent to your email.";
    } else {
        echo "No user found with that email or username.";
    }

    $stmt->close();
    $conn->close();
}