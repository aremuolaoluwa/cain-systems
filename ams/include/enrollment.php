<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $action = $_POST['action'];

    if ($action === 'enroll') {
        $sql = "UPDATE student_profile SET enrollment_status = 'enrolled' WHERE id = ?";
        $message = 'Student enrolled!';
    } elseif ($action === 'unenroll') {
        $sql = "UPDATE student_profile SET enrollment_status = 'unenrolled' WHERE id = ?";
        $message = 'Student unenrolled!';
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $student_id);

    if ($stmt->execute()) {
        echo "<script>alert('$message'); window.location.href = document.referrer;</script>";
    } else {
        echo "<script>alert('Error occurred!'); window.location.href = document.referrer;</script>";
    }

    $stmt->close();
    $conn->close();
}