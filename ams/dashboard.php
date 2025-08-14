<?php require './include/auth_guard.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Admin</title>
</head>
<body>
    <h2>Admin Dashboard</h2>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    <ul>
        <li><a href="promote_students.php">Promote Students</a></li>
        <li><a href="rollback.php">Rollback Promotions</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>    
</body>
</html>