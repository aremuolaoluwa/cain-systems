<?php
require './include/db.php';

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$setupToken = $_ENV['SETUP_TOKEN'] ?? null;

// debugging token
// var_dump("ENV token:", $setupToken, "GET token:", $_GET['setup'] ?? null);

$res = $conn->query("SELECT COUNT(*) as count FROM admins");
$row = $res->fetch_assoc();
$adminExists = $row['count'] > 0;

if ($adminExists && (!isset($_GET['setup']) || $_GET['setup'] !== $setupToken)) {
    die("Registration is closed.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="apple-touch-icon" href="/cms/cainfavicon.png">
</head>
<body>
    <div class="form-box">
        <form action="./include/register.php<?php echo isset($_GET['setup']) ? '?setup=' . htmlspecialchars($_GET['setup']) : ''; ?>" method="post">
            <h2>Register Admin</h2>
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register</button>
            <p>Have an account? <a href="index.php">Login</a></p>
        </form>
    </div>
</body>
</html>
