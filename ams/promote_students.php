<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Prospective Student Registration</title>
</head>
<body>
    <?php include "header.php"; ?>
    <?php include "side-drawer.php"; ?>
    <div class="container reg-form-container">
        <div class="form-container">
            <form action="./include/promote_students.php" method="POST">
                <button type="submit" onclick="return confirm('Promote all students to next class?')">
                    Promote Students
                </button>
            </form>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>