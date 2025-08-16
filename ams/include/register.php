<?php
session_start();
require 'db.php';

require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

$setupToken = $_ENV['SETUP_TOKEN'] ?? null;

// debugging token
// var_dump("ENV token:", $setupToken, "GET token:", $_GET['setup'] ?? null);

$res = $conn->query("SELECT COUNT(*) as count FROM admins");
$row = $res->fetch_assoc();
$adminExists = $row['count'] > 0;

// If admin exists, require token in URL before showing form or processing
if ($adminExists && (!isset($_GET['setup']) || $_GET['setup'] !== $setupToken)) {
    die("Registration is closed.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO admins (username, email, password_hash) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "Admin registered successfully. <br><a href='../index.php'>Login</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
    exit;
}