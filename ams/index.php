<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAIN | Attendance Management System</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php include "header.php"; ?>
    <div class="main-container">
        <div class="registration-container">
            <div class="card-wrapper">
                <h1 class="container-heading">REGISTRATION</h1>
                <p id="container-heading-text">Click here to register students</p>
                <p>
                    <a href="registration.php">  
                        <button class="card-btn-click">Click here</button>
                    </a>
                </p>
            </div>
        </div>
        <div class="take-attendance-container">
            <div class="card-wrapper">
                <h1 class="container-heading">TAKE ATTENDANCE</h1>
                <p id="container-heading-text">Click here to take students attendance</p>
                <p>
                    <a href="mark_attendance.php">  
                        <button class="card-btn-click">Click here</button>
                    </a>
                </p>
            </div>
        </div>
        <div class="registered-students-container">
            <div class="card-wrapper">
                <h1 class="container-heading">REGISTERED STUDENTS</h1>
                <p id="container-heading-text">Access registered students' profile here</p>
                <p>
                    <a href="registered_std.php">  
                        <button class="card-btn-click">Click here</button>
                    </a>
                </p>
            </div>
        </div>
        <div class="enrolled-students-container">
            <div class="card-wrapper">
                <h1 class="container-heading">ENROLLED STUDENTS</h1>
                <p id="container-heading-text">Access registered students' profile here</p>
                <p>
                    <a href="enrolled_students.php">  
                        <button class="card-btn-click">Click here</button>
                    </a>
                </p>
            </div>
        </div>
        <div class="download-attendance-container">
            <div class="card-wrapper">
                <h1 class="container-heading">DOWNLOAD ATTENDANCE</h1>
                <p id="container-heading-text">Click here to download attendance</p>
                <p>
                    <a href="download_att.php">  
                        <button class="card-btn-click">Click here</button>
                    </a>
                </p>
            </div>
        </div>
        <div class="edit-std-container">
            <div class="card-wrapper">
                <h1 class="container-heading">UPDATE STUDENT INFORMATION</h1>
                <p id="container-heading-text">Click here to modify students information</p>
                <p>
                    <a href="edit_std.php">  
                        <button class="card-btn-click">Click here</button>
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>