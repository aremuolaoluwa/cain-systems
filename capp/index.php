<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="login-container">
        <h3>User Login</h3>
        <form action="./include/login.php" method="post">
            <div class="form-box-wrapper">
                <p>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </p>
                <p>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </p>
                <p><button class="log-btn" type="submit" name="submit">Login</button></p>
                <p><a class="form-links" href="registration.php">Not registered? | </a><span><a class="form-links" href="forgot_password.php">Forgot Password?</a></span></p>
            </div>
        </form>
    </div>
</body>
</html>
