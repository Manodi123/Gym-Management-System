<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: /Gym/User/Signup/login.html");
    exit();
}

$email = $_SESSION['email'];

$host = "localhost";
$user = "root";
$pass = "";
$db = "gym_management_db";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Failed to connect DB: " . $conn->connect_error);
}

// Fetch trainer details
$sql = "SELECT Name, image_path FROM trainers WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($name, $image_path);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Gym Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="content">
    <div id="nav-bar">
        <input id="nav-toggle" type="checkbox"/>
        <div id="nav-header">
            <a id="nav-title" href="#" target="_blank">Hi, <?php echo htmlspecialchars($name); ?></a>
            <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
            <hr/>
        </div>
        <div id="nav-content">
            <div class="nav-button"><i class="fas fa-tachometer-alt"></i><a href="\Gym\Trainer\Appoinment\TrainerAppointment.php"><span>Appointment</span></a></div>
            <div class="nav-button"><i class="fas fa-comments"></i><a href="Trainerchat.php"><span>Chat with Member</span></a></div>
            <div class="nav-button"><i class="fas fa-dumbbell"></i><a href="\Gym\Trainer\Woroutplan\TrainerWorkoutplan.php"><span>Workout Plan</span></a></div>
            <div class="nav-button"><i class="fa fa-list-alt"></i><a href="\Gym\Trainer\Todolist_trainer\index.php"><span>To do list</span></a></div>
            <div class="nav-button"><i class="fas fa-utensils"></i><a href="\Gym\Trainer\Mealplan\Mealplan.php"><span>Meal Plan</span></a></div>
            <div class="nav-button"><i class="fas fa-calendar-alt"></i><a href="\Gym\Trainer\Todolist_trainer\index.html"><span>Scheduling</span></a></div>
            <hr/>
            <div class="nav-button"><i class="fas fa-sign-out-alt"></i><a href="#"><span>Log-out</span></a></div>
            <hr/>
            <div id="nav-content-highlight"></div>
        </div>
        <input id="nav-footer-toggle" type="checkbox"/>
        <div id="nav-footer">
            <div id="nav-footer-heading">
                <div id="nav-footer-avatar">
                    <img src="\Gym\Trainer\Trainer_profile\images\default.png" alt="Profile Image"/>
                </div>
                <div id="nav-footer-titlebox">
                    <a id="nav-footer-title" href="\Gym\Trainer\Trainer_profile\trainers_profile.php" target="_blank"><?php echo htmlspecialchars($name); ?></a>
                    <span id="nav-footer-subtitle">Trainer</span>
                </div>
                <label for="nav-footer-toggle"><i class="fas fa-caret-up"></i></label>
            </div>
            <div id="nav-footer-content">
                <!-- Additional content can be added here -->
            </div>
        </div>
    </div>
</div>
</body>
</html>
