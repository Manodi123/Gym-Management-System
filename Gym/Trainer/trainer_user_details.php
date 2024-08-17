<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: /Gym/User/Signup/login.html");
    exit();
}

$trainer_email = $_SESSION['email'];

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
$stmt->bind_param("s", $trainer_email);
$stmt->execute();
$stmt->bind_result($name, $image_path);
$stmt->fetch();
$stmt->close();

$user_details = null;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_email'])) {
    $user_email = $_POST['user_email'];
    
    // Fetch user details
    $sql = "SELECT firstName, lastName, email, phone, weight, gender, medical_report FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_details = $result->fetch_assoc();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Trainer - User Details</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style.css">
  <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .main-content {
        margin-left: 280px;
        padding: 20px;
        width: calc(80% - 260px);
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .form-group input, .form-group button {
        width: 100%;
        padding: 10px;
        margin: 5px 0 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .form-group button {
        color: #007BFF;
        background-color:#fff;
        border: 2px solid;
        width: 25%;
        padding: 8px 14px;
        font-size: 16px;
        border-radius: 10px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        transition: background-color 0.3s, color 0.3s;
    }
    .form-group button:hover {
        background-color: #007BFF;
        color: #fff;
    }
    .user-details {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .user-details p {
        margin: 10px 0;
    }
  </style>
</head>
<body>
<div class="contend">
    <div id="nav-bar">
            <input id="nav-toggle" type="checkbox"/>
            <div id="nav-header"><a id="nav-title" href="#" target="_blank">Hi, <?php echo htmlspecialchars($name); ?></a>
                <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
                <hr/>
            </div>
            <div id="nav-content">
            <div class="nav-button"><i class="fas fa-tachometer-alt"></i><a href="\Gym\Trainer\Appoinment\TrainerAppointment.php"><span>Appointment</span></a></div>
            <div class="nav-button"><i class="fas fa-comments"></i><a href="Trainerchat.php"><span>Chat with Member</span></a></div>
            <div class="nav-button"><i class="fas fa-dumbbell"></i><a href="\Gym\Trainer\Woroutplan\TrainerWorkoutplan.php"><span>Workout Plan</span></a></div>
            <div class="nav-button"><i class="fas fa-utensils"></i><a href="\Gym\Trainer\Mealplan\Mealplan.php"><span>Meal Plan</span></a></div>
            <div class="nav-button"><i class="fa fa-list-alt"></i><a href="\Gym\Trainer\Todolist_trainer\index.php"><span>To do list</span></a></div>
            <div class="nav-button"><i class="fas fa-calendar-alt"></i><a href="/Gym/Trainer/Trainer_shedule/TrainerScheduling.php"><span>Scheduling</span></a></div>
            <div class="nav-button"><i class="fas fa-user"></i><a href="\Gym\Trainer\trainer_user_details.php"><span>View User Details</span></a></div>
            <hr/>
            <div class="nav-button"><i class="fas fa-sign-out-alt"></i><a href="/Gym/Trainer/Signup/login.php"><span>Log-out</span></a></div>
            <hr/>
                <div id="nav-content-highlight"></div>
            </div>
            <input id="nav-footer-toggle" type="checkbox"/>
            <div id="nav-footer">
                <div id="nav-footer-heading">
                    <div id="nav-footer-avatar"><img src="https://gravatar.com/avatar/4474ca42d303761c2901fa819c4f2547"/></div>
                    <div id="nav-footer-titlebox"><a id="nav-footer-title" href="\Gym\Trainer\Trainer_profile\trainers_profile.php" target="_blank"><?php echo htmlspecialchars($name); ?></a><span id="nav-footer-subtitle">Trainer</span></div>
                    <label for="nav-footer-toggle"><i class="fas fa-caret-up"></i></label>
                </div>
                <div id="nav-footer-content">
                   
                </div>
            </div>
        </div>

    <div class="main-content">
        <h1>View User Details</h1>
        <form action="trainer_user_details.php" method="POST">
            <div class="form-group">
                <label for="user_email">User Email</label>
                <input type="email" id="user_email" name="user_email" required>
            <button type="submit">View Details</button>
            </div>
        </form>
        
        <?php if ($user_details): ?>
            <div class="user-details">
                <h2>User Details</h2>
                <p><strong>First Name:</strong> <?php echo htmlspecialchars($user_details['firstName']); ?></p>
                <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user_details['lastName']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user_details['email']); ?></p>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($user_details['phone']); ?></p>
                <p><strong>Weight:</strong> <?php echo htmlspecialchars($user_details['weight']); ?></p>
                <p><strong>Gender:</strong> <?php echo htmlspecialchars($user_details['gender']); ?></p>
                <?php if ($user_details['medical_report']): ?>
                    <p><strong>Medical Report:</strong> <a href="<?php echo htmlspecialchars($user_details['medical_report']); ?>" download>Download</a></p>
                <?php else: ?>
                    <p><strong>Medical Report:</strong> Not available</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
