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
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit();
}

$email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_FILES['profileImage']['name'])) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES['profileImage']['name']);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $targetFilePath)) {
            // Insert or update the image path in the user_profile_images table
            $sql = "INSERT INTO user_profile_images (email, image_path) VALUES (?, ?) ON DUPLICATE KEY UPDATE image_path = VALUES(image_path)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $email, $targetFilePath);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'imagePath' => $targetFilePath]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error updating profile image: ' . $stmt->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error uploading image file.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No image file selected.']);
    }

    $conn->close();
}
?>
