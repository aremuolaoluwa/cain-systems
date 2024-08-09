<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Take Attendance</title>
<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
    <form action="./include/mark_att.php" method="post">
        <h2>Take Attendance</h2>

        <!-- Program Selection 
        <label for="program">Select Program:</label>
        <select name="program_id" id="program">
            <//?php
            include('./include/db.php');
            $program_sql = "SELECT id, name FROM programs";
            $program_result = $conn->query($program_sql);
            if ($program_result->num_rows > 0) {
                while ($program_row = $program_result->fetch_assoc()) {
                    echo "<option value='" . $program_row['id'] . "'>" . $program_row['name'] . "</option>";
                }
            }
            ?>
        </select>-->

        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Student ID</th>
                <th>Class</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT id, CONCAT_WS(' ', first_name, COALESCE(other_name, ''), last_name) AS name, reg_number, class FROM student_profile";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["reg_number"] . "</td>";
                    echo "<td>" . $row["class"] . "</td>";
                    echo "<td>";
                    echo "<select name='status[" . $row["id"] . "]'>";
                    echo "<option value='Present'>Present</option>";
                    echo "<option value='Absent'>Absent</option>";
                    echo "</select>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No students found</td></tr>";
            }
            ?>
            </tbody>
        </table>
        <div class="button-container">
            <input type="submit" value="Take Attendance">
        </div>
    </form>
    <footer class="footer-nav-bar">
        <a href="index.php">Home |</a>
        <a href="registered_std.php">Registered Students |</a>
        <a href="mark_attendance.php">Mark Attendance |</a>
        <a href="download_att.php">Download Attendance</a>
    </footer>
</body>
</html>