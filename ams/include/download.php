<?php

include 'db.php';

if (isset($_GET['start_date']) && isset($_GET['end_date']) && isset($_GET['program_name'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $program_type = $_GET['program_name'];

    if (strtotime($start_date) === false || strtotime($end_date) === false) {
        die("Invalid date format.");
    }

    $sql = "SELECT name, reg_number, class, program_name, status, date
            FROM mark_attendance
            WHERE date BETWEEN ? AND ? AND program_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $start_date, $end_date, $program_type);
    $stmt->execute();
    $result = $stmt->get_result();

    $filename = "attendance_" . $program_type . ".csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $output = fopen('php://output', 'w');

    fputcsv($output, ['Name', 'Reg. Number', 'Class', 'Program', 'Status', 'Date']);

    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [$row['name'], $row['reg_number'], $row['class'], $row['program_name'], $row['status'], $row['date']]);
    }

    fclose($output);
    $stmt->close();
    $conn->close();
    exit;
} else {
    die("Date range or program type not specified.");
}