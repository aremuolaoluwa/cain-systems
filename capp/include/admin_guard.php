<?php

if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/db.php';


if (!isset($_SESSION['username'])) {
header('Location: ../index.php'); exit;
}


$stmt = $conn->prepare('SELECT role FROM registrations WHERE username=? LIMIT 1');
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
$stmt->close();


if (!$row || strcasecmp(trim($row['role']), 'Admin') !== 0) {
http_response_code(403);
echo 'Forbidden: Admins only.'; exit;
}