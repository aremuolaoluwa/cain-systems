<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $sql = "UPDATE student_profile SET enrollment_status = 'unenrolled' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $student_id);
    if ($stmt->execute()) {
        echo "<script>alert('Student unenrolled!'); window.location.href='../enrolled_students.php';</script>";
    }
    $stmt->close();
}