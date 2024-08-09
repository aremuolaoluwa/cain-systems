<?php
require 'db.php';

function getPrograms() {
    global $conn;
    $query = "SELECT id, name FROM programs";
    $result = $conn->query($query);
    $programs = [];
    while ($row = $result->fetch_assoc()) {
        $programs[] = $row;
    }
    return $programs;
}