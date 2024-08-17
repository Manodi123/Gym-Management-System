<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: /Gym/Trainer/Signup/login.php");
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

// Insert schedule data if POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $trainerName = $data['trainerName'];
    $dayTimeStart = $data['dayTimeStart'];
    $dayTimeEnd = $data['dayTimeEnd'];
    $nightTimeStart = $data['nightTimeStart'];
    $nightTimeEnd = $data['nightTimeEnd'];

    $sql = "INSERT INTO trainer_schedule (trainerName, dayTimeStart, dayTimeEnd, nightTimeStart, nightTimeEnd) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdddd", $trainerName, $dayTimeStart, $dayTimeEnd, $nightTimeStart, $nightTimeEnd);

    if ($stmt->execute()) {
        echo "Schedule successfully set!";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <title>Trainer</title>
    <link rel="stylesheet" href="\Gym\Trainer\style.css">
    <link rel="stylesheet" href="Schedule.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'><link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        .time-range {
            margin-bottom: 20px;
            color:white;
        }

        .slider-container {
            position: relative;
            width: 100%;
        }

        .slider {
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: rgb(0, 0, 0);
        }
    
        

        th:first-child, td:first-child {
            border-left: 1px solid #ddd;
        }

        th:last-child, td:last-child {
            border-right: 1px solid #ddd;
        }

        h2 {
            margin-top: 0;
            color:white;
        }
    </style>

     
</head>

<body>
 
 <!-- Side Bar -->
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
            <div class="nav-button"><i class="fas fa-comments"></i><a href="\Gym\Chatapp\login.php"><span>Chat with Member</span></a></div>
            <div class="nav-button"><i class="fas fa-dumbbell"></i><a href="\Gym\Trainer\Woroutplan\TrainerWorkoutplan.php"><span>Workout Plan</span></a></div>
            <div class="nav-button"><i class="fa fa-list-alt"></i><a href="\Gym\Trainer\Todolist_trainer\index.php"><span>To do list</span></a></div>
            <div class="nav-button"><i class="fas fa-utensils"></i><a href="\Gym\Trainer\Mealplan\Mealplan.php"><span>Meal Plan</span></a></div>
            <div class="nav-button"><i class="fas fa-calendar-alt"></i><a href="TrainerSheduling.php"><span>Scheduling</span></a></div>
            <div class="nav-button"><i class="fas fa-user"></i><a href="\Gym\Trainer\trainer_user_details.php"><span>View User Details</span></a></div>
            <hr/>
            <div class="nav-button"><i class="fas fa-sign-out-alt"></i><a href="/Gym/Trainer/Signup/login.php"><span>Log-out</span></a></div>
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

    <div class="main-content">
 
      
    
    <div class="container">
        <div class="schedule">
            <h2>Time Scheduling</h2>
            <div class="time-range">
            <label for="trainer-name">Trainer Name</label>
            <input type="text" id="trainer-name" placeholder="Enter Trainer's name">
        </div>
            <div class="time-range">
                <label>Day time</label>
                <div class="slider-container">
                    <input type="range" id="day-time-start" class="slider" min="5" max="17" step="0.5" value="5">
                    <input type="range" id="day-time-end" class="slider" min="5" max="17" step="0.5" value="7.5">
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
                    <input type="range" id="night-time-start" class="slider" min="19" max="22" step="0.5" value="19">
                    <input type="range" id="night-time-end" class="slider" min="19" max="22" step="0.5" value="20">
                    <div class="labels">
                        <span>19.00</span>
                        <span>20.00</span>
                        <span>21.00</span>
                        <span>22.00</span>
                    </div>
                </div>
                <span id="night-time-display">19.00 - 20.00</span>
            </div>
            <button id="set-button">Set Time</button>
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
$sql = "SELECT * FROM client_schedule";
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

<!-- Render Trainer Schedule -->
<div class="trainer-schedule">
    <h2> Client Schedule</h2>
    <table>
        <tr>
            <th>Client Name</th>
            <th>Day Time Start</th>
            <th>Day Time End</th>
            <th>Night Time Start</th>
            <th>Night Time End</th>
        </tr>
        <?php foreach($trainerScheduleData as $schedule): ?>
            <tr>
                <td><?php echo $schedule['clientName']; ?></td>
                <td><?php echo $schedule['dayTimeStart']; ?></td>
                <td><?php echo $schedule['dayTimeEnd']; ?></td>
                <td><?php echo $schedule['nightTimeStart']; ?></td>
                <td><?php echo $schedule['nightTimeEnd']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</div>



<script>
document.getElementById('set-button').addEventListener('click', () => {
    const trainerName = document.getElementById('trainer-name').value;
    const dayTimeStart = parseFloat(document.getElementById('day-time-start').value);
    const dayTimeEnd = parseFloat(document.getElementById('day-time-end').value);
    const nightTimeStart = parseFloat(document.getElementById('night-time-start').value);
    const nightTimeEnd = parseFloat(document.getElementById('night-time-end').value);

    const scheduleData = {
        trainerName: trainerName,
        dayTimeStart: dayTimeStart,
        dayTimeEnd: dayTimeEnd,
        nightTimeStart: nightTimeStart,
        nightTimeEnd: nightTimeEnd
    };

    console.log("Sending data: ", scheduleData);

    fetch('', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(scheduleData),
    })
    .then(response => response.text())
    .then(data => {
        console.log("Response: ", data);  // Log the response from the server
        Swal.fire({
            icon: 'success',
            title: 'Success',
             // Assuming the PHP script returns the success message
        });
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});
</script>

</div>
</body>
</html>
