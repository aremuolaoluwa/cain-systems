<?php

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/include/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$errors = [];
$setup = $_GET['setup'] ?? '';

if ($setup !== ADMIN_SETUP_TOKEN) {
    die('Registration closed. Provide correct setup token.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = trim($_POST['firstname'] ?? '');
    $lastname  = trim($_POST['lastname'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $username  = trim($_POST['username'] ?? '');
    $password  = $_POST['password'] ?? '';
    $phone     = trim($_POST['phone'] ?? '');
    $gender    = trim($_POST['gender'] ?? '');

    if ($firstname === '' || $lastname === '' || $email === '' || $username === '' || $password === '' || $phone === '' || $gender === '') {
        $errors[] = 'All fields required.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email.';
    }

    $stmt = $conn->prepare('SELECT 1 FROM registrations WHERE username=? LIMIT 1');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $errors[] = 'Username exists.';
    }
    $stmt->close();

    if (!$errors) {
        $pw   = password_hash($password, PASSWORD_DEFAULT);
        $role = 'Admin'; // force admin role

        $stmt = $conn->prepare(
            'INSERT INTO registrations 
            (username, firstname, lastname, email, phone, role, gender, password) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
        );
        $stmt->bind_param('ssssssss', $username, $firstname, $lastname, $email, $phone, $role, $gender, $pw);

        if ($stmt->execute()) {
            echo 'Admin registered. <a href="index.php">Go to login</a>';
            exit;
        } else {
            $errors[] = 'DB error: ' . $stmt->error;
        }
        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Register Admin</title>
</head>
<body>
    <h1>Register Admin</h1>
    <?php foreach ($errors as $e) echo '<div style="color:red">'.htmlspecialchars($e)."</div>"; ?>
    <form method="post">
        <label>First name <input name="firstname" required></label><br>
        <label>Last name <input name="lastname" required></label><br>
        <label>Email <input name="email" type="email" required></label><br>
        <label>Phone <input name="phone" required></label><br>
        <label>Gender 
            <select name="gender" required>
                <option value="">--Select--</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </label><br>
        <label>Username <input name="username" required></label><br>
        <label>Password <input name="password" type="password" required></label><br>
        <button type="submit">Create Admin</button>
    </form>
</body>
</html>