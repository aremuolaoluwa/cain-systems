<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Students Registration</title>
<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
    <div class="form-wrap">
        <div class="form-items">
            <h2 class="form-title">User Registration</h2>
            <form action="./include/reg.php" method="post">
                <div class="form-row">
                    <div class="item">
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" required>
                    </div>
                    <div class="item">
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastname" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="item">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="item">
                        <label for="password">password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="item">
                        <label for="role">Role</label>
                        <select id="role" name="role" required>
                            <option value="Student">Student</option>
                            <option value="Staff">Staff</option>
                        </select>
                    </div>
                    <div class="item">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="button-container">
                    <input type="submit" value="Register">
                </div>
            </form>
        </div>
    </div>
</body>
</html>