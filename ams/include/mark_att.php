<?php

include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['status'])) {
    $status_data = $_POST['status'];
    
    // SQL statement to insert data into the mark_attendance table
    $sql = "INSERT INTO mark_attendance (name, reg_number, class, status, date) VALUES (?, ?, ?, ?, CURRENT_DATE)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $reg_number, $class, $status);

    // Loop through the attendance status data and insert into the table
    foreach ($status_data as $student_id => $status) {
        $student_query = "SELECT first_name, last_name, reg_number, class FROM students WHERE id = ?";
        $stmt_student = $conn->prepare($student_query);
        $stmt_student->bind_param("i", $student_id);
        $stmt_student->execute();
        $student_result = $stmt_student->get_result();

        if ($student_result->num_rows == 1) {
            $student_row = $student_result->fetch_assoc();
            $name = $student_row['first_name'] . ' ' . $student_row['last_name'];
            $reg_number = $student_row['reg_number'];
            $class = $student_row['class'];

            if (!$stmt->execute()) {
                echo "Error: " . $sql . "<br>" . $conn->error;
                break; // Exit loop if an error occurs
            }
        } else {
            echo "Error: Student not found for ID: " . $student_id;
            break; // exit loop if student not found
        }

        $stmt_student->close();
    }

    echo "<script>alert('Attendance recorded successfully!'); window.location.href='../mark_attendance.php';</script>";
    $stmt->close();
    $conn->close();
} else {
    echo "Error: Form data not submitted.";
}