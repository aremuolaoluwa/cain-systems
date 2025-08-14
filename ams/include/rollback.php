<?php

include 'db.php';

// admin authentication before allowing rollback
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    die("Unauthorized access.");
}

// to log rollback event in a .txt file
$logFile = __DIR__ . '/rollback_log.txt';
file_put_contents($logFile, date('Y-m-d H:i:s') . " - Rollback started by admin: " . ($_SESSION['username'] ?? 'unknown') . "\n", FILE_APPEND);

$check = $conn->query("SELECT COUNT(*) as count FROM student_profile WHERE previous_class IS NOT NULL");
$row = $check->fetch_assoc();
if ($row['count'] == 0) {
    die("No rollback data found. Promotion has not been run or has already been rolled back.");
}

// restore class from previous_class and clear academic_year
$conn->query("UPDATE student_profile SET class = previous_class, previous_class = NULL, academic_year = NULL");

file_put_contents($logFile, date('Y-m-d H:i:s') . " - Rollback completed by admin: " . ($_SESSION['username'] ?? 'unknown') . "\n", FILE_APPEND);

echo "Rollback completed successfully.<br>";
echo "<a href='promote_students.php'>Back to Promotion</a>";

$conn->close();