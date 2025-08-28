<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit();
}

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/../config/app.php';

function haversine_m($lat1, $lon1, $lat2, $lon2) {
    $R = 6371000; // Earth radius in metres
    $phi1 = deg2rad($lat1);
    $phi2 = deg2rad($lat2);
    $dphi = deg2rad($lat2 - $lat1);
    $dlambda = deg2rad($lon2 - $lon1);

    $a = sin($dphi / 2) ** 2 + cos($phi1) * cos($phi2) * sin($dlambda / 2) ** 2;
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    return $R * $c;
}

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$username = $_SESSION['username'];
$today = (new DateTime('today'))->format('Y-m-d');

$lat = isset($_POST['latitude']) ? filter_var($_POST['latitude'], FILTER_VALIDATE_FLOAT) : null;
$lng = isset($_POST['longitude']) ? filter_var($_POST['longitude'], FILTER_VALIDATE_FLOAT) : null;

if ($lat === null || $lng === null) {
    echo "<script>alert('Location is required. Enable GPS.'); window.location='../dashboard.php';</script>";
    exit();
}

// Enforce HTTPS for geolocation if required
if (REQUIRE_HTTPS_FOR_GEO && (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off')) {
    echo "<script>alert('Secure connection (HTTPS) required.'); window.location='../dashboard.php';</script>";
    exit();
}

// Check if user already clocked in
$stmt = $conn->prepare('SELECT id, clock_out_time FROM clockin WHERE username = ? AND DATE(clock_in_time) = ? LIMIT 1');
$stmt->bind_param('ss', $username, $today);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if (!$row) {
    echo "<script>alert('Clock-in first before clocking out.'); window.location='../dashboard.php';</script>";
    exit();
}

// Prevent multiple clock-outs
if (!empty($row['clock_out_time'])) {
    echo "<script>alert('You have already clocked out today.'); window.location='../dashboard.php';</script>";
    exit();
}

// Geofence distance check
$distance = haversine_m($lat, $lng, OFFICE_LATITUDE, OFFICE_LONGITUDE);

if ($distance > GEOFENCE_RADIUS_M) {
    echo "<script>alert('You are outside the allowed area (" . round($distance) . "m).'); window.location='../dashboard.php';</script>";
    exit();
}

$stmt = $conn->prepare('UPDATE clockin SET clock_out_time = NOW(), latitude = ?, longitude = ? WHERE id = ?');
$stmt->bind_param('ddi', $lat, $lng, $row['id']);
$stmt->execute();
$stmt->close();
$conn->close();

echo "<script>alert('Clock-out successful!.'); window.location='../dashboard.php';</script>";
exit();