<?php
session_start();

if (!isset($_SESSION['email'])) {
    // Redirect to login page if not logged in
    header("Location: /gym/admin/signup/login.html");
    exit();
}

$email = $_SESSION['email'];

$host = "localhost";
$user = "root";
$pass = "";
$db = "gym_management_db";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Failed to connect to DB: " . $conn->connect_error);
}

// Your code to handle admin actions goes here
?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Gym dashbord</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    /* Reset default margin and padding */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Arial', sans-serif;
  background-color: #ecf0f1;
}

.gce {
  padding: 40px;
  width: 100%;
  min-height: 100vh;
}

.dashboard-container {
  max-width: 1000px;
  margin-left: 280px;
  margin: auto;
  background: #fff;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.dashboard-container h1 {
  font-size: 36px;
  color: #2c3e50;
  margin-bottom: 30px;
  text-align: center;
}

.card {
  background: white;
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  padding: 20px;
  margin: 20px 0;
  text-align: center;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.card i {
  color: #f39c12;
}

.card h2 {
  margin-top: 10px;
  font-size: 20px;
  color: #333;
}

  </style>
</head>
<body>
  <div class="content">
<!-- partial:index.partial.html -->
<div id="nav-bar">
  <input id="nav-toggle" type="checkbox"/>
  <div id="nav-header"><a id="nav-title" href="#" target="_blank">GYM
  <?php 
   if(isset($_SESSION['name'])){
    $name=$_SESSION['name'];
    $query=mysqli_query($conn, "SELECT * FROM `admin` WHERE name='$name'");
    while($row=mysqli_fetch_array($query)){
        echo $row['name'];
    }
   }
   ?>
  </a>
    <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
    <hr/>
  </div>
  <div id="nav-content">
          <div class="nav-button"><i class="fas fa-tachometer-alt"></i></i><a href="/gym/admin/function/AdminDashbaord.php"><span>Dashboard</span></a></div>
          <div class="nav-button"><i class="fa fa-users"></i><a href="Memeber.php"><span>Member List</span></a></div>
          <div class="nav-button"><i class="fa fa-user-plus"></i><a href="Memberentry.php"><span>Member Entry</span></a></div>
          <div class="nav-button"><i class="fa fa-users-cog"></i><a href="Trainerlist.php"><span>Trainer List</span></a></div>
          <div class="nav-button"><i class="fa fa-user-tie"></i><a href="Trainerentry.php"><span>Trainer Entry</span></a></div>
          <div class="nav-button"><i class="fas fa-clipboard-check"></i><a href="/gym/admin/function/Attendance.php"><span>Attendance</span></a></div>
          <div class="nav-button"><i class="fa fa-comment-dots"></i><a href="Subscription_req.php"><span>Subscription Request</span></a></div>
    <hr/>
    <div class="nav-button"><i class="fa fa-sign-out"></i><a href="/gym/admin/signup/login.html"><span>Log-out</span></a></div>
    <hr/>
    <div id="nav-content-highlight"></div>
  </div>
  <input id="nav-footer-toggle" type="checkbox"/>
  <div id="nav-footer">
    <div id="nav-footer-heading">
      <div id="nav-footer-avatar"><img src="https://gravatar.com/avatar/4474ca42d303761c2901fa819c4f2547"/></div>
      <div id="nav-footer-titlebox"><a id="nav-footer-title" href="#" target="_blank">User</a><span id="nav-footer-subtitle">Admin</span></div>
      <label for="nav-footer-toggle"><i class="fas fa-caret-up"></i></label>
    </div>
    <div id="nav-footer-content">
      <Lorem>ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</Lorem>
    </div>
  </div>
</div>
<div class="gce">
        <div class="dashboard-container">
            <h1>Welcome to Admin Dashboard</h1>
            <?php
                // Database connection parameters
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

                // Query to count total members
                $sqlMembers = "SELECT COUNT(*) as totalMembers FROM user";
                $resultMembers = $conn->query($sqlMembers);
                $rowMembers = $resultMembers->fetch_assoc();
                $totalMembers = $rowMembers['totalMembers'];

                // Query to count total trainers
                $sqlTrainers = "SELECT COUNT(*) as totalTrainers FROM trainers";
                $resultTrainers = $conn->query($sqlTrainers);
                $rowTrainers = $resultTrainers->fetch_assoc();
                $totalTrainers = $rowTrainers['totalTrainers'];

                // Close the database connection
                $conn->close();
            ?>
            <div class="card">
                <i class="fas fa-users fa-3x icon"></i>
                <h2>Total Members: <?php echo $totalMembers; ?></h2>
            </div>
            <div class="card">
                <i class="fas fa-user-tie fa-3x icon"></i>
                <h2>Total Trainers: <?php echo $totalTrainers; ?></h2>
            </div>
            <div class="card">
                <i class="fas fa-credit-card fa-3x icon"></i>
                <h2>No Of Subscription Plans: 3</h2>
            </div>
        </div>
    </div>


</div>
</body>
</html>