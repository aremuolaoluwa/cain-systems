<?php

include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
    $other_name = filter_var($_POST['other_name'], FILTER_SANITIZE_STRING);
    $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
    $class = filter_var($_POST['class'], FILTER_SANITIZE_STRING);
    $dob = filter_var($_POST['dob'], FILTER_SANITIZE_STRING);
    $name_of_school = filter_var($_POST['name_of_school'], FILTER_SANITIZE_STRING);
    $state = filter_var($_POST['state_of_origin'], FILTER_SANITIZE_STRING);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);
    $guardian_name = filter_var($_POST['guardian_name'], FILTER_SANITIZE_STRING);
    $guardian_phone = filter_var($_POST['guardian_phone'], FILTER_SANITIZE_STRING);
    $occupation = filter_var($_POST['occupation'], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);

    $sql = "INSERT INTO prospective_students (first_name, other_name, last_name, class, dob, name_of_school, state_of_origin, gender, guardian_name, guardian_phone, occupation, guardian_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        error_log("Error: " . $sql . "\n" . $conn->error);
        echo "<script>alert('Preparation of statement failed!'); window.location.href='../prospective_std_form.php';</script>";
        exit;
    }

    $stmt->bind_param("ssssssssssss", $first_name, $other_name, $last_name, $class, $dob, $name_of_school, $state, $gender, $guardian_name, $guardian_phone, $occupation, $address);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='../prospective_std_form.php';</script>";
    } else {
        error_log("Error: " . $sql . "\n" . $stmt->error);
        echo "<script>alert('Registration failed! Please try again later'); window.location.href='../prospective_std_form.php';</script>";
    }

    $stmt->close();
    $conn->close();
}