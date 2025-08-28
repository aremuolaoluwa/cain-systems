<?php

session_start();
require_once "../include/db.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

$username = $_SESSION['username'];
$today_date = date('Y-m-d');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Get lat/lng
    $latitude = isset($_POST['latitude']) ? (float)$_POST['latitude'] : null;
    $longitude = isset($_POST['longitude']) ? (float)$_POST['longitude'] : null;

    $check_existing_query = "SELECT COUNT(*) FROM clockin WHERE username = ? AND DATE(clock_in_time) = ?";
    $stmt = $conn->prepare($check_existing_query);
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        echo "<script>alert('Internal error.'); window.location='../dashboard.php';</script>";
        exit();
    }
    $stmt->bind_param("ss", $username, $today_date);
    $stmt->execute();
    $stmt->bind_result($existing_count);
    $stmt->fetch();
    $stmt->close();

    if ($existing_count > 0) {
        echo "<script>alert('You have already clocked in for today.'); window.location.href='../dashboard.php';</script>";
        exit();
    }

    $insert_query = "INSERT INTO clockin (username, clock_in_time, latitude, longitude) VALUES (?, NOW(), ?, ?)";
    $stmt = $conn->prepare($insert_query);
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        echo "<script>alert('Internal error.'); window.location='../dashboard.php';</script>";
        exit();
    }

    if ($latitude === null || $longitude === null) {
        // Bind nulls if location not provided
        $null = null;
        $stmt->bind_param("sdd", $username, $null, $null);
    } else {
        $stmt->bind_param("sdd", $username, $latitude, $longitude);
    }

    if ($stmt->execute()) {
        echo "<script>alert('You've successfully clocked-in.'); window.location.href='../dashboard.php';</script>";
    } else {
        error_log("Insert error: " . $stmt->error);
        echo "<script>alert('Failed to record clock-in.'); window.location.href='../dashboard.php';</script>";
    }

    $stmt->close();
    $conn->close();
    exit();
}