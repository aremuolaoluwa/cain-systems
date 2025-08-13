<?php

include 'db.php';

$sql = "UPDATE student_profile SET class = previous_class, previous_class = NULL WHERE previous_class IS NOT NULL";
if ($conn->query($sql)) {
    echo "Promotion undone successfully.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
