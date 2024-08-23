<?php

include './include/search.php';
include './include/edit.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student Information</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php include "header.php"; ?>
    <div class="search-container">
        <h1 class="search-title">Update Student Information</h1>
        <form method="POST" action="">
            <label for="student_name">Search Student Name</label>
            <input type="text" id="student_name" name="student_name" placeholder="Enter Student's Name" required>
            <button type="submit" name="search">Search</button>
        </form>
    </div>

    <?php if (isset($result) && $result->num_rows > 0): ?>
        <ul class="src-result">
            <?php while ($row = $result->fetch_assoc()): ?>
                <li id="src-result"><a href="edit_std.php?id=<?= $row['id'] ?>"><?= $row['first_name'] . ' ' . $row['last_name'] ?></a></li>
            <?php endwhile; ?>
        </ul>
    <?php elseif (isset($_POST['search'])): ?>
        <p>No students found.</p>
    <?php endif; ?>

    <?php if ($student): ?>
        <div class="container reg-form-container">
            <div class="form-container">
                <form method="POST" action="./include/edit.php">
                    <input type="hidden" name="student_id" value="<?= $student['id'] ?>">
                    <div class="form-wrap">
                        <div class="form-items">
                            <div class="form-row">
                                <div class="item">
                                    <label for="first_name">First Name</label>
                                    <input type="text" id="first_name" name="first_name" value="<?= $student['first_name'] ?>" required>
                                </div>
                                <div class="item">
                                    <label for="other_name">Other Name</label>
                                    <input type="text" id="other_name" name="other_name" value="<?= $student['other_name'] ?>">
                                </div>
                                <div class="item">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" value="<?= $student['last_name'] ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="item">
                                    <label for="reg_number">Registration Number</label>
                                    <input type="text" id="reg_number" name="reg_number" value="<?= $student['reg_number'] ?>" required>
                                </div>
                                <div class="item">
                                    <label for="class">Class</label>
                                    <input type="text" id="class" name="class" value="<?= $student['class'] ?>" required>
                                </div>
                                <div class="item">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" id="dob" name="dob" value="<?= $student['dob'] ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="item">
                                    <label for="name_of_school">Name of School</label>
                                    <input type="text" id="name_of_school" name="name_of_school" value="<?= $student['name_of_school'] ?>" required>
                                </div>
                                <div class="item">
                                    <label for="state_of_origin">State of Origin</label>
                                    <input type="text" id="state_of_origin" name="state_of_origin" value="<?= $student['state_of_origin'] ?>" required>
                                </div>
                                <div class="item">
                                    <label for="year_admitted">Year Admitted</label>
                                    <input type="text" id="year_admitted" name="year_admitted" value="<?= $student['year_admitted'] ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="item">
                                    <label for="gender">Gender</label>
                                    <input type="text" id="gender" name="gender" value="<?= $student['gender'] ?>" required>
                                </div>
                                <div class="item">
                                    <label for="religion">Religion</label>
                                    <input type="text" id="religion" name="religion" value="<?= $student['religion'] ?>" required>
                                </div>
                                <div class="item">
                                    <label for="guardian_name">Guardian's Name</label>
                                    <input type="text" id="guardian_name" name="guardian_name" value="<?= $student['guardian_name'] ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="item">
                                    <label for="guardian_phone">Guardian's Phone</label>
                                    <input type="text" id="guardian_phone" name="guardian_phone" value="<?= $student['guardian_phone'] ?>" required>
                                </div>
                                <div class="item">
                                    <label for="occupation">Occupation</label>
                                    <input type="text" id="occupation" name="occupation" value="<?= $student['occupation'] ?>" required>
                                </div>
                                <div class="item">
                                    <label for="guardian_address">Guardian's Address</label>
                                    <input type="text" id="guardian_address" name="guardian_address" value="<?= $student['guardian_address'] ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-container">
                        <input type="submit" value="Save Changes" name="edit">
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <?php include "footer.php"; ?>
</body>
</html>