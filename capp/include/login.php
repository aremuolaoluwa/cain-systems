<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"] ?? '');
    $password = $_POST["password"] ?? '';

    $login_query = "SELECT * FROM registrations WHERE username=?";
    $stmt = $conn->prepare($login_query);
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        echo "<script>alert('Internal error.'); window.location.href='../index.php';</script>";
        exit;
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (isset($user['password']) && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role']     = $user['role']; // store role in session

            if (strcasecmp($user['role'], 'Admin') === 0) {
                echo "<script>alert('Login successful!'); window.location.href='../admin_dashboard.php';</script>";
            } else {
                echo "<script>alert('Login successful!'); window.location.href='../dashboard.php';</script>";
            }

            $stmt->close();
            $conn->close();
            exit();
        } else {
            echo "<script>alert('Error: Invalid password.'); window.location.href='../index.php';</script>";
        }
    } else {
        echo "<script>alert('Error: Invalid username.'); window.location.href='../index.php';</script>";
    }

    $stmt->close();
    $conn->close();
}