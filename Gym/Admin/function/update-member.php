<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: /gym/admin/signup/login.html");
    exit();
}

$host = "localhost";
$user = "root";
$pass = "";
$db = "gym_management_db";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Failed to connect DB: " . $conn->connect_error);
}

$response = array('success' => false);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $weight = $_POST['weight'];
    $gender = $_POST['gender'];

    $query = "UPDATE user SET firstName = ?, lastName = ?, email = ?, Phone = ?, weight = ?, gender = ? WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssiss", $firstName, $lastName, $email, $phone, $weight, $gender, $userId);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['error'] = $stmt->error;
    }

    $stmt->close();
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
