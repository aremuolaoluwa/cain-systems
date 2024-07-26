<?php
session_start();
require_once "../include/db.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

$username = $_SESSION['username'];
$today_date = date('Y-m-d');

// Check if the user has already clocked out today
$check_existing_query = "SELECT COUNT(*) FROM clockout WHERE username = ? AND DATE(clock_out_time) = ?";
$stmt = $conn->prepare($check_existing_query);
$stmt->bind_param("ss", $username, $today_date);
$stmt->execute();
$stmt->bind_result($existing_count);
$stmt->fetch();
$stmt->close();

if ($existing_count > 0) {
    // User has already clocked out today
    echo "<script>alert('You have already clocked out for today.'); window.location='../dashboard.php';</script>";
    exit();
}

// Insert new clock-out record
$insert_query = "INSERT INTO clockout (username, clock_out_time) VALUES (?, NOW())";
$stmt = $conn->prepare($insert_query);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->close();

$conn->close();

// Redirect back to the dashboard
header("Location: ../dashboard.php");
exit();