<?php

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $name = $_POST['student_name'];
    $query = "SELECT * FROM student_profile WHERE first_name LIKE ? OR last_name LIKE ?";
    $stmt = $conn->prepare($query);
    $searchTerm = "%$name%";
    $stmt->bind_param('ss', $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}