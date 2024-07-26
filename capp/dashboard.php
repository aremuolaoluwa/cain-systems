<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

require_once "./include/db.php";

$username = $_SESSION['username'];
$user_query = "SELECT * FROM registrations WHERE username=?";
$stmt = $conn->prepare($user_query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Fetch last clock-in and clock-out times from the database
$last_clock_in_query = "SELECT clock_in_time FROM clockin WHERE username = ? ORDER BY clock_in_time DESC LIMIT 1";
$stmt = $conn->prepare($last_clock_in_query);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($last_clock_in_time);
$stmt->fetch();

$last_clock_out_query = "SELECT clock_out_time FROM clockout WHERE username = ? ORDER BY clock_out_time DESC LIMIT 1";
$stmt = $conn->prepare($last_clock_out_query);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($last_clock_out_time);
$stmt->fetch();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="./css/style.css">
    <script>
        function displayAlert(message) {
            alert(message);
        }
    </script>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo $user['firstname']."!"; ?></h2>
        <div class="user-info">
            <p><strong>Name:</strong> <?php echo $user['firstname']." ". $user['lastname']; ?></p>
            <p><strong>Gender:</strong> <?php echo $user['gender']; ?></p>
            <p><strong>Role:</strong> <?php echo $user['role']; ?></p>
            <p><strong>Last Clock-In:</strong> <?php echo isset($last_clock_in_time) ? $last_clock_in_time : "N/A"; ?></p>
            <p><strong>Last Clock-Out:</strong> <?php echo isset($last_clock_out_time) ? $last_clock_out_time : "N/A"; ?></p>
        </div>
        <!-- Clock-in and clock-out -->
        <form action="./include/clockin.php" method="post">
            <button style="padding:15px;" type="submit">Clock In</button>
        </form>
        <form action="./include/clockout.php" method="post">
            <button style="padding:15px;" type="submit">Clock Out</button>
        </form>
        <form action="./include/logout.php" method="post">
            <button style=" background-color: #cc4e2e; margin-top: 20px; padding:15px;" type="submit">Logout</button>
        </form>
    </div>
</body>
</html>