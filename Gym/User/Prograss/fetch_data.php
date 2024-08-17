<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: \Gym\User\Signup\login.html");
    exit();
}

$user_email = $_SESSION['email'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym_management_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$weight_sql = "SELECT date, weight FROM weight_progress WHERE user_email = '$user_email' ORDER BY date";
$body_fat_sql = "SELECT date, body_fat_percentage FROM body_fat_progress WHERE user_email = '$user_email' ORDER BY date";
$muscle_gain_sql = "SELECT date, muscle_mass FROM muscle_gain_progress WHERE user_email = '$user_email' ORDER BY date";

$weight_result = $conn->query($weight_sql);
$body_fat_result = $conn->query($body_fat_sql);
$muscle_gain_result = $conn->query($muscle_gain_sql);

$weight_data = [];
while ($row = $weight_result->fetch_assoc()) {
    $weight_data[] = $row;
}

$body_fat_data = [];
while ($row = $body_fat_result->fetch_assoc()) {
    $body_fat_data[] = $row;
}

$muscle_gain_data = [];
while ($row = $muscle_gain_result->fetch_assoc()) {
    $muscle_gain_data[] = $row;
}

$response = [
    'weight' => $weight_data,
    'body_fat' => $body_fat_data,
    'muscle_gain' => $muscle_gain_data
];

echo json_encode($response);

$conn->close();
?>
