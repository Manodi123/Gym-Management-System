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
  <title>Gym dashboard</title>
  <link rel="stylesheet" href="/Gym/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Protest+Revolution&family=Reddit+Mono:wght@200..900&display=swap" rel="stylesheet">
  <link rel="shortcut icon" type="x-icon" href="Images/logo.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="/Gym/Sidebar/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script>
    function notifyAdmin() {
      fetch('/Gym/User/Subscription/notify_admin.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email: '<?php echo $email; ?>' })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          Swal.fire({
            icon: 'success',
            title: 'Request Sent',
            text: 'Your subscription request has been sent to the admin.',
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'There was an error sending your request. Please try again.',
          });
        }
      });
    }
  </script>
</head>
<body>
  <div class="content">
    <div id="nav-bar">
      <input id="nav-toggle" type="checkbox"/>
      <div id="nav-header">
        <a id="nav-title" href="#" target="_blank">Hello <?php echo htmlspecialchars($firstName . ' '); ?></a>
        <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
        <hr/>
      </div>
      <div id="nav-content">
        <div class="nav-button"><i class="fa fa-line-chart"></i><a href="/Gym/User/Prograss/Dashboard.php"><span>Progress</span></a></div>
        <div class="nav-button"><i class="fa fa-list-alt"></i><a href="/Gym/User/todolist/todolist.php"><span>To do list</span></a></div>
        <div class="nav-button"><i class="fa fa-comments"></i><a href="/Gym/Chatapp/php/login.php"><span>Chat with trainer</span></a></div>
        <div class="nav-button"><i class="fa fa-calendar"></i><a href="/Gym/User/Timeshedule/Schedule.php"><span>Time scheduling</span></a></div>
        <div class="nav-button"><i class="fa fa-cutlery"></i><a href="/Gym/User/Mealplan/mealplan.php"><span>Meal plan</span></a></div>
        <div class="nav-button"><i class="fa fa-universal-access"></i><a href="/Gym/User/Workoutplan/Workoutplan.php"><span>Workout plan</span></a></div>
        <div class="nav-button"><i class="fa-solid fa-hand-holding-dollar"></i><a href="index.php"><span>Subscription</span></a></div>
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
            <img src="/Gym/User_profile/images/default.png" alt="Profile Image"/>
          </div>
          <div id="nav-footer-titlebox">
            <a id="nav-footer-title" href="/Gym/User_profile/user_profile.php" target="_blank">
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
    <section class="subscription-section">
      <div class="subscription-container">
        <h1 class="heading">Subscription Plan</h1>
        <div class="subscription-card">
          <div class="card">
            <img src="/Gym/Images/SVG/undraw_stability_ball_b-4-ia.svg" alt="Basic Plan">
            <div class="card-content">
              <h2>Basic</h2>
              <p>Provides access to basic functionalities to kickstart their fitness journey.</p>
              <ul>
                <li>Access to Gym Facilities</li>
                <li>Basic workout plans</li>
                <li>Progress Tracking</li>
                <li>Limited Support</li>
              </ul>
              <p class="price">Rs. 2500/-</p>
              <p>Per user <br> Per month</p>
            </div>
          </div>
          <div class="card">
            <img src="/Gym/Images/SVG/undraw_personal_training_0dqn.svg" alt="Plus Plan">
            <div class="card-content">
              <h2>Plus</h2>
              <p>Offers more flexibility and customization options compared to the basic plan.</p>
              <ul>
                <li>All Basic Plan Features</li>
                <li>Personalized Workout Plans</li>
                <li>Advanced Progress Tracking</li>
                <li>Nutrition Guidance</li>
              </ul>
              <p class="price">Rs. 4500/-</p>
              <p>Per user <br> Per month</p>
            </div>
          </div>
          <div class="card">
            <img src="/Gym/Images/SVG/undraw_indoor_bike_pwa4.svg" alt="Pro Plan">
            <div class="card-content">
              <h2>Pro</h2>
              <p>Offers advanced features and premium services for maximizing performance and results.</p>
              <ul>
                <li>All Plus Plan Features</li>
                <li>Personal Training Sessions</li>
                <li>Unlimited Classes</li>
                <li>Exclusive Benefits</li>
              </ul>
              <p class="price">Rs. 7500/-</p>
              <p>Per user <br> Per month</p>
            </div>
          </div>
        </div>
        <div class="btn-container">
        <button class="btn" onclick="notifyAdmin()">Notify Admin</button>
        </div>
      </div>
    </section>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    .subscription-section {
      padding: 20px;
      background-color: #f9f9f9;
    }
    .subscription-container {
      max-width: 1200px;
      margin: auto;
    }
    .heading {
      text-align: center;
      font-size: 2.5em;
      margin-bottom: 20px;
      color: #333;
    }
    .subscription-card {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
    }
    .card {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      max-width: 30%;
      margin: 20px;
      padding: 20px;
      text-align: center;
      flex: 1;
      transition: transform 0.3s;
    }
    .card:hover {
      transform: translateY(-10px);
    }
    .card img {
      max-width: 100px;
      margin-bottom: 15px;
    }
    .card-content {
      padding: 15px;
    }
    .card-content h2 {
      font-size: 1.5em;
      margin-bottom: 10px;
      color: #333;
    }
    .card-content p {
      font-size: 1em;
      margin-bottom: 15px;
      color: #666;
    }
    .card-content ul {
      list-style-type: none;
      padding: 0;
      margin-bottom: 15px;
    }
    .card-content ul li {
      margin-bottom: 10px;
      color: #666;
    }
    .price {
      font-size: 1.5em;
      color: #000;
      margin-bottom: 5px;
    }
    .btn-container {
      text-align: center;
      margin-top: 20px;
    }
    .btn {
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s;
    }
    .btn:hover {
      background-color: #0056b3;
    }
  </style>
  <script>
</body>
</html>
