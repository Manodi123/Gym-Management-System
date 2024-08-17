<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "gym_management_db";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Failed to connect DB: " . $conn->connect_error);
}

session_start();

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
    <link rel="stylesheet" href="\Gym\User\Appoinmet\style.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        /* Global Styles */
        body { margin: 0; 
        }
        h1, h2 { color: black; }
        h2 { margin-bottom: 15px; }

        .chart-container {
            width: 80%;
            height: auto;
        }

        .main-content{
            margin-left: 279px;
            margin-right: 30px;
        }
        .chart-container { margin: 20px 0; }
        canvas { width: 80% !important; height: 300px !important; }
        button { background-color: white; font-family: 'Times New Roman', Times, serif; border: none; color: black; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 10px 0; cursor: pointer; border-radius: 4px; transition: background-color 0.3s ease; }
        button:hover { background-color: #007BFF; color: #fff;}
        .modal { display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4); padding-top: 60px; }
        .modal-content { background-color: #fefefe; margin: 5% auto; padding: 20px; border: 1px solid #888; width: 80%; max-width: 600px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); }
        .close { color: #aaa; float: right; font-size: 28px; font-weight: bold; }
        .close:hover, .close:focus { color: #333; text-decoration: none; cursor: pointer; }
        .modal input[type="number"], .modal input[type="date"] { width: calc(100% - 22px); margin-bottom: 10px; padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
        .modal button { background-color: black; border: none; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 4px; }
        .modal button:hover { background-color: #201E43; }
        @media (max-width: 768px) { .modal-content { width: 90%; } canvas { height: 200px !important; } }
        /* Style the modal */
#myModal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Chart container */
.chart-container {
    position: relative;
    margin: 20px auto;
    height: 400px;
    width: 80%;
}

/* Custom legend style */
.chart-legend {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.chart-legend span {
    display: flex;
    align-items: center;
    margin-right: 10px;
    font-size: 14px;
}

.chart-legend span:before {
    content: '';
    display: inline-block;
    width: 12px;
    height: 12px;
    margin-right: 5px;
    background-color: currentColor;
}
    </style>
</head>
<body>
    <!-- Side Bar -->
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
    

    <!-- Main Content -->
    <div class="main-content">

        <div id="container3D"></div>

        <h1>Progress Tracking</h1>
        <button id="openModalBtn">Add Progress</button>

        <h2>Weight Progress</h2>
        <div class="chart-container">
            <canvas id="weightChart"></canvas>
        </div>

        <h2>Body Fat Percentage Progress</h2>
        <div class="chart-container">
            <canvas id="bodyFatChart"></canvas>
        </div>

        <h2>Muscle Mass Progress</h2>
        <div class="chart-container">
            <canvas id="muscleMassChart"></canvas>
        </div>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modalTitle">Add Progress</h2>
            <form id="progressForm" method="post" action="submit_progress.php">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" required>
                <input type="date" name="date" required>
                <input type="number" step="0.01" name="weight" placeholder="Weight (kg)">
                <input type="number" step="0.01" name="body_fat_percentage" placeholder="Body Fat Percentage (%)">
                <input type="number" step="0.01" name="muscle_mass" placeholder="Muscle Mass (kg)">
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("myModal");
    const span = document.getElementsByClassName("close")[0];

    function openModal() {
        modal.style.display = "block";
    }

    document.getElementById("openModalBtn").onclick = function() {
        openModal();
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    fetch('fetch_data.php')
    .then(response => response.json())
    .then(data => {
        const weightData = data.weight || [];
        const bodyFatData = data.body_fat || [];
        const muscleGainData = data.muscle_gain || [];

        // Prepare data for charts
        const weightLabels = weightData.map(entry => entry.date);
        const weightValues = weightData.map(entry => entry.weight);

        const bodyFatLabels = bodyFatData.map(entry => entry.date);
        const bodyFatValues = bodyFatData.map(entry => entry.body_fat_percentage);

        const muscleGainLabels = muscleGainData.map(entry => entry.date);
        const muscleGainValues = muscleGainData.map(entry => entry.muscle_mass);

        // Weight Chart
        const weightCtx = document.getElementById('weightChart').getContext('2d');
        new Chart(weightCtx, {
            type: 'line',
            data: {
                labels: weightLabels,
                datasets: [{
                    label: 'Weight (kg)',
                    data: weightValues,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: '#000' // Change to black for better visibility
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Weight: ' + context.raw + ' kg';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#000' // Change to black for better visibility
                        },
                        grid: {
                            color: '#ccc' // Light gray for better visibility
                        }
                    },
                    y: {
                        ticks: {
                            color: '#000' // Change to black for better visibility
                        },
                        grid: {
                            color: '#ccc' // Light gray for better visibility
                        }
                    }
                }
            }
        });

        // Body Fat Chart
        const bodyFatCtx = document.getElementById('bodyFatChart').getContext('2d');
        new Chart(bodyFatCtx, {
            type: 'line',
            data: {
                labels: bodyFatLabels,
                datasets: [{
                    label: 'Body Fat Percentage (%)',
                    data: bodyFatValues,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: '#000' // Change to black for better visibility
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Body Fat Percentage: ' + context.raw + '%';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#000' // Change to black for better visibility
                        },
                        grid: {
                            color: '#ccc' // Light gray for better visibility
                        }
                    },
                    y: {
                        ticks: {
                            color: '#000' // Change to black for better visibility
                        },
                        grid: {
                            color: '#ccc' // Light gray for better visibility
                        }
                    }
                }
            }
        });

        // Muscle Mass Chart
        const muscleMassCtx = document.getElementById('muscleMassChart').getContext('2d');
        new Chart(muscleMassCtx, {
            type: 'line',
            data: {
                labels: muscleGainLabels,
                datasets: [{
                    label: 'Muscle Mass (kg)',
                    data: muscleGainValues,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: '#000' // Change to black for better visibility
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Muscle Mass: ' + context.raw + ' kg';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#000' // Change to black for better visibility
                        },
                        grid: {
                            color: '#ccc' // Light gray for better visibility
                        }
                    },
                    y: {
                        ticks: {
                            color: '#000' // Change to black for better visibility
                        },
                        grid: {
                            color: '#ccc' // Light gray for better visibility
                        }
                    }
                }
            }
        });
    })
    .catch(error => console.error('Error fetching progress data:', error));
});
</script>

</div>
</body>
</html>
