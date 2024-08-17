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
    <link rel="stylesheet" href="Schedule1.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'><link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <style>
        
        body {
            background: #fff;
            background-size: 400% 400%;
            -webkit-animation: AnimationName 13s ease infinite;
            -moz-animation: AnimationName 13s ease infinite;
            -o-animation: AnimationName 13s ease infinite;
            animation: AnimationName 13s ease infinite;
            font-family:'Times New Roman', Times, serif; 
            margin: 0;
            padding: 0;
        }

        @-webkit-keyframes AnimationName {
            0%{background-position:0% 51%}
            50%{background-position:100% 50%}
            100%{background-position:0% 51%}
        }
        @-moz-keyframes AnimationName {
            0%{background-position:0% 51%}
            50%{background-position:100% 50%}
            100%{background-position:0% 51%}
        }
        @-o-keyframes AnimationName {
            0%{background-position:0% 51%}
            50%{background-position:100% 50%}
            100%{background-position:0% 51%}
        }
        @keyframes AnimationName {
            0%{background-position:0% 51%}
            50%{background-position:100% 50%}
            100%{background-position:0% 51%}
        }

        .container {
            max-width: 700px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
           
        }

        .schedule {
            margin-top: 20px;
        }

        .schedule h2{
            color: black;
        }

        .time-range {
            margin-bottom: 20px;
        }

        .slider-container {
            position: relative;
            width: 100%;
        }

        .slider-container span{
            color: black;
        }

        #day-time-display{
            color: black;
        }
        
        #night-time-display{
            color: black;
        }

        .slider {
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #fff;
            
        }

        th {
            background-color:#007BFF;
            color: #fff;
    
        }

        th:first-child, td:first-child {
            border-left: 1px solid black;
        }

        th:last-child, td:last-child {
            border-right: 1px solid black;
        }

        h2 {
            color: black;
            margin-top: 0;
            text-align: center;
        }

        .time-range label{
            color: black;
            font-size: 1.4rem;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .time-range input{
            padding: 10px 20px;
            width: 240px;
            border-radius: 8px;
            font: bold;
        }

        

    </style>

</head>
<body>
     <!-- Side Bar-->
    
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


</div>

    <br><br>

<div class="main-content">
    <div class="container">
        <div class="schedule">
            <h2>Time Scheduling</h2>
            <form action="schedule.php" method="post">
                <div class="time-range">
                    <label for="client-name">Client Name</label>
                    <input type="text" id="client-name" name="client_name" placeholder="Enter client's name">
                </div>
                <div class="time-range">
                    <label>Day time</label>
                    <div class="slider-container">
                        <input type="range" id="day-time-start" name="day_time_start" class="slider" min="5" max="17" step="0.5" value="5">
                        <input type="range" id="day-time-end" name="day_time_end" class="slider" min="5" max="17" step="0.5" value="7.5">
                        <div class="labels">
                            <span>5.00</span>
                            <span>6.00</span>
                            <span>7.00</span>
                            <span>8.00</span>
                            <span>9.00</span>
                            <span>10.00</span>
                            <span>11.00</span>
                            <span>12.00</span>
                            <span>13.00</span>
                            <span>14.00</span>
                            <span>15.00</span>
                            <span>16.00</span>
                            <span>17.00</span>
                        </div>
                    </div>
                    <span id="day-time-display">5.00 - 7.50</span>
                </div>
                <div class="time-range">
                    <label>Night time</label>
                    <div class="slider-container">
                        <input type="range" id="night-time-start" name="night_time_start" class="slider" min="19" max="22" step="0.5" value="19">
                        <input type="range" id="night-time-end" name="night_time_end" class="slider" min="19" max="22" step="0.5" value="20">
                        <div class="labels">
                            <span>19.00</span>
                            <span>20.00</span>
                            <span>21.00</span>
                            <span>22.00</span>
                        </div>
                    </div>
                    <span id="night-time-display">19.00 - 20.00</span>
                </div>
                <button type="submit" id="set-button">Set Time</button>
            </form>
        </div>
    </div>
</div>

    
    <?php
// Fetch Trainer Schedule Data
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

// Fetch Trainer Schedule Data
$sql = "SELECT * FROM trainer_schedule";
$result = $conn->query($sql);

$trainerScheduleData = [];
if ($result->num_rows > 0) {
    // Store trainer schedule data in an array
    while($row = $result->fetch_assoc()) {
        $trainerScheduleData[] = $row;
    }
}

$conn->close();
?>

<?php

// Database connection details
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clientName = $_POST['client_name'];
    $dayTimeStart = $_POST['day_time_start'];
    $dayTimeEnd = $_POST['day_time_end'];
    $nightTimeStart = $_POST['night_time_start'];
    $nightTimeEnd = $_POST['night_time_end'];

    // Insert the schedule into the client_schedule table
    $sql = "INSERT INTO client_schedule (clientName, dayTimeStart, dayTimeEnd, nightTimeStart, nightTimeEnd) VALUES (?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sdddd", $clientName, $dayTimeStart, $dayTimeEnd, $nightTimeStart, $nightTimeEnd);

        if ($stmt->execute()) {
            // Redirect to HTML page and show success alert using JavaScript
            echo '<!DOCTYPE html>
                  <html lang="en">
                  <head>
                      <meta charset="UTF-8">
                      <meta name="viewport" content="width=device-width, initial-scale=1.0">
                      <title>Time Scheduled</title>
                      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                  </head>
                  <body>
                      <script type="text/javascript">
                          Swal.fire({
                              icon: "success",
                              title: "Time Scheduled",
                              text: "Your time has been successfully scheduled!",
                              timer: 4000,
                              showConfirmButton: false
                          
                          });
                      </script>
                  </body>
                  </html>';
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
}
?>




