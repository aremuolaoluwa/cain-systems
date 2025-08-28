<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>

    <div class="form-box">
        <form action="./include/login.php" method="post">
            <h2>Admin Login</h2>
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
        <p><a href="forgot_password.php">Forgot password?</a></p>
    </div>
    
</body>
</html>