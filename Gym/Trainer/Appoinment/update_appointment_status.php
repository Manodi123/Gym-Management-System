<?php
session_start();

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

// Fetch and sanitize input data
$data = json_decode(file_get_contents('php://input'), true);
$appointment_id = $data['appointment_id'];
$status = $data['status'];

error_log("Appointment ID: $appointment_id, Status: $status");

// Update appointment status
$sql = "UPDATE appointments SET status = ? WHERE appointment_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $appointment_id);

$response = [];
if ($stmt->execute()) {
    $response['success'] = true;

    // Fetch the updated appointment details
    $sql = "SELECT * FROM appointments WHERE appointment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $appointment = $result->fetch_assoc();
    $response['appointment'] = $appointment;
} else {
    $response['success'] = false;
    error_log("Error: " . $stmt->error);
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
