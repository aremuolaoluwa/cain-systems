<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Download Attendance</title>
<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
    <div class="form-wrap">
        <div class="form-items">
            <h2>Download Attendance</h2>
            <form action="./include/download.php" method="GET">
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" name="start_date" required>
                <label for="end_date">End Date</label>
                <input type="date" id="end_date" name="end_date" required>
                <label for="program_type">Program Type</label>
                <select id="program_name" name="program_name" required>
                    <option value="" disabled selected>Select Program Type</option>
                    <option value="Daily Tutorial">Daily Tutorial</option>
                    <option value="Life Hacks">Life Hacks</option>
                    <option value="Mentorship">Mentorship</option>
                    <option value="ICT4U">ICT4U</option>
                    <option value="Career Enrichment">Career Enrichment</option>
                </select>
                <div class="button-container">
                    <input type="submit" value="Download">
                </div>
            </form>
        </div>
    </div>
    <footer class="footer-nav-bar">
        <a href="index.php">Home</a> |
        <a href="registered_std.php">Registered Students</a> |
        <a href="enrolled_students.php">Enrolled Students</a> |
        <a href="mark_attendance.php">Mark Attendance</a> |
        <a href="download_att.php">Download Attendance</a>
    </footer>
</body>
</html>