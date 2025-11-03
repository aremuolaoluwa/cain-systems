<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['status']) && isset($_POST['program'])) {
    $status_data = $_POST['status'];
    $program_data = $_POST['program'];
    $attendance_date = $_POST['attendance_date'] ?? date("Y-m-d");

    if (strtotime($attendance_date) > strtotime(date("Y-m-d"))) {
        echo "<script>alert('Error: Attendance date cannot be in the future.'); window.history.back();</script>";
        exit;
    }

    $sql = "INSERT INTO mark_attendance (name, reg_number, class, status, program_name, date) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $reg_number, $class, $status, $program_name, $attendance_date);

    foreach ($status_data as $student_id => $status) {
        $student_query = "SELECT first_name, other_name, last_name, reg_number, class FROM student_profile WHERE id = ?";
        $stmt_student = $conn->prepare($student_query);
        $stmt_student->bind_param("i", $student_id);
        $stmt_student->execute();
        $student_result = $stmt_student->get_result();

        if ($student_result->num_rows == 1) {
            $student_row = $student_result->fetch_assoc();
            $name = trim($student_row['first_name'] . ' ' . $student_row['other_name'] . ' ' . $student_row['last_name']);
            $reg_number = $student_row['reg_number'];
            $class = $student_row['class'];
            $program_id = $program_data[$student_id];

            $program_query = "SELECT program FROM programs WHERE id = ?";
            $stmt_program = $conn->prepare($program_query);
            $stmt_program->bind_param("i", $program_id);
            $stmt_program->execute();
            $program_result = $stmt_program->get_result();

            $program_name = ($program_result->num_rows == 1)
                ? $program_result->fetch_assoc()['program']
                : 'Unknown';

            if (!$stmt->execute()) {
                echo "Error inserting attendance: " . $stmt->error;
                break;
            }

            $stmt_program->close();
        } else {
            echo "Error: Student not found for ID: " . $student_id;
            break;
        }

        $stmt_student->close();
    }

    echo "<script>alert('Attendance recorded successfully for {$attendance_date}!'); window.location.href='../mark_attendance.php';</script>";
    $stmt->close();
    $conn->close();
} else {
    echo "Error: Form not submitted.";
}