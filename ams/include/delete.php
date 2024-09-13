<?php
include 'db.php';

if (isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['student_id'])) {
    $student_id = intval($_POST['student_id']);

    $sqlDelete = "DELETE FROM student_profile WHERE id = ?";
    $stmt = $conn->prepare($sqlDelete);
    $stmt->bind_param("i", $student_id);

    if ($stmt->execute()) {
        echo "<script>alert('Student record deleted'); window.location.href='../current_stds.php';</script>";
    } else {
        echo "<p>Error deleting record: " . $conn->error . "</p>";
    }

    $stmt->close();
}

$conn->close();

header("Location: ../current_stds.php");
exit();