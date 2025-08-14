<?php

session_start();
require 'db.php';

$setupToken = getenv('SETUP_TOKEN');
$res = $conn->query("SELECT COUNT(*) as count FROM admins");
$row = $res->fetch_assoc();
if ($row['count'] > 0 && (!isset($_GET['setup']) || $_GET['setup'] !== $setupToken)) {
    die("Registration is closed.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO admins (username, email, password_hash) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    if ($stmt->execute()) {
        echo "Admin registered successfully. .'<br>'. <a href='../login.php'>Login</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
    exit;
}
