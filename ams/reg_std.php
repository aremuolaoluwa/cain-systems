<?php
include './include/db.php';

if (isset($_POST['enroll'])) {
    $id = $_POST['student_id'];
    $conn->query("UPDATE student_profile SET enrollment_status = 1 WHERE ID = $id");
} elseif (isset($_POST['unenroll'])) {
    $id = $_POST['student_id'];
    $conn->query("UPDATE student_profile SET enrollment_status = 0 WHERE ID = $id");
}

$result = $conn->query("SELECT * FROM student_profile");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registered Students</title>
</head>
<body>
    <h1>Registered Students</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Other Name</th>
            <th>Last Name</th>
            <th>Registration Number</th>
            <th>Class</th>
            <th>Date of Birth</th>
            <th>School Name</th>
            <th>State of Origin</th>
            <th>Year Admitted</th>
            <th>Gender</th>
            <th>Religion</th>
            <th>Guardian Name</th>
            <th>Guardian Phone</th>
            <th>Occupation</th>
            <th>Guardian Address</th>
            <th>Enrollment</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['other_name']; ?></td>
            <td><?php echo $row['last_name']; ?></td>
            <td><?php echo $row['reg_number']; ?></td>
            <td><?php echo $row['class']; ?></td>
            <td><?php echo $row['dob']; ?></td>
            <td><?php echo $row['name_of_school']; ?></td>
            <td><?php echo $row['state_of_origin']; ?></td>
            <td><?php echo $row['year_admitted']; ?></td>
            <td><?php echo $row['gender']; ?></td>
            <td><?php echo $row['religion']; ?></td>
            <td><?php echo $row['guardian_name']; ?></td>
            <td><?php echo $row['guardian_phone']; ?></td>
            <td><?php echo $row['occupation']; ?></td>
            <td><?php echo $row['guardian_address']; ?></td>
            <td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="student_id" value="<?php echo $row['id']; ?>">
                    <?php if ($row['enrollment_status'] == 1): ?>
                        <button type="submit" name="unenroll">Unenroll</button>
                    <?php else: ?>
                        <button type="submit" name="enroll">Enroll</button>
                    <?php endif; ?>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="enrolled_students.php">View Enrolled Students</a>
</body>
</html>