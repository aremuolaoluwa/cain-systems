<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $role = htmlspecialchars($_POST["role"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    if (empty($firstname) || empty($lastname) || empty($role) || empty($gender) || empty($email) || empty($phone) || empty($username) || empty($password)) {
        echo "<script>alert('All fields are required.'); window.location.href='../registration.php';</script>";
    } else {
        
        //$role = ucfirst(strtolower($role));
        //$gender = ucfirst(strtolower($gender));

        $check_username_query = "SELECT * FROM registrations WHERE username=?";
        $stmt = $conn->prepare($check_username_query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>alert('Username already exist!'); window.location.href='../registration.php';</script>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $insert_query = "INSERT INTO registrations (firstname, lastname, role, gender, email, phone, username, password)
                             VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("ssssssss", $firstname, $lastname, $role, $gender, $email, $phone, $username, $hashed_password);

            if ($stmt->execute()) {
                echo "<script>alert('Registration successful! Please sign in to proceed to your dashboard'); window.location.href='../index.php';</script>";
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    }
    $stmt->close();
    $conn->close();
}