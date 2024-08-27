<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Attendance</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
    <div class="attendance-content-wrap">
        <?php include "header.php"; ?>
        <form class="filter-form" action="" method="post">
            <div class="filter-container">
                <div class="filter-wrap">
                    <label for="classFilter">Filter by Class:</label>
                    <select class="filter" id="classFilter" name="classFilter">
                        <option value="">Select Class</option>
                        <?php
                        
                        include('./include/db.php');
                        $classQuery = "SELECT DISTINCT class FROM student_profile";
                        $classResult = $conn->query($classQuery);

                        $selectedClass = isset($_POST['classFilter']) ? $_POST['classFilter'] : '';

                        if ($classResult->num_rows > 0) {
                            while ($classRow = $classResult->fetch_assoc()) {
                                
                                $selected = ($classRow['class'] == $selectedClass) ? 'selected' : '';
                                echo "<option value='" . htmlspecialchars($classRow['class']) . "' " . $selected . ">" . htmlspecialchars($classRow['class']) . "</option>";
                            }
                            } else {
                            echo "<option value=''>No classes found</option>";
                        }
                        ?>
                    </select>
                    <button type="submit" name="filterClass">Filter</button>
                </div>
            </div>
        </form>
        <form class="att-form" action="./include/mark_att.php" method="post">
            <div class="att-tbl-wrap">
                <h1 class="mark-att-title">Take Students Attendance</h1>
                <div>
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


                            if (isset($_POST['filterClass'])) {
                                if (!empty($selectedClass)) {
                                    $sql = "SELECT id, CONCAT_WS(' ', first_name, COALESCE(other_name, ''), last_name) AS name, reg_number, class FROM student_profile WHERE class = ?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("s", $selectedClass);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                                            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                                            echo "<td>" . htmlspecialchars($row["reg_number"]) . "</td>";
                                            echo "<td>" . htmlspecialchars($row["class"]) . "</td>";
                                            echo "<td>";
                                            echo "<label for='status_{$row['id']}'>";  // Add label for accessibility
                                            echo "<select name='status[" . htmlspecialchars($row["id"]) . "]' id='status_{$row['id']}' class='status-select'>";
                                            echo "<option value='Present'>Present</option>";
                                            echo "<option value='Absent'>Absent</option>";
                                            echo "</select>";
                                            echo "</label>";
                                            echo "</td>";
                                            echo "<td>";
                                            echo "<label for='program_{$row['id']}'>";  // Add label for accessibility
                                            echo "<select name='program[" . htmlspecialchars($row["id"]) . "]' id='program_{$row['id']}' class='program-select'>";
                                            // Assuming $programOptions variable is defined somewhere
                                            echo isset($programOptions) ? $programOptions : '';  // Safely use $programOptions
                                            echo "</select>";
                                            echo "</label>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No students found in this class</td></tr>";
                                    }
                                    $stmt->close();
                                } else {
                                    echo "<tr><td colspan='6'>Please select a class to filter</td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="button-container att-btn">
                    <input type="submit" value="Take Attendance">
                </div>
            </div>
        </form>
        <?php include "footer.php"; ?>
    </div>
</body>
</html>