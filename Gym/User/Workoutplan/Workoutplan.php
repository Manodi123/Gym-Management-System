
<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db = "gym_management_db";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Failed to connect DB: " . $conn->connect_error);
}

if (!isset($_SESSION['email'])) {
    header("Location: /Gym/User/Signup/login.html");
    exit();
}

$email = $_SESSION['email'];

// Fetch user details including the profile image
$sql = "SELECT firstName, lastName, image_path FROM user WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($firstName, $lastName, $image_path);
$stmt->fetch();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Dashboard1.css.">
    <link rel="stylesheet" href="workoutplan.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'><link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 


    
</head>
<body>
    <!-- Side Bar-->
    
    <div class="content">
    <div id="nav-bar">
      <input id="nav-toggle" type="checkbox"/>
      <div id="nav-header">
        <a id="nav-title" href="#" target="_blank">Hello <?php echo htmlspecialchars($firstName . ' '); ?></a>
        <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
        <hr/>
      </div>
      <div id="nav-content">
        <div class="nav-button"><i class="fa fa-line-chart"></i><a href="\Gym\User\Prograss\Dashboard.php"><span>Progress</span></a></div>
        <div class="nav-button"><i class="fa fa-list-alt"></i><a href="/Gym/User/todolist/todolist.php"><span>To do list</span></a></div>
        <div class="nav-button"><i class="fa fa-comments"></i><a href="\Gym\Chatapp\login.php"><span>Chat with trainer</span></a></div>
        <div class="nav-button"><i class="fa fa-calendar"></i><a href="\Gym\User\Timeshedule\Schedule.php"><span>Time scheduling</span></a></div>
        <div class="nav-button"><i class="fa fa-cutlery"></i><a href="/Gym/User/Mealplan/mealplan.php"><span>Meal plan</span></a></div>
        <div class="nav-button"><i class="fa fa-universal-access"></i><a href="\Gym\User\Workoutplan\Workoutplan.php"><span>Workout plan</span></a></div>
        <div class="nav-button"><i class="fa-solid fa-hand-holding-dollar"></i><a href="\Gym\User\Subscription\index.php"><span>Subscription</span></a></div>
        <div class="nav-button"><i class="fa fa-window-restore"></i><a href="/Gym/User/Appoinmet/Appointment.php"><span>Appointment</span></a></div>
        <hr/>
        <div class="nav-button"><i class="fa fa-sign-out"></i><a href="/Gym/index.html"><span>Log-out</span></a></div>
        <hr/>
        <div id="nav-content-highlight"></div>
      </div>
      <input id="nav-footer-toggle" type="checkbox"/>
      <div id="nav-footer">
        <div id="nav-footer-heading">
          <div id="nav-footer-avatar">
            <img src="\Gym\User_profile\images\default.png" alt="Profile Image"/>
          </div>
          <div id="nav-footer-titlebox">
            <a id="nav-footer-title" href="\Gym\User_profile\user_profile.php" target="_blank">
              <?php echo htmlspecialchars($firstName . ' ' ); ?>
            </a>
            <span id="nav-footer-subtitle">User</span>
          </div>
          <label for="nav-footer-toggle"><i class="fas fa-caret-up"></i></label>
        </div>
        <div id="nav-footer-content">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
      </div>
    </div>

<br><br>
    
<div class="main-content">

<?php


$user_id = $_SESSION['email'];

// Connect to the database
$conn = new mysqli("localhost", "root", "", "gym_management_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch workout plan data
$plan_query = "SELECT * FROM workout_plan WHERE user_id = ?";
$stmt = $conn->prepare($plan_query);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$plan_result = $stmt->get_result();
$plan = $plan_result->fetch_assoc();
$stmt->close();

// Check if plan exists
if (!$plan) {
    die("Error: Workout plan for User ID $user_id not found.");
}

// Fetch workout details
$workouts_query = "SELECT * FROM workouts WHERE plan_id = ?";
$stmt = $conn->prepare($workouts_query);
$stmt->bind_param("i", $plan['plan_id']);
$stmt->execute();
$workouts_result = $stmt->get_result();
$workouts = $workouts_result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$conn->close();
?>

<div class="workout-plan">
        <h2>Workout Plan</h2>
        <p>Assigned By: <?php echo htmlspecialchars($plan['assigned_by']); ?></p>
        <p>From Date: <?php echo htmlspecialchars($plan['from_date']); ?></p>
        <p>No of Days Repeat: <?php echo htmlspecialchars($plan['no_of_days_repeat']); ?></p>

        <h3>Workouts</h3>
                <?php foreach ($workouts as $workout): ?>
                    <div class="workout-item">
                        <h3>Day: <?php echo htmlspecialchars($workout['day']); ?> - <?php echo htmlspecialchars($workout['workout']); ?></h3>
                        <div class="workout-details">
                            <p>Weight: <?php echo htmlspecialchars($workout['weight']); ?> Kg</p>
                            <p>Sets: <?php echo htmlspecialchars($workout['sets']); ?></p>
                            <p>Reps: <?php echo htmlspecialchars($workout['reps']); ?></p>
                            <p>Rest: <?php echo htmlspecialchars($workout['rest']); ?> min</p>
                            <p>Description: <?php echo htmlspecialchars($workout['description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <a href="download_pdf.php" class="download-button">Download PDF</a>
        </div>
    </div>
</body>
</html>