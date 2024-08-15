<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Take Attendance</title>
<link rel="stylesheet" type="text/css" href="./css/styling.css">
</head>
<body>
    <?php include "header.php"; ?>
    <form action="./include/mark_att.php" method="post">
        <div class="att-table-wrap">
            <h2>Take Attendance</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Student ID</th>
                        <th>Class</th>
                        <th>Status</th>
                        <th>Program</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    include('./include/db.php');

                    // Fetch programs
                    $programQuery = "SELECT id, program FROM programs";
                    $programResult = $conn->query($programQuery);
                    $programOptions = "";
                    
                    if ($programResult->num_rows > 0) {
                        while ($program = $programResult->fetch_assoc()) {
                            $programOptions .= "<option value='{$program['id']}'>{$program['program']}</option>";
                        }
                    } else {
                        $programOptions = "<option value=''>No programs found</option>";
                    }

                    // Fetch students
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
                            echo "<td>";
                            echo "<select name='program[" . $row["id"] . "]'>";
                            echo $programOptions;
                            echo "</select>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No students found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="button-container att-btn">
            <input type="submit" value="Take Attendance">
        </div>
    </form>
    <?php include "footer.php"; ?>
</body>
</html>