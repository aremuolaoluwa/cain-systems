<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure the student ID and action are set and valid
    if (!isset($_POST['student_id']) || !isset($_POST['action'])) {
        die("Invalid request!");
    }

    $student_id = $_POST['student_id'];
    $action = $_POST['action'];

    // Check if the student exists in the prospective_students table
    $check_sql = "SELECT * FROM prospective_students WHERE id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param('i', $student_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows == 0) {
        die("No student found with the provided ID.");
    }

    // Fetch student data from prospective_students table
    $student = $check_result->fetch_assoc();

    // Prepare the SQL query to insert data into students_profile table
    if ($action === 'enroll') {
        $insert_sql = "INSERT INTO student_profile 
            (first_name, other_name, last_name, reg_number, class, dob, name_of_school, state_of_origin, year_admitted, gender, religion, guardian_name, guardian_phone, occupation, guardian_address) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // For 'prospective_students' table, 'reg_number' and 'year_admitted' may not exist, so we need to assign default values or generate them
        // $reg_number = generateRegNumber();  // This function should generate a unique registration number
        // $year_admitted = date("Y");  // Assuming current year as the admission year

        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param(
            'sssssssssssssss', 
            $student['first_name'], 
            $student['other_name'], 
            $student['last_name'], 
            $student['reg_number'], 
            $student['class'], 
            $student['dob'], 
            $student['name_of_school'], 
            $student['state_of_origin'],
            $student['year_admitted'], 
            $student['gender'], 
            $student['religion'],
            $student['guardian_name'], 
            $student['guardian_phone'], 
            $student['occupation'], 
            $student['guardian_address']
        );

        if ($stmt->execute()) {
            // After successful insertion, delete the student from the prospective_students table
            $delete_sql = "DELETE FROM prospective_students WHERE id = ?";
            $delete_stmt = $conn->prepare($delete_sql);
            $delete_stmt->bind_param('i', $student_id);
            $delete_stmt->execute();

            echo "<script>alert('Student enrolled successfully!'); window.location.href = document.referrer;</script>";
        } else {
            echo "<script>alert('Error occurred while enrolling the student.'); window.location.href = document.referrer;</script>";
        }

        $stmt->close();
    }
    $check_stmt->close();
    $conn->close();
}