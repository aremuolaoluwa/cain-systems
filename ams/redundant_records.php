<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redundant Data Management</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <style>
        body {
            width: 98%;
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        form {
            /* background: red; */
            width: 50%;
            margin: 0 auto;
        }
        h1 {
            color: rgb(160, 3, 3);
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            /* color: red; */
            background-color: #a50000;
        }
        button {
            margin: 0 auto;
            margin-top: 3rem;
            width: 100%;
            padding: 15px;
            font-size: 16px;
            color: white;
            background-color: #a50000;
            border: none;
            border-radius: 2px;
            cursor: pointer;
        }
        button:hover {
            background-color: #e80101;
        }
    </style>
</head>
<body>
    <?php include "side-drawer.php"; ?>
    <?php include "header.php"; ?>
    <h1>Redundant Student Records</h1>
    <form action="" method="post">
        <table>
            <thead>
                <tr>
                    <th>Select</th>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Other Name</th>
                    <th>Last Name</th>
                    <th>Registration Number</th>
                    <th>Class</th>
                </tr>
            </thead>
            <tbody>
                <?php
        
                include './include/db.php';

                $sql = "
                SELECT id, first_name, other_name, last_name, reg_number, class
                FROM student_profile
                WHERE reg_number IN (
                    SELECT reg_number
                    FROM student_profile
                    GROUP BY reg_number
                    HAVING COUNT(*) > 1
                ) OR CONCAT(first_name, ' ', other_name, ' ', last_name) IN (
                    SELECT CONCAT(first_name, ' ', other_name, ' ', last_name)
                    FROM student_profile
                    GROUP BY CONCAT(first_name, ' ', other_name, ' ', last_name)
                    HAVING COUNT(*) > 1
                )";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><input type='checkbox' name='delete_ids[]' value='".$row["id"]."'></td>";
                        echo "<td>".$row["id"]."</td>";
                        echo "<td>".$row["first_name"]."</td>";
                        echo "<td>".$row["other_name"]."</td>";
                        echo "<td>".$row["last_name"]."</td>";
                        echo "<td>".$row["reg_number"]."</td>";
                        echo "<td>".$row["class"]."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No redundant data found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <button type="submit" name="delete">Delete Selected</button>
    </form>

    <?php
    if (isset($_POST['delete'])) {
        include './include/db.php';

        $selectedIds = isset($_POST['delete_ids']) ? $_POST['delete_ids'] : [];

        if (!empty($selectedIds)) {
            $selectedIds = array_map('intval', $selectedIds);

            $idsToDelete = implode(',', $selectedIds);
            $sqlDelete = "DELETE FROM student_profile WHERE id IN ($idsToDelete)";

            if ($conn->query($sqlDelete) === TRUE) {
                echo "<p>Records deleted successfully</p>";
            } else {
                echo "Error deleting records: " . $conn->error;
            }
        } else {
            echo "<p>No records selected for deletion</p>";
        }

        $conn->close();

        header("Refresh:0");
    }
    ?>
    <?php include "footer.php"; ?>
</body>
</html>