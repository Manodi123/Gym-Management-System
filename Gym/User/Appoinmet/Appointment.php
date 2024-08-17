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
    <link rel="stylesheet" href="Dashboard2.css">
    <link rel="stylesheet" href="Appointment1.css">
    <link rel="stylesheet" href="style.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'><link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    
</head>
<body>
    <!-- Side Bar-->
    
    <div class="content">
        <!-- partial:index.partial.html -->
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
        
        
        
    <div class="main-content">
        <br>
        <form action="/Gym/User/Appoinmet/submit.php" method="post">
          <h2>Book an Appointment</h2>
      
          <label for="user_email">User Email:</label><br>
          <input type="email" id="user_email" name="user_email" required><br>
          <label for="trainer_email">Trainer Email:</label><br>
          <input type="email" id="trainer_email" name="trainer_email" required><br>
          <label for="appointment_date">Date:</label><br>
          <input type="date" id="appointment_date" name="appointment_date" required><br>
          <label for="appointment_time">Time:</label><br>
          <input type="time" id="appointment_time" name="appointment_time" required><br>
          <label for="message">Description:</label><br>
          <textarea id="message" name="message" rows="4" cols="50"></textarea><br>
          <input type="hidden" name="status" value="pending"><!-- Assuming default status is 'pending' -->
          <input type="submit" value="Confirm">
      </form>
      
        
        
           

    </div>
  </div>
</div>



    <script>
        let btn = document.querySelector('#btn');
        let sidebar = document.querySelector('.sidebar');

        btn.onclick = function() {
            sidebar.classList.toggle('active'); 
        };
        
        
    document.getElementById("logoutBtn").addEventListener("click", function() {
        // Perform logout actions here, such as clearing session storage, redirecting to the login page, etc.
        // For example, you can clear session storage:
        sessionStorage.clear();
        // Redirect to the login page
        window.location.href = "login.html"; // Replace "login.html" with the actual URL of your login page
    });




       

    </script>
</body>
</html>
