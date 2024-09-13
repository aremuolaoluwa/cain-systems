<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Download Attendance</title>
<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
    <?php include "header.php"; ?>
    <div class="download-form-wrap">
        <div class="form-items">
            <form action="./include/download.php" method="GET">
                <h2 class="download-form-title">Download Attendance</h2>
                <div class="form-wrap">
                    <div class="form-items">
                        <div class="form-row">
                            <div class="item">
                                <label for="start_date">Start Date</label>
                                <input type="date" id="start_date" name="start_date" required>
                            </div>
                            <div class="item">
                                <label for="end_date">End Date</label>
                                <input type="date" id="end_date" name="end_date" required>
                            </div>
                            <div class="item">
                                <label for="program_type">Program Type</label>
                                <select id="program_name" name="program_name" required>
                                    <option value="" disabled selected>Select Program</option>
                                    <option value="Mathematics Tutorial">Mathematics Tutorial</option>
                                    <option value="English Tutorial">English Tutorial</option>
                                    <option value="ICT4U">ICT4U</option>
                                    <option value="Life Hacks">Life Hacks</option>
                                    <option value="Games Day">Games Day</option>
                                    <option value="Career Enrichment">Career Enrichment</option>
                                    <option value="Mentorship Class">Mentorship Class</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="button-container">
                    <input type="submit" value="Download">
                </div>
            </form>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>