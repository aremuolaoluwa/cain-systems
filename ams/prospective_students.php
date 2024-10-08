<?php
include './include/db.php';

$result = $conn->query("SELECT * FROM prospective_students");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Prospective Students</title>
<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
    <?php include "side-drawer.php"; ?>
    <?php include "header.php"; ?>
    <div class="table-wrap">
        <h2 class="tbl-title">Prospective Students' Information</h2>
        <table class="enroll-tbl">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Other Name</th>
                <th>Last Name</th>
                <th>Intended Class</th>
                <th>Date of Birth</th>
                <th>School Name</th>
                <th>State of Origin</th>
                <th>Gender</th>
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
                <td><?php echo $row['class']; ?></td>
                <td><?php echo $row['dob']; ?></td>
                <td><?php echo $row['name_of_school']; ?></td>
                <td><?php echo $row['state_of_origin']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['guardian_name']; ?></td>
                <td><?php echo $row['guardian_phone']; ?></td>
                <td><?php echo $row['occupation']; ?></td>
                <td><?php echo $row['guardian_address']; ?></td>
                <td>
                <form method="post" action="./include/enrollment.php">
                    <input type="hidden" name="student_id" value="<?php echo $row['id']; ?>">
                    <?php if ($row['enrollment_status'] == 'Enrolled'): ?>
                        <button class='enroll-btn' type="submit" name="action" value="unenroll">Unenroll</button>
                    <?php else: ?>
                        <button class='enroll-btn' type="submit" name="action" value="enroll">Enroll</button>
                    <?php endif; ?>
                </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>