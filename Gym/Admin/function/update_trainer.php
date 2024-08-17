<?php
session_start();

if (!isset($_SESSION['email'])) {
    // Redirect to login page if not logged in
    header("Location: /gym/admin/signup/login.html");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym_management_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trainerId = $_POST['trainerId'];
    $name = $_POST['name'];
    $id = $_POST['id'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $experience = $_POST['experience'];

    $stmt = $conn->prepare("UPDATE trainers SET Name=?, ID=?, email=?, phone=?, experience=? WHERE email=?");
    $stmt->bind_param("ssssss", $name, $id, $email, $phone, $experience, $trainerId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
}

$conn->close();
?>
