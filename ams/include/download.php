<?php

include 'db.php';

if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    if (strtotime($start_date) === false || strtotime($end_date) === false) {
        die("Invalid date format.");
    }

    $sql = "SELECT name, reg_number, class, status, date
            FROM mark_attendance
            WHERE date BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();

    $filename = "attendance.csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $output = fopen('php://output', 'w');

    fputcsv($output, ['Name', 'Reg. Number', 'Class', 'Status', 'Date']);

    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [$row['name'], $row['reg_number'], $row['class'], $row['status'], $row['date']]);
    }

    fclose($output);
    $stmt->close();
    $conn->close();
    exit;
} else {
    die("Date range not specified.");
}