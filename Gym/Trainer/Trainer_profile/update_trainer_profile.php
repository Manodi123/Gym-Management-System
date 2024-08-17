<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "gym_management_db";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Failed to connect DB: " . $conn->connect_error);
}


session_start();

if (!isset($_SESSION['email'])) {
    header("Location: /Gym/User/Signup/login.html");
    exit();
}

$trainer_email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['Name'];
    $experience = $_POST['experience'];
    $phone = $_POST['phone'];
    $profile_image = $_FILES['profile_image'];

    $upload_dir = 'images/';
    $uploaded_file = $upload_dir . basename($profile_image['name']);
    
    if (move_uploaded_file($profile_image['tmp_name'], $uploaded_file)) {
        $sql = "UPDATE trainers SET name = ?, experience = ?, phone = ?, image_path = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $experience, $phone, $uploaded_file, $trainer_email);
    } else {
        $sql = "UPDATE trainers SET name = ?, experience = ?, phone = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $experience, $phone, $trainer_email);
    }

    if ($stmt->execute()) {
        header("Location: trainers_profile.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
