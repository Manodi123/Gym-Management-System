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

// Get the posted data
$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'];

$sql = "DELETE FROM user WHERE email = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);

$response = array();

if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['message'] = "Error deleting record: " . $conn->error;
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>
