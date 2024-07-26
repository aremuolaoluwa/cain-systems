<?php

include('db.php');

// Check if the attendance_date parameter is set and not empty
if (isset($_GET['date']) && !empty($_GET['date'])) {
    $attendance_date = $_GET['date'];

    $sql = "SELECT name, reg_number, class, status FROM mark_attendance WHERE date = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $attendance_date);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=attendance_' . $attendance_date . '.csv');
        
        // create a file pointer for writing CSV data
        $output = fopen('php://output', 'w');

        fputcsv($output, array('Name', 'Registration Number', 'Class', 'Status'));

        while ($row = $result->fetch_assoc()) {
            fputcsv($output, $row);
        }

        fclose($output);

        exit();
    } else {
        echo "No attendance records found for the selected date.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Error: Attendance date parameter not provided.";
}