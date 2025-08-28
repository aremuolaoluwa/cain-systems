<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "capp";

$conn = new mysqli($servername, $username, $password, $dbname);

$conn->set_charset('utf8mb4');