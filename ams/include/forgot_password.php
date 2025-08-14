<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    $token = bin2hex(random_bytes(32));
    $expires = date("Y-m-d H:i:s", time() + 3600);

    $stmt = $conn->prepare("UPDATE admins SET reset_token=?, reset_expires=? WHERE email=?");
    $stmt->bind_param("sss", $token, $expires, $email);
    if ($stmt->execute() && $stmt->affected_rows > 0) {
        $resetLink = getenv('APP_URL') . "/reset_password.php?token=" . $token;
        // Use mail() or PHPMailer
        mail($email, "Password Reset", "Click here to reset your password: $resetLink");
        echo "Reset link sent to your email.";
    } else {
        echo "Email not found.";
    }
}
