<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym_management_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT user_email FROM to_do_requests WHERE status = 'Pending'";
$result = $conn->query($sql);

$requests = array();
while($row = $result->fetch_assoc()) {
    $requests[] = $row;
}

echo json_encode($requests);

$conn->close();
?>
