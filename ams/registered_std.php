<?php
include './include/db.php';

$result = $conn->query("SELECT * FROM student_profile");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registered Students</title>
<link rel="stylesheet" type="text/css" href="./css/styling.css">
<style>
       body {
        margin: 0;
        padding: 0;
        /* border-box: box-sizing; */
        font-family: sans-serif; 
        font-size: 14px;
       }
       .page-heading {
        text-align: center;
        color: darkgreen;
        letter-spacing: .01rem;
       }
       .table-wrap {
            overflow: auto;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        button {
            width: 100px;
            padding: 10px;
            border: none;
            border-radius: 3px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
</style>
</head>
<body>
    <div class="table-wrap" style="overflow: auto;">
        <h2 class="page-heading">Students Profile</h2>
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
                    <form method="post" action="./include/enroll.php">
                        <input type="hidden" name="student_id" value="<?php echo $row['id']; ?>">
                        <?php if ($row['enrollment_status'] == 'enrolled'): ?>
                            <button type="submit" name="action" value="unenroll">Unenroll</button>
                        <?php else: ?>
                            <button type="submit" name="action" value="enroll">Enroll</button>
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