<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    $login_query = "SELECT * FROM registrations WHERE username=?";
    $stmt = $conn->prepare($login_query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['username'] = $username;
            echo "<script>alert('Login successful!'); window.location.href='../dashboard.php';</script>";
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