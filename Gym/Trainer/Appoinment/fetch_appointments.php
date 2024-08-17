<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym_management_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$trainer_email = $_GET['trainer_email'];
$sql = "SELECT * FROM appointments WHERE trainer_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $trainer_email);
$stmt->execute();
$result = $stmt->get_result();

$appointments = [];
while ($row = $result->fetch_assoc()) {
    $appointments[] = $row;
}

echo json_encode($appointments);
$stmt->close();
$conn->close();
?>
