<!-- side-drawer.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .side-drawer {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px;
            background-color: #a50000;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            z-index: 1000;
        }

        .side-drawer a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        .side-drawer a:hover {
            background-color: black;
            color: white;
        }

        .side-drawer .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        #mainContent {
            transition: margin-left .5s;
            padding: 16px;
        }

        .side-drawer.open {
            left: 0;
        }

        .menu-button {
            font-size: 30px;
            cursor: pointer;
            color: #a50000;
            margin: 10px;
            z-index: 1000; /* Ensure button is on top */
        }
    </style>
</head>
<body>
    <!-- The side drawer -->
    <div id="sideDrawer" class="side-drawer">
        <a href="javascript:void(0)" class="closebtn" onclick="closeDrawer()">&times;</a>
        <a href="index.php">Home</a>
        <a href="registration.php">Registration</a>
        <a href="prospective_std_form.php">Prospective Students' Reg.</a>
        <a href="current_stds.php">Current Students</a>
        <!-- <a href="enrolled_students.php">Enrolled Students</a> -->
        <a href="edit_std.php">Update Student Info</a>
        <a href="mark_attendance.php">Take Attendance</a>
        <a href="prospective_students.php">Prospective Students</a>
        <a href="download_att.php">Download Attendance</a>
    </div>

    <span class="menu-button" onclick="openDrawer()">&#9776; Menu</span>

    <script>
        function openDrawer() {
            document.getElementById("sideDrawer").classList.add("open");
            document.getElementById("mainContent").style.marginLeft = "250px"; /* Adjust to match drawer width */
        }

        function closeDrawer() {
            document.getElementById("sideDrawer").classList.remove("open");
            document.getElementById("mainContent").style.marginLeft = "0";
        }
    </script>
</body>
</html>