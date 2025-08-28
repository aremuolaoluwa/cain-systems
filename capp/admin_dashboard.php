<?php

require_once __DIR__ . '/include/admin_guard.php';
require_once __DIR__ . '/include/db.php';

$action = $_POST['action'] ?? '';

if ($action === 'export_csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="users.csv"');
    $out = fopen('php://output', 'w');
    fputcsv($out, ['username', 'firstname', 'lastname', 'role', 'email', 'phone']);
    $res = $conn->query('SELECT username, firstname, lastname, role, email, phone FROM registrations');
    while ($r = $res->fetch_assoc()) {
        fputcsv($out, [$r['username'], $r['firstname'], $r['lastname'], $r['role'], $r['email'], $r['phone']]);
    }
    fclose($out);
    exit;
}

if ($action === 'delete' && isset($_POST['username'])) {
    $username = $_POST['username'];
    $stmt = $conn->prepare('DELETE FROM registrations WHERE username=?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->close();
    header('Location: admin_dashboard.php');
    exit;
}

if ($action === 'setrole' && isset($_POST['username']) && isset($_POST['role'])) {
    $username = $_POST['username'];
    $role     = $_POST['role'];
    $stmt = $conn->prepare('UPDATE registrations SET role=? WHERE username=?');
    $stmt->bind_param('ss', $role, $username);
    $stmt->execute();
    $stmt->close();
    header('Location: admin_dashboard.php');
    exit;
}

$res = $conn->query('SELECT username, firstname, lastname, role, email FROM registrations ORDER BY registration_date DESC');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>User Management</title>
</head>
<body>
    <h1>User Management</h1>
    <form method="post">
        <button name="action" value="export_csv">Export CSV</button>
    </form>
    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>Username</th>
            <th>Name</th>
            <th>Role</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php while ($r = $res->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($r['username']); ?></td>
                <td><?php echo htmlspecialchars($r['firstname'] . ' ' . $r['lastname']); ?></td>
                <td><?php echo htmlspecialchars($r['role']); ?></td>
                <td><?php echo htmlspecialchars($r['email']); ?></td>
                <td>
                    <form style="display:inline" method="post">
                        <input type="hidden" name="username" value="<?php echo $r['username']; ?>">
                        <select name="role">
                            <option value="Student" <?php if (strcasecmp($r['role'], 'Student') === 0) echo 'selected'; ?>>Student</option>
                            <option value="Staff" <?php if (strcasecmp($r['role'], 'Staff') === 0) echo 'selected'; ?>>Staff</option>
                            <option value="Admin" <?php if (strcasecmp($r['role'], 'Admin') === 0) echo 'selected'; ?>>Admin</option>
                        </select>
                        <button name="action" value="setrole">Set Role</button>
                    </form>
                    <form style="display:inline" method="post" onsubmit="return confirm('Delete user?');">
                        <input type="hidden" name="username" value="<?php echo $r['username']; ?>">
                        <button name="action" value="delete">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <p><a href="index.php">Logout</a></p>
</body>
</html>