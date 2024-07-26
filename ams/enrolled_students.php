<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolled Students</title>
    <style>
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
        .enroll-btn {
            padding: 5px 10px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        .enroll-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="table-wrap">
    <h2>Enrolled Students</h2>
    <table>
        <thead>
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
        </thead>
        <tbody>
            <?php
                include './include/db.php';

                $sql = "SELECT * FROM student_profile WHERE enrollment_status = 'enrolled'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['first_name'] . "</td>";
                        echo "<td>" . $row['other_name'] . "</td>";
                        echo "<td>" . $row['last_name'] . "</td>";
                        echo "<td>" . $row['reg_number'] . "</td>";
                        echo "<td>" . $row['class'] . "</td>";
                        echo "<td>" . $row['dob'] . "</td>";
                        echo "<td>" . $row['name_of_school'] . "</td>";
                        echo "<td>" . $row['state_of_origin'] . "</td>";
                        echo "<td>" . $row['year_admitted'] . "</td>";
                        echo "<td>" . $row['gender'] . "</td>";
                        echo "<td>" . $row['religion'] . "</td>";
                        echo "<td>" . $row['guardian_name'] . "</td>";
                        echo "<td>" . $row['guardian_phone'] . "</td>";
                        echo "<td>" . $row['occupation'] . "</td>";
                        echo "<td>" . $row['guardian_address'] . "</td>";
                        echo "<td>";
                        echo "<form method='POST' action='./include/unenroll.php'>";
                        echo "<input type='hidden' name='student_id' value='" . $row['id'] . "'>";
                        echo "<input type='hidden' name='action' value='unenroll'>";
                        echo "<button type='submit' class='enroll-btn'>Unenroll</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='17'>No enrolled students found.</td></tr>";
                }

                $conn->close();
            ?>
        </tbody>
    </table>
</div>
</body>
</html>