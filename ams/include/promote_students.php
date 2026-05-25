<?php

session_start();
include 'db.php';

// academic year (September–July)
$currentYear = date("Y");
$currentMonth = date("n");

if ($currentMonth >= 9) {
    // From September to December: new academic year starts now
    $newAcademicYear = $currentYear . "/" . ($currentYear + 1);
} else {
    // from January to August: still belongs to last year's session
    $newAcademicYear = ($currentYear - 1) . "/" . $currentYear;
}

// calculate the automatic next academic year for display/logging
if ($currentMonth >= 9) {
    $autoAcademicYear = ($currentYear + 1) . "/" . ($currentYear + 2);
} else {
    $autoAcademicYear = $currentYear . "/" . ($currentYear + 1);
}

// prevent running promotion more than once per academic year
$check = $conn->query("SELECT COUNT(*) as count 
                       FROM student_profile 
                       WHERE previous_class IS NOT NULL 
                       AND academic_year='$newAcademicYear'");
$row = $check->fetch_assoc();
if ($row['count'] > 0) {
    die("Promotion has already been run for $newAcademicYear. Cannot run twice.");
}

// save current class to `previous_class` for rollback while ensuring that
// repeaters do NOT have their previous class changed.
$conn->query("
    UPDATE student_profile 
    SET previous_class = class
    WHERE promotion_status = 'ELIGIBLE'
");

$promotions = [
    'JSS1' => 'JSS2',
    'JSS2' => 'JSS3',
    'JSS3' => 'SS1',
    'SS1'  => 'SS2',
    'SS2'  => 'SS3'
];

// decide which column to use for reference to promote students
$referenceColumn = "class";
$checkPrev = $conn->query("SELECT COUNT(*) as c FROM student_profile WHERE previous_class IS NOT NULL");
$prevRow = $checkPrev->fetch_assoc();
if ($prevRow['c'] > 0) {
    $referenceColumn = "previous_class";
}

foreach ($promotions as $oldClass => $newClass) {
    $conn->query("UPDATE student_profile 
              SET class='$newClass' 
              WHERE $referenceColumn='$oldClass'
              AND promotion_status='ELIGIBLE'");
}

// graduate SS3 students into Alumni
$conn->query("UPDATE student_profile 
              SET class=CONCAT('Alumni, ', '$newAcademicYear') 
              WHERE $referenceColumn='SS3'
              AND promotion_status='ELIGIBLE'");

$conn->query("
    UPDATE student_profile 
    SET academic_year='$newAcademicYear'
    WHERE promotion_status='ELIGIBLE'
");

//prepares the system for next year's promotion cycle
$conn->query("
    UPDATE student_profile
    SET promotion_status='PENDING'
");

echo "Promotion completed successfully for $newAcademicYear.<br>";
echo "Automatic next academic year calculated as: $autoAcademicYear.<br>";
echo "<a href='rollback.php'>Rollback Promotions</a>";

// log promotion history
file_put_contents(__DIR__ . '/promotion_log.txt',
    date('Y-m-d H:i:s') . " - Promotion run for $newAcademicYear by admin: " . ($_SESSION['username'] ?? 'unknown') . "\n",
    FILE_APPEND);

$conn->close();