<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['email'])) {
    header("Location: /Gym/Trainer/signup/login.php");
    exit();
}

$email = $_SESSION['email'];

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

// Fetch pending appointments for the trainer
$trainer_email = $email; // Replace with the logged-in trainer's email
$sql = "SELECT * FROM appointments WHERE trainer_email = ? AND status = 'pending'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $trainer_email);
$stmt->execute();
$result = $stmt->get_result();

$pending_appointments = [];
while ($row = $result->fetch_assoc()) {
    $pending_appointments[] = $row;
}
$stmt->close();

// Fetch accepted appointments for the trainer
$sql_accepted = "SELECT * FROM appointments WHERE trainer_email = ? AND status = 'accepted'";
$stmt_accepted = $conn->prepare($sql_accepted);
$stmt_accepted->bind_param("s", $trainer_email);
$stmt_accepted->execute();
$result_accepted = $stmt_accepted->get_result();

$accepted_appointments = [];
while ($row_accepted = $result_accepted->fetch_assoc()) {
    $accepted_appointments[] = $row_accepted;
}
$stmt_accepted->close();

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer</title>
    <link rel="stylesheet" href="/Gym/Trainer/style.css">
    
    <link rel="stylesheet" href="Appointment1.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .content{
            width: auto;
            height: 130vh;
        }

        body {
    font-family: Arial, sans-serif;
    background: #fff;
    background-size: 400% 400%;
    -webkit-animation: AnimationName 13s ease infinite;
    -moz-animation: AnimationName 13s ease infinite;
    -o-animation: AnimationName 13s ease infinite;
    animation: AnimationName 13s ease infinite;
    
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

        .main-content{
            margin-top: 80px;
            margin-left: 480px;
        }

        .appointment-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 20px;
            padding: 15px;
            width: 480px;
            height: auto;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: transform 0.3s;
        }
        

        .appointment-card:hover {
            transform: scale(1.02);
        }

        .appointment-header {
            font-weight: bold;
            color: #000;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .appointment-body {
            color: #555;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .appointment-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .accept-btn, .reject-btn {
            text-decoration: none;
            color: #000;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            display: inline-block;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .accept-btn {
            background-color: #28a745; /* Green */
        }

        .accept-btn:hover {
            background-color: #218838;
        }

        .reject-btn {
            background-color: #dc3545; /* Red */
        }

        .reject-btn:hover {
            background-color: #c82333;
        }

        h2,h3,p {
            color: #000;
        }

        .font {
            color: #000;
            font-family: 'Arial', sans-serif;
            font-size: 36px;
            margin: 20px;
        }

        .appointment-container {
            flex-wrap: wrap;
            justify-content: center;
        }

        .no-appointments {
            text-align: center;
            font-size: 18px;
            color: #777;
            margin: 20px;
        }
        .appointment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .appointment-details {
            margin-top: 10px;
        }

        .appointment-actions {
            margin-top: 10px;
            text-align: right;
        }

        .appointment-actions button {
            margin-left: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .accept-btn {
            background-color: #28a745;
            color: #fff;
        }

        .reject-btn {
            background-color: #dc3545;
            color: #fff;
        }
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
<div class="font">Appointment Management</div>

<div class="appointment-container">
<h2>Pending Appointments</h2>
    <div id="pending-appointments">
        <?php if (empty($pending_appointments)): ?>
        <p class="no-appointments">No pending appointments.</p>
        <?php else: ?>
        <?php foreach ($pending_appointments as $appointment): ?>
        <div class="appointment-card" id="appointment-<?php echo $appointment['appointment_id']; ?>">
            <div class="appointment-header">
                <h3>Appointment with <?php echo $appointment['user_email']; ?></h3>
            </div>
            <div class="appointment-details">
                <p>Date: <?php echo $appointment['appointment_date']; ?></p>
                <p>Notes: <?php echo $appointment['message']; ?></p>
            </div>
            <div class="appointment-actions">
                <button class="accept-btn" onclick="updateAppointmentStatus(<?php echo $appointment['appointment_id']; ?>, 'accepted')">Accept</button>
                <button class="reject-btn" onclick="updateAppointmentStatus(<?php echo $appointment['appointment_id']; ?>, 'rejected')">Reject</button>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<div class="appointment-container">
<h2>Accepted Appointments</h2>
    <div id="accepted-appointments">
        <?php if (empty($accepted_appointments)): ?>
        <p class="no-appointments">No accepted appointments.</p>
        <?php else: ?>
        <?php foreach ($accepted_appointments as $appointment): ?>
        <div class="appointment-card">
            <div class="appointment-header">
                <h3>Appointment with <?php echo $appointment['user_email']; ?></h3>
            </div>
            <div class="appointment-details">
                <p>Date: <?php echo $appointment['appointment_date']; ?></p>
                <p>Notes: <?php echo $appointment['message']; ?></p>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

</div>

<script>
    function updateAppointmentStatus(appointmentId, status) {
        console.log(`Updating appointment ${appointmentId} to ${status}`);
        fetch('update_appointment_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                appointment_id: appointmentId,
                status: status
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Response:', data);
            if (data.success) {
                alert(`Appointment ${status}`);
                document.getElementById(`appointment-${appointmentId}`).remove();
                if (status === 'accepted') {
                    addAcceptedAppointment(data.appointment);
                }
            } else {
                alert('Failed to update appointment status');
            }
        })
        .catch(error => console.error('Error updating appointment status:', error));
    }

    function addAcceptedAppointment(appointment) {
        const acceptedAppointmentsContainer = document.getElementById('accepted-appointments');
        const appointmentCard = document.createElement('div');
        appointmentCard.classList.add('appointment-card');

        appointmentCard.innerHTML = `
           <div class="appointment-details">
                <p>Date: <?php echo !empty($appointment['appointment_date']) ? htmlspecialchars($appointment['appointment_date']) : 'Not specified'; ?></p>
                <p>Time: <?php echo !empty($appointment['appointment_time']) ? htmlspecialchars($appointment['appointment_time']) : 'Not specified'; ?></p>
                <p>Notes: <?php echo !empty($appointment['message']) ? htmlspecialchars($appointment['message']) : 'No notes provided'; ?></p>
            </div>
        </div>
        `;

        acceptedAppointmentsContainer.appendChild(appointmentCard);
    }
</script>

</body>
</html>
