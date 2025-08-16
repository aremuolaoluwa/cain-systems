<?php

require 'db.php';

if (!isset($_GET['token'])) {
    die("Invalid request.");
}

$token = $_GET['token'];
$stmt = $conn->prepare("SELECT * FROM admins WHERE reset_token=? AND reset_expires > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$admin = $stmt->get_result()->fetch_assoc();

if (!$admin) {
    die("Invalid or expired token.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE admins SET password_hash=?, reset_token=NULL, reset_expires=NULL WHERE id=?");
    $stmt->bind_param("si", $newPass, $admin['id']);
    if ($stmt->execute()) {
        echo "Password updated. <a href='../index.php'>Login</a>";
    } else {
        echo "Error updating password.";
    }
    exit;
}