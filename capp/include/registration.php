<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = trim($_POST["firstname"] ?? '');
    $lastname = trim($_POST["lastname"] ?? '');
    $role = trim($_POST["role"] ?? '');
    $gender = trim($_POST["gender"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $phone = trim($_POST["phone"] ?? '');
    $username = trim($_POST["username"] ?? '');
    $password = $_POST["password"] ?? '';

    if (empty($firstname) || empty($lastname) || empty($role) || empty($gender) || empty($email) || empty($phone) || empty($username) || empty($password)) {
        echo "<script>alert('All fields are required.'); window.location.href='../registration.php';</script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email address.'); window.location.href='../registration.php';</script>";
        exit;
    }

    $check_username_query = "SELECT 1 FROM registrations WHERE username=?";
    $stmt = $conn->prepare($check_username_query);
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        echo "<script>alert('Internal error.'); window.location.href='../registration.php';</script>";
        exit;
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        echo "<script>alert('Username already exist!'); window.location.href='../registration.php';</script>";
        $stmt->close();
        $conn->close();
        exit;
    }
    $stmt->close();

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $insert_query = "INSERT INTO registrations (firstname, lastname, role, gender, email, phone, username, password)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        echo "<script>alert('Internal error.'); window.location.href='../registration.php';</script>";
        exit;
    }
    $stmt->bind_param("ssssssss", $firstname, $lastname, $role, $gender, $email, $phone, $username, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful! Please sign in to proceed to your dashboard'); window.location.href='../index.php';</script>";
    } else {
        error_log("Insert error: " . $stmt->error);
        echo "<script>alert('Registration failed.'); window.location.href='../registration.php';</script>";
    }

    $stmt->close();
    $conn->close();
}