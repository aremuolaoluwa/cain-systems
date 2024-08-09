<?php

include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['status']) && isset($_POST['program'])) {
    $status_data = $_POST['status'];
    $program_data = $_POST['program'];
    
    $sql = "INSERT INTO mark_attendance (name, reg_number, class, status, program_name, date) VALUES (?, ?, ?, ?, ?, CURRENT_DATE)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $reg_number, $class, $status, $program_name);

    foreach ($status_data as $student_id => $status) {
        $student_query = "SELECT first_name, other_name, last_name, reg_number, class FROM student_profile WHERE id = ?";
        $stmt_student = $conn->prepare($student_query);
        $stmt_student->bind_param("i", $student_id);
        $stmt_student->execute();
        $student_result = $stmt_student->get_result();

        if ($student_result->num_rows == 1) {
            $student_row = $student_result->fetch_assoc();
            $name = $student_row['first_name'] . ' ' . $student_row['other_name'] . ' ' . $student_row['last_name'];
            $reg_number = $student_row['reg_number'];
            $class = $student_row['class'];
            $program_id = $program_data[$student_id];
            
            $program_query = "SELECT program FROM programs WHERE id = ?";
            $stmt_program = $conn->prepare($program_query);
            $stmt_program->bind_param("i", $program_id);
            $stmt_program->execute();
            $program_result = $stmt_program->get_result();

            if ($program_result->num_rows == 1) {
                $program_row = $program_result->fetch_assoc();
                $program_name = $program_row['program'];
            } else {
                $program_name = 'Unknown';
            }

            if (!$stmt->execute()) {
                echo "Error: " . $sql . "<br>" . $conn->error;
                break;
            }
            
            $stmt_program->close();
        } else {
            echo "Error: Student not found for ID: " . $student_id;
            break;
        }

        $stmt_student->close();
    }

    echo "<script>alert('Attendance recorded successfully!'); window.location.href='../mark_attendance.php';</script>";
    $stmt->close();
    $conn->close();
} else {
    echo "Error: Form data not submitted.";
}