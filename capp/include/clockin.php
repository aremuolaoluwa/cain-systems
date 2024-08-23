<?php
session_start();
require_once "../include/db.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

$username = $_SESSION['username'];
$today_date = date('Y-m-d');

// Check if the user has already clocked in today
if ($_SERVER["REQUEST_ETHOD" == "POST"]){
    $check_existing_query = "SELECT COUNT(*) FROM clockin WHERE username = ? AND DATE(clock_in_time) = ?";
    $stmt = $conn->prepare($check_existing_query);
    $stmt->bind_param("ss", $username, $today_date);
    $stmt->execute();
    $stmt->bind_result($existing_count);
    $stmt->fetch();
    $stmt->close();

    if ($existing_count > 0) {
        // User has already clocked in today
        echo "<script>alert('You have already clocked in for today.'); window.location='../dashboard.php';</script>";
        exit();
    }

    // Insert new clock-in record
    $insert_query = "INSERT INTO clockin (username, clock_in_time, latitude, longitude) VALUES (?, NOW(), ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->close();

    $conn->close();

    // Redirect back to the dashboard
    header("Location: ../dashboard.php");
    exit();
}