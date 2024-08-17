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
$conn->close();
?>


<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <title>Trainer</title>
    
    <link rel="stylesheet" href="workoutplan1.css">
    <link rel="stylesheet" href="Trainer\style.css">
   
   <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'><link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        html, body {
    margin: 0;
    padding: 0;
    height: 100%;
    }

        body {
            background: #fff;
            background-size: 400% 400%;
            font-family: Arial, sans-serif;
            -webkit-animation: AnimationName 13s ease infinite;
            -moz-animation: AnimationName 13s ease infinite;
            -o-animation: AnimationName 13s ease infinite;
            animation: AnimationName 13s ease infinite;
            height: 100vh;
        }

        .content {
            height: 100vh;
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
        
        .container { width: 50%; margin: 20px auto;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3); 
        }
        .exercise { margin-bottom: 10px; }
        .content{height: 110vh;}
    </style>
</head>

<body>
 
 <!-- Side Bar -->
 <div class="content">
 <div id="nav-bar">
            <input id="nav-toggle" type="checkbox"/>
            <div id="nav-header"><a id="nav-title" href="#" target="_blank">Hi, <?php echo htmlspecialchars($name); ?></a>
                <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
                <hr/>
            </div>
            <div id="nav-content">
            <div class="nav-button"><i class="fas fa-tachometer-alt"></i><a href="\Gym\Trainer\Appoinment\TrainerAppointment.php"><span>Appointment</span></a></div>
            <div class="nav-button"><i class="fas fa-comments"></i><a href="\Gym\Chatapp\login.php"><span>Chat with Member</span></a></div>
            <div class="nav-button"><i class="fas fa-dumbbell"></i><a href="\Gym\Trainer\Woroutplan\TrainerWorkoutplan.php"><span>Workout Plan</span></a></div>
            <div class="nav-button"><i class="fas fa-utensils"></i><a href="\Gym\Trainer\Mealplan\Mealplan.php"><span>Meal Plan</span></a></div>
            <div class="nav-button"><i class="fa fa-list-alt"></i><a href="\Gym\Trainer\Todolist_trainer\index.php"><span>To do list</span></a></div>
            <div class="nav-button"><i class="fas fa-calendar-alt"></i><a href="\Gym\Trainer\Trainer_shedule\TrainerScheduling.php"><span>Scheduling</span></a></div>
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
<div class="container">
    <h2>Assign Workouts</h2>
    <form action="assign_workout.php" method="post">
        <div class="form-row">
            <label for="assigned_by">Assigned By</label>
            <input type="text" id="assigned_by" name="assigned_by" required>
        </div>
        <div class="form-row">
            <label for="user_email">User Email</label>
            <input type="text" id="user_email" name="user_email" required>
        </div>
        <div class="form-row">
            <label for="from_date">From Date</label>
            <input type="date" id="from_date" name="from_date" required>
        </div>
        <div class="form-row">
            <label for="no_of_days_repeat">No of Days Repeat</label>
            <input type="number" id="no_of_days_repeat" name="no_of_days_repeat" required>
        </div>

        <h3>Workouts</h3>
        <div id="workout-section">
            <div class="workout-entry">
                <label for="day">Day</label>
                <select name="day[]" required>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
                <label for="workout">Workout</label>
                <input type="text" name="workout[]" required>
                <label for="weight">Weight (Kg)</label>
                <input type="number" name="weight[]" required>
                <label for="sets">Sets</label>
                <input type="number" name="sets[]" required>
                <label for="reps">Reps</label>
                <input type="number" name="reps[]" required>
                <label for="rest">Rest (min)</label>
                <input type="number" name="rest[]" required>
                <label for="description">Description</label>
                <input type="text" name="description[]">
            </div>
        </div>
        <button type="button" onclick="addWorkout()">Add New</button>
        <button type="submit">Assign</button>
    </form>
</div>
</div>
<script>
    function addWorkout() {
        const workoutSection = document.getElementById('workout-section');
        const workoutEntry = document.createElement('div');
        workoutEntry.classList.add('workout-entry');
        
        workoutEntry.innerHTML = `
            <label for="day">Day</label>
            <select name="day[]" required>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>
            <label for="workout">Workout</label>
            <input type="text" name="workout[]" required>
            <label for="weight">Weight (Kg)</label>
            <input type="number" name="weight[]" required>
            <label for="sets">Sets</label>
            <input type="number" name="sets[]" required>
            <label for="reps">Reps</label>
            <input type="number" name="reps[]" required>
            <label for="rest">Rest (min)</label>
            <input type="number" name="rest[]" required>
            <label for="description">Description</label>
            <input type="text" name="description[]">
        `;
        
        workoutSection.appendChild(workoutEntry);
    }
</script>



</body>
<html>