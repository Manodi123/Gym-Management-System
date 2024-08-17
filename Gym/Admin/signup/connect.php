<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "gym_management_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Failed to connect to DB: " . $conn->connect_error);
}
?>
