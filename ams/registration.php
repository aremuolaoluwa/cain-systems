<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styling.css">
    <title>Students Registration</title>
</head>
<body>
    <?php include "header.php"; ?>
    <div class="container reg-form-container">
        <div class="form-container">
            <form action="./include/reg.php" method="post">
            <h2 class="form-title" style="margin-bottom: 3rem;">Student Registration</h2>
                <fieldset>
                    <legend>PERSONAL INFORMATION</legend>
                    <div class="form-wrap">
                        <div class="form-items">
                            <div class="form-row">
                                <div class="item">
                                    <label for="first_name">First Name</label>
                                    <input type="text" id="first_name" name="first_name" required>
                                </div>
                                <div class="item">
                                    <label for="other_name">Other Name</label>
                                    <input type="text" id="other_name" name="other_name" required>
                                </div>
                                <div class="item">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="item">
                                    <label for="reg_number">CAIN Reg. No</label>
                                    <input type="text" id="reg_number" name="reg_number" required>
                                </div>
                                <div class="item">
                                    <label for="class">Class</label>
                                    <select id="class" name="class" required>
                                        <option value="JSS1">JSS1</option>
                                        <option value="JSS2">JSS2</option>
                                        <option value="JSS3">JSS3</option>
                                        <option value="SS1">SS1</option>
                                        <option value="SS2">SS2</option>
                                        <option value="SS3">SS3</option>
                                    </select>
                                </div>
                                <div class="item">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" id="dob" name="dob" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="item">
                                    <label for="name_of_school">Name of School</label>
                                    <input type="text" id="name_of_school" name="name_of_school" required>
                                </div>
                                <div class="item">
                                    <label for="sor">State of Origin</label>
                                    <input type="text" id="sor" name="state_of_origin" required>
                                </div>
                                <div class="item">
                                    <label for="year_admitted">Year Admitted</label>
                                    <input type="text" id="year_admitted" name="year_admitted" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="item">
                                    <label for="gender">Gender</label>
                                    <select id="gender" name="gender" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="item">
                                    <label for="religion">Religion</label>
                                    <select style="margin-bottom: 2rem;" id="religion" name="religion" required>
                                        <option value="Christianity">Christianity</option>
                                        <option value="Islam">Islam</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>PARENT'S/GUARDIAN'S INFORMATION</legend>
                    <div class="form-wrap">
                        <div class="form-items">
                            <div class="form-row">
                                <div class="item">
                                    <label for="g_name">Name</label>
                                    <input type="text" id="g_name" name="guardian_name" required>
                                </div>
                                <div class="item">
                                    <label for="g_number">Phone Number</label>
                                    <input type="text" id="g_number" name="guardian_phone" required>
                                </div>
                                <div class="item">
                                    <label for="occupation">Occupation</label>
                                    <input type="text" id="occupation" name="occupation" required>
                                </div>
                                <div class="item">
                                    <label for="address">Address</label>
                                    <input type="text" id="address" name="address" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="button-container">
                    <input type="submit" value="Register">
                </div>
            </form>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>