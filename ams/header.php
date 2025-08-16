<!-- <div class="main-heading">
    <ul class="title">
        <li class="heading-title">
            <img src="./img/cain.png" alt="CAIN Logo">
        </li>
        <li class="heading-subtitle">Attendance Management System</li>
    </ul>
</div> -->

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div style="display: flex; justify-content: space-between; align-items: center; padding: 20px;" class="top-header">
    <img src="../img/CainWhiteLogo.png" alt="CAIN Logo">

    <ul class="title">
        <li style="color: #fff; font-size: 1.7rem; text-transform: uppercase;" class="heading-subtitle">Attendance Management System</li>
    </ul>

    <div style="display: flex; align-items: center; gap: 20px;">
        <ul>
            <li style="color: #fff;"><?php echo "Welcome, " . ucfirst(htmlspecialchars($_SESSION['username'])); ?></li>
        </ul>
        <a 
            style="text-decoration: none; color: #ff0000; background-color: #fff; padding: 10px 30px; border-radius: 3px; font-weight: bold;" href="./include/logout.php">Logout
        </a>
    </div>
</div>