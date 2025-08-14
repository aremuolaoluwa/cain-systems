<?php

include 'db.php';

$currentYear = date("Y");
$nextYear = $currentYear + 1;
$autoAcademicYear = $currentYear . "/" . $nextYear;

$newAcademicYear = "2025/2026";

// check if promotion already done for the current academic year
$check = $conn->query("SELECT COUNT(*) as count 
                       FROM student_profile 
                       WHERE previous_class IS NOT NULL 
                       AND academic_year='$newAcademicYear'");
$row = $check->fetch_assoc();
if ($row['count'] > 0) {
    die("Promotion has already been run for $newAcademicYear. Cannot run twice.");
}

$conn->query("UPDATE student_profile SET previous_class = class");

$promotions = [
    'JSS1' => 'JSS2',
    'JSS2' => 'JSS3',
    'JSS3' => 'SS1',
    'SS1'  => 'SS2',
    'SS2'  => 'SS3'
];

// decide reference column (i.e. which column to use for the promotion in future): first run uses `class`, later runs use `previous_class`
$referenceColumn = "class";
$checkPrev = $conn->query("SELECT COUNT(*) as c FROM student_profile WHERE previous_class IS NOT NULL");
$prevRow = $checkPrev->fetch_assoc();
if ($prevRow['c'] > 0) {
    $referenceColumn = "previous_class";
}

foreach ($promotions as $oldClass => $newClass) {
    $conn->query("UPDATE student_profile 
                  SET class='$newClass' 
                  WHERE $referenceColumn='$oldClass'");
}

// handle SS3 as alumni
$graduationSet = $currentYear . "/" . $nextYear;
$conn->query("UPDATE student_profile 
              SET class=CONCAT('Alumni, ', '$graduationSet') 
              WHERE $referenceColumn='SS3'");

$conn->query("UPDATE student_profile SET academic_year='$newAcademicYear'");

echo "Promotion completed successfully for $newAcademicYear.<br>";
echo "Automatic next academic year calculated as: $autoAcademicYear (for future runs).<br>";

echo "<a href='rollback.php'>Rollback Promotions</a>";

$conn->close();

// to log promotions history
file_put_contents(__DIR__ . '/promotion_log.txt', date('Y-m-d H:i:s') . " - Promotion run for $newAcademicYear by admin: " . ($_SESSION['username'] ?? 'unknown') . "\n", FILE_APPEND);