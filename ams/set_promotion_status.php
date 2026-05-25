<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include './include/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['promotion_status'])) {

        foreach ($_POST['promotion_status'] as $studentId => $status) {

            $stmt = $conn->prepare("
                UPDATE student_profile
                SET promotion_status = ?
                WHERE id = ?
            ");

            $stmt->bind_param("si", $status, $studentId);
            $stmt->execute();
        }

        $success = "Promotion statuses updated successfully.";
    }
}

$class_filter = "";

if (isset($_GET['class']) && $_GET['class'] != "") {

    $class_filter = $_GET['class'];

    $stmt = $conn->prepare("
        SELECT id, first_name, last_name, class, promotion_status
        FROM student_profile
        WHERE class = ?
        ORDER BY first_name ASC
    ");

    $stmt->bind_param("s", $class_filter);
    $stmt->execute();

    $students = $stmt->get_result();

} else {

    $students = $conn->query("
        SELECT id, first_name, last_name, class, promotion_status
        FROM student_profile
        ORDER BY class ASC, first_name ASC
    ");
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Set Promotion Status</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        select,
        button {
            padding: 8px;
        }

        .success {
            color: green;
            margin-bottom: 20px;
        }

        .top-actions {
            margin-bottom: 20px;
        }

        .top-actions button,
        .top-actions a {
            margin-right: 10px;
        }

    </style>

    <script>

        function markAllEligible() {

            let selects = document.querySelectorAll(".promotion-select");

            selects.forEach(function(select) {
                select.value = "ELIGIBLE";
            });
        }

        function markAllRepeating() {

            let selects = document.querySelectorAll(".promotion-select");

            selects.forEach(function(select) {
                select.value = "REPEATING";
            });
        }

        function resetAllPending() {

            let selects = document.querySelectorAll(".promotion-select");

            selects.forEach(function(select) {
                select.value = "PENDING";
            });
        }

    </script>

</head>

<body>

<h2>Set Promotion Status</h2>

<?php if (isset($success)) { ?>

    <p class="success">
        <?php echo $success; ?>
    </p>

<?php } ?>

<form method="GET">

    <label>Select Class:</label>

    <select name="class">

        <option value="">All Classes</option>

        <option value="JSS1"
            <?php if ($class_filter == 'JSS1') echo 'selected'; ?>>
            JSS1
        </option>

        <option value="JSS2"
            <?php if ($class_filter == 'JSS2') echo 'selected'; ?>>
            JSS2
        </option>

        <option value="JSS3"
            <?php if ($class_filter == 'JSS3') echo 'selected'; ?>>
            JSS3
        </option>

        <option value="SS1"
            <?php if ($class_filter == 'SS1') echo 'selected'; ?>>
            SS1
        </option>

        <option value="SS2"
            <?php if ($class_filter == 'SS2') echo 'selected'; ?>>
            SS2
        </option>

        <option value="SS3"
            <?php if ($class_filter == 'SS3') echo 'selected'; ?>>
            SS3
        </option>

        <option value="Alumni"
            <?php if ($class_filter == 'Alumni') echo 'selected'; ?>>
            Alumni
        </option>

    </select>

    <button type="submit">
        Filter
    </button>

</form>

<br>

<form method="POST">

    <div class="top-actions">

        <button type="button" onclick="markAllEligible()">
            Mark All Eligible
        </button>

        <button type="button" onclick="markAllRepeating()">
            Mark All Repeating
        </button>

        <button type="button" onclick="resetAllPending()">
            Reset All Pending
        </button>

        <button type="submit">
            Save All Changes
        </button>

        <a href="promotion_preview.php">
            Preview Promotions
        </a>

    </div>

    <table>

        <tr>
            <th>Student Name</th>
            <th>Class</th>
            <th>Promotion Status</th>
        </tr>

        <?php while ($row = $students->fetch_assoc()) { ?>

            <tr>

                <td>
                    <?php
                    echo $row['first_name'] . " " . $row['last_name'];
                    ?>
                </td>

                <td>
                    <?php echo $row['class']; ?>
                </td>

                <td>

                    <select
                        name="promotion_status[<?php echo $row['id']; ?>]"
                        class="promotion-select"
                    >

                        <option value="PENDING"
                            <?php
                            if ($row['promotion_status'] == 'PENDING') {
                                echo "selected";
                            }
                            ?>
                        >
                            PENDING
                        </option>

                        <option value="ELIGIBLE"
                            <?php
                            if ($row['promotion_status'] == 'ELIGIBLE') {
                                echo "selected";
                            }
                            ?>
                        >
                            ELIGIBLE
                        </option>

                        <option value="REPEATING"
                            <?php
                            if ($row['promotion_status'] == 'REPEATING') {
                                echo "selected";
                            }
                            ?>
                        >
                            REPEATING
                        </option>

                    </select>

                </td>

            </tr>

        <?php } ?>

    </table>

</form>

</body>
</html>