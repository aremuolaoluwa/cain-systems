<?php
include 'db.php';

$student = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM student_profile WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $student = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $other_name = $_POST['other_name'];
    $last_name = $_POST['last_name'];
    $reg_number = $_POST['reg_number'];
    $class = $_POST['class'];
    $dob = $_POST['dob'];
    $name_of_school = $_POST['name_of_school'];
    $state_of_origin = $_POST['state_of_origin'];
    $year_admitted = $_POST['year_admitted'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    $guardian_name = $_POST['guardian_name'];
    $guardian_phone = $_POST['guardian_phone'];
    $occupation = $_POST['occupation'];
    $guardian_address = $_POST['guardian_address'];

    $updateQuery = "UPDATE student_profile SET first_name=?, other_name=?, last_name=?, reg_number=?, class=?, dob=?, name_of_school=?, state_of_origin=?, year_admitted=?, gender=?, religion=?, guardian_name=?, guardian_phone=?, occupation=?, guardian_address=? WHERE id=?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param('sssssssssssssssi', $first_name, $other_name, $last_name, $reg_number, $class, $dob, $name_of_school, $state_of_origin, $year_admitted, $gender, $religion, $guardian_name, $guardian_phone, $occupation, $guardian_address, $id);
    $stmt->execute();

    echo "<script>alert('Student details updated successfully!'); window.location.href='../edit_std.php';</script>";
}