<!-- Render Trainer Schedule -->
<div class="trainer-schedule">
    <h2>Trainer Schedule</h2>
    <table>
        <tr>
            <th>Trainer Name</th>
            <th>Day Time Start</th>
            <th>Day Time End</th>
            <th>Night Time Start</th>
            <th>Night Time End</th>
        </tr>
        <?php foreach($trainerScheduleData as $schedule): ?>
            <tr>
                <td><?php echo $schedule['trainerName']; ?></td>
                <td><?php echo $schedule['dayTimeStart']; ?></td>
                <td><?php echo $schedule['dayTimeEnd']; ?></td>
                <td><?php echo $schedule['nightTimeStart']; ?></td>
                <td><?php echo $schedule['nightTimeEnd']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>


<script>
document.getElementById('set-button').addEventListener('click', () => {
    const clientName = document.getElementById('client-name').value;
    const dayTimeStart = parseFloat(document.getElementById('day-time-start').value);
    const dayTimeEnd = parseFloat(document.getElementById('day-time-end').value);
    const nightTimeStart = parseFloat(document.getElementById('night-time-start').value);
    const nightTimeEnd = parseFloat(document.getElementById('night-time-end').value);

    const scheduleData = {
        clientName: clientName,
        dayTimeStart: dayTimeStart,
        dayTimeEnd: dayTimeEnd,
        nightTimeStart: nightTimeStart,
        nightTimeEnd: nightTimeEnd
    };

    fetch('client_schedule.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(scheduleData),
    })
    .then(response => response.text())
    .then(data => {
        // Display success message returned by the PHP script
        document.getElementById('response-message').innerText = data;
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});

</script>


<script>
document.addEventListener('DOMContentLoaded', () => {
  const dayTimeStart = document.getElementById('day-time-start');
  const dayTimeEnd = document.getElementById('day-time-end');
  const nightTimeStart = document.getElementById('night-time-start');
  const nightTimeEnd = document.getElementById('night-time-end');
  const dayTimeDisplay = document.getElementById('day-time-display');
  const nightTimeDisplay = document.getElementById('night-time-display');

  const formatTime = (time) => {
      const hours = Math.floor(time);
      const minutes = (time % 1) * 60;
      return `${hours}.${minutes < 10 ? '0' : ''}${minutes}`;
  };

  const updateDayTimeDisplay = () => {
      const startTime = parseFloat(dayTimeStart.value);
      const endTime = parseFloat(dayTimeEnd.value);
      dayTimeDisplay.textContent = `${formatTime(startTime)} - ${formatTime(endTime)}`;
  };

  const updateNightTimeDisplay = () => {
      const startTime = parseFloat(nightTimeStart.value);
      const endTime = parseFloat(nightTimeEnd.value);
      nightTimeDisplay.textContent = `${formatTime(startTime)} - ${formatTime(endTime)}`;
  };

  dayTimeStart.addEventListener('input', updateDayTimeDisplay);
  dayTimeEnd.addEventListener('input', updateDayTimeDisplay);
  nightTimeStart.addEventListener('input', updateNightTimeDisplay);
  nightTimeEnd.addEventListener('input', updateNightTimeDisplay);

  // Initial update
  updateDayTimeDisplay();
  updateNightTimeDisplay();
});


</script>

  
<script>
    let btn = document.querySelector('#btn');
    let sidebar = document.querySelector('.sidebar');

    btn.onclick = function() {
        sidebar.classList.toggle('active'); 
    };
        
    document.getElementById("logoutBtn").addEventListener("click", function() {
        sessionStorage.clear();
        // Redirect to the login page
        window.location.href = "login.html"; 
    });
</script>


</body>
</html>