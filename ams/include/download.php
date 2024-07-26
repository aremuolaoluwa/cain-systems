<?php

include('db.php');

// Check if the attendance_date parameter is set and not empty
if (isset($_GET['date']) && !empty($_GET['date'])) {
    $attendance_date = $_GET['date'];

    // SQL to fetch attendance data for the selected date
    $sql = "SELECT name, reg_number, class, status FROM mark_attendance WHERE date = ?";
    
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $attendance_date);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // set headers for CSV file download
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=attendance_' . $attendance_date . '.csv');
        
        // create a file pointer for writing CSV data
        $output = fopen('php://output', 'w');

        // write CSV headers
        fputcsv($output, array('Name', 'Registration Number', 'Class', 'Status'));

        // fetch and write attendance data to CSV
        while ($row = $result->fetch_assoc()) {
            fputcsv($output, $row);
        }

        // Close the file pointer
        fclose($output);

        // exit script
        exit();
    } else {
        echo "No attendance records found for the selected date.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Error: Attendance date parameter not provided.";
}