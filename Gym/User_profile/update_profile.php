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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_SESSION['email'];
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);

    $sql = "UPDATE user SET firstName = ?, lastName = ?, Phone = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $firstName, $lastName, $phone, $email);

    if ($stmt->execute()) {
        echo "Profile updated successfully.";
    } else {
        echo "Error updating profile: " . $stmt->error;
    }
    $stmt->close();

    // Handle profile image upload
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
                echo "Profile image updated successfully.";
            } else {
                echo "Error updating profile image: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error uploading image file.";
        }
    }

    $conn->close();
    header("Location: user_profile.php");
    exit();
}
?>
