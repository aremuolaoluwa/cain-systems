<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

require_once __DIR__ . '/include/db.php';

$username = $_SESSION['username'];

$stmt = $conn->prepare('SELECT * FROM registrations WHERE username = ?');
$stmt->bind_param('s', $username);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Get last clock-in time
$last_in = null;
$stmt = $conn->prepare('SELECT clock_in_time FROM clockin WHERE username = ? ORDER BY clock_in_time DESC LIMIT 1');
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->bind_result($last_in);
$stmt->fetch();
$stmt->close();

// Get last clock-out time
$last_out = null;
$stmt = $conn->prepare('SELECT clock_out_time FROM clockin WHERE username = ? ORDER BY clock_out_time DESC LIMIT 1');
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->bind_result($last_out);
$stmt->fetch();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Dashboard</title>
  <link rel="stylesheet" href="./css/style.css" />
  <script src="./config/config.js.php"></script>
  <script src="./location.js"></script>
  <script>
    function displayAlert(message) {
      alert(message);
    }
    function updateWorkerAttendance(btn) {
      return () => {
        document.getElementById(btn).click();
      };
    }
  </script>
</head>
<body>
  <div class="dashboard-container">
    <h2>Welcome, <?php echo htmlspecialchars($user['firstname']); ?></h2>

    <!-- User Details -->
    <div class="user-info">
      <h3>User Details</h3>
      <table class="user-table">
        <tr>
          <th>Name</th>
          <td><?php echo htmlspecialchars($user['firstname'] . ' ' . $user['lastname']); ?></td>
        </tr>
        <tr>
          <th>Gender</th>
          <td><?php echo htmlspecialchars($user['gender']); ?></td>
        </tr>
        <tr>
          <th>Role</th>
          <td><?php echo htmlspecialchars($user['role']); ?></td>
        </tr>
        <tr>
          <th>Last Clock-In</th>
          <td><?php echo $last_in ?: 'N/A'; ?></td>
        </tr>
        <tr>
          <th>Last Clock-Out</th>
          <td><?php echo $last_out ?: 'N/A'; ?></td>
        </tr>
      </table>
    </div>

    <!-- Hidden Clock-In Form -->
    <form action="./include/clockin.php" method="post">
      <button class="hidden" id="clockin-btn" type="submit">Clock In</button>
      <input type="hidden" name="latitude" id="clockin-latitude" />
      <input type="hidden" name="longitude" id="clockin-longitude" />
    </form>

    <!-- Hidden Clock-Out Form -->
    <form action="./include/clockout.php" method="post">
      <button class="hidden" id="clockout-btn" type="submit">Clock Out</button>
      <input type="hidden" name="latitude" id="clockout-latitude" />
      <input type="hidden" name="longitude" id="clockout-longitude" />
    </form>

    <!-- Visible Clock Buttons -->
    <div class="log-btns">
      <button 
        class="action-btn" 
        onclick="getLocation(updateWorkerAttendance('clockin-btn'), APP_CONFIG.OFFICE_LATITUDE, APP_CONFIG.OFFICE_LONGITUDE, 'clockin')" 
        <?php echo $last_in ? 'disabled' : ''; ?>>
        Clock In
      </button>

      <button 
        class="action-btn" 
        onclick="getLocation(updateWorkerAttendance('clockout-btn'), APP_CONFIG.OFFICE_LATITUDE, APP_CONFIG.OFFICE_LONGITUDE, 'clockout')" 
        <?php echo $last_out ? 'disabled' : ''; ?>>
        Clock Out
      </button>
    </div>

    <!-- Logout -->
    <form action="./include/logout.php" method="post">
      <button class="logout-btn" type="submit">Logout</button>
    </form>
  </div>
</body>
</html>