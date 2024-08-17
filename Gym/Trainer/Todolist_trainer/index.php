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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer's To-Do List Management</title>
    <link rel="stylesheet" href="\Gym\Trainer\style.css">
    <link rel="stylesheet" href="trainers_todolist.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    
         <!-- Side Bar -->
 <div >
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
            <div class="nav-button"><i class="fa fa-list-alt"></i><a href="index.php"><span>To do list</span></a></div>
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
    <div class="container">
        <h1>Trainer's To-Do List Management</h1>
        <div class="request-list">
            <h2>Pending To-Do List Requests</h2>
            <ul id="requestList"></ul>
        </div>
        <div class="todo-form">
            <h2>Create To-Do List</h2>
            <form id="todoForm">
                <label for="userEmail">User Email:</label>
                <input type="email" id="userEmail" name="userEmail" required readonly>
                
                <label for="task">Task:</label>
                <input type="text" id="task" name="task" required>
                
                <label for="deadline">Deadline:</label>
                <input type="date" id="deadline" name="deadline" required>
                
                <label for="priority">Priority:</label>
                <select id="priority" name="priority">
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
                
                <button type="submit">Add Task</button>
            </form>
        </div>
    </div>
</div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    loadRequests();

    document.getElementById('todoForm').addEventListener('submit', function(event) {
        event.preventDefault();
        createToDoList();
    });

    function loadRequests() {
        fetch('get_requests.php')
            .then(response => response.json())
            .then(data => {
                const requestList = document.getElementById('requestList');
                requestList.innerHTML = '';
                data.forEach(request => {
                    const li = document.createElement('li');
                    li.textContent = request.user_email;
                    const button = document.createElement('button');
                    button.textContent = 'Create To-Do List';
                    button.onclick = () => {
                        document.getElementById('userEmail').value = request.user_email;
                    };
                    li.appendChild(button);
                    requestList.appendChild(li);
                });
            })
            .catch(error => console.error('Error loading requests:', error));
    }

    function createToDoList() {
        const formData = new FormData(document.getElementById('todoForm'));
        formData.append('trainerEmail', 'trainer@example.com'); // Replace with actual trainer email

        fetch('create_todo.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('To-Do List Created Successfully');
                document.getElementById('todoForm').reset();
                loadRequests();
            } else {
                alert('Error Creating To-Do List');
            }
        })
        .catch(error => console.error('Error creating to-do list:', error));
    }
});

    </script>
</body>
</html>
