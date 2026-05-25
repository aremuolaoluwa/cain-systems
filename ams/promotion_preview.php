<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include './include/db.php';

$eligibleCount = $conn->query("
    SELECT COUNT(*) as total
    FROM student_profile
    WHERE promotion_status = 'ELIGIBLE'
")->fetch_assoc()['total'];

$repeatingCount = $conn->query("
    SELECT COUNT(*) as total
    FROM student_profile
    WHERE promotion_status = 'REPEATING'
")->fetch_assoc()['total'];

$pendingCount = $conn->query("
    SELECT COUNT(*) as total
    FROM student_profile
    WHERE promotion_status = 'PENDING'
")->fetch_assoc()['total'];

$class_filter = "";

if (isset($_GET['class']) && $_GET['class'] != "") {

    $class_filter = $_GET['class'];

    $stmt = $conn->prepare("
        SELECT first_name, last_name, class, promotion_status
        FROM student_profile
        WHERE class = ?
        ORDER BY first_name ASC
    ");

    $stmt->bind_param("s", $class_filter);
    $stmt->execute();

    $students = $stmt->get_result();

} else {

    $students = $conn->query("
        SELECT first_name, last_name, class, promotion_status
        FROM student_profile
        ORDER BY class ASC, first_name ASC
    ");
}

function getNextClass($currentClass)
{
    $promotions = [
        'JSS1' => 'JSS2',
        'JSS2' => 'JSS3',
        'JSS3' => 'SS1',
        'SS1'  => 'SS2',
        'SS2'  => 'SS3',
        'SS3'  => 'Alumni'
    ];

    return $promotions[$currentClass] ?? $currentClass;
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Promotion Preview</title>

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

        .eligible {
            color: green;
            font-weight: bold;
        }

        .repeating {
            color: red;
            font-weight: bold;
        }

        .pending {
            color: orange;
            font-weight: bold;
        }

        .stats {
            margin-bottom: 20px;
        }

        .stats p {
            margin: 5px 0;
        }

        form {
            margin-bottom: 20px;
        }

    </style>

</head>

<body>

<h2>Promotion Preview</h2>

<div class="stats">

    <p>
        <strong>Eligible:</strong>
        <?php echo $eligibleCount; ?>
    </p>

    <p>
        <strong>Repeating:</strong>
        <?php echo $repeatingCount; ?>
    </p>

    <p>
        <strong>Pending:</strong>
        <?php echo $pendingCount; ?>
    </p>

</div>

<form method="GET">

    <label>Select Class:</label>

    <select name="class">

        <option value="">All Classes</option>

        <option value="JSS1">JSS1</option>
        <option value="JSS2">JSS2</option>
        <option value="JSS3">JSS3</option>

        <option value="SS1">SS1</option>
        <option value="SS2">SS2</option>
        <option value="SS3">SS3</option>

        <option value="Alumni">Alumni</option>

    </select>

    <button type="submit">
        Filter
    </button>

</form>

<table>

    <tr>
        <th>Student Name</th>
        <th>Current Class</th>
        <th>Promotion Status</th>
        <th>Next Class</th>
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

                <?php if ($row['promotion_status'] == 'ELIGIBLE') { ?>

                    <span class="eligible">
                        ELIGIBLE
                    </span>

                <?php } elseif ($row['promotion_status'] == 'REPEATING') { ?>

                    <span class="repeating">
                        REPEATING
                    </span>

                <?php } else { ?>

                    <span class="pending">
                        PENDING
                    </span>

                <?php } ?>

            </td>

            <td>

                <?php

                if ($row['promotion_status'] == 'ELIGIBLE') {

                    echo getNextClass($row['class']);

                } else {

                    echo $row['class'];

                }

                ?>

            </td>

        </tr>

    <?php } ?>

</table>

<br><br>

<a href="promote_students.php">
    Run Promotion
</a>

</body>
</html>