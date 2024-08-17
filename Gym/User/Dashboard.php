<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Dashboard2.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="payment.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
    <script src="chart.js"></script>
</head>
<body>
    <!-- Side Bar-->
    
    <div class="sidebar">
        <div class="top">
            <div class="logo"> 
                <span>G Master</span> 
            </div>
            <i class="bx bx-menu" id="btn"></i>
        </div>
        <div class="User">
            <img src="Images/portrait-white-man-isolated_53876-40306.avif" alt="me" class="user-img">
            <div>
                <p class="bold">Andrew</p>
                <p class="bold">Welcome!</p>
            </div>
        </div>

        <ul class="tooltip">
            <li data-tooltip="">
                <a href="Dashboard.php">
                    <i class='bx bxs-dashboard'></i>      
                    <span class="nav-item">Dashboard</span>
                </a>
                </li>
                
                <li data-tooltip="">
                    <a href="todo list.html">
                        <i class='bx bx-list-ul'></i>      
                        <span class="nav-item">To-Do-List</span>
                    </a>
                    </li>
                
                    <li data-tooltip="">
                        <a href="chat.html">
                            <i class='bx bx-chat' ></i>      
                            <span class="nav-item">Chat With Trainer</span>
                        </a>
                        </li>
                
                        <li data-tooltip="">
                            <a href="Schedule.php">
                                <i class='bx bx-time-five' ></i>   
                                <span class="nav-item">Time Schedule</span>
                            </a>
                            </li>
                  
                            <li data-tooltip="">
                                <a href="Workoutplan.php">
                                    <i class='bx bx-dumbbell' ></i>     
                                    <span class="nav-item">Workout Plan</span>
                                </a>
                                </li>
                
                                <li data-tooltip="Meal Plan">
                                    <a href="Mealplan.php">
                                        <i class='bx bx-food-menu' ></i>     
                                        <span class="nav-item">Meal Plan</span>
                                    </a>
                                    </li>
                
                                    <li data-tooltip="Appointment">
                                        <a href="Appointment.html">
                                            <i class='bx bx-timer' ></i>     
                                            <span class="nav-item">Appointment</span>
                                        </a>
                                        </li>
                
                                        
                                            <li data-tooltip="Progress">
                                                <a href="#">
                                                    <i class='bx bx-chart'></i>
                                                <span class="nav-item">Progress</span>
                                            </a>
                                            </li>


                                            <li data-tooltip="Subscription">
                                                <a href="index.php">
                                                <i class='bx bx-money-withdraw'></i>  
                                                <span class="nav-item">Subscription</span>
                                            </a>
                                            </li>

                                            <li data-tooltip="Feedback">
                                                <a href="Feedback.php">
                                                    <i class='bx bx-message-alt-add'></i>
                                                <span class="nav-item">Feedback</span>
                                            </a>
                                            </li>
                
                                            <li data-tooltip="User Profile">
                                                <a href="profile.php">
                                                    <i class='bx bx-user-circle' ></i>
                                                    <span class="nav-item">User Profile</span>
                                                </a>
                                                </li>
                                                     
                                                <li data-tooltip="Logout">
                                                    <a href="login.php">
                                                        <i class='bx bx-log-out' ></i>
                                                        <span class="nav-item">Logout</span>
                                                    </a>
                                                    </li>
                                                         
                                                     
 </ul>
</div>

    <div class="main-content">


<h1> Monthly Progress Data <h1>
     <div class="chart-container">
    <canvas id="myChart" width="200" height="50"></canvas>
</div>
              
    <?php
// Fetch data from the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminpanel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT measurement_month, weight FROM weight_progress";
$result = $conn->query($sql);

$dates = array();
$weights = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dates[] = $row["measurement_month"];
        $weights[] = $row["weight"];
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var initialData = <?php echo json_encode($weights); ?>; // Store initial data values
    var animationData = initialData.slice(); // Create a copy of the initial data for animation
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($dates); ?>,
            datasets: [{
                label: 'Weight Progress (Kg)',
                data: animationData, // Use the animation data for the dataset
                backgroundColor: '#FF6363',
                borderColor: '#FF6363',
                borderWidth: 1,
                tension: 0.5
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            return value + ' Kg';
                        }
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var label = data.datasets[tooltipItem.datasetIndex].label || '';
                        if (label) {
                            label += ': ';
                        }
                        label += tooltipItem.yLabel.toFixed(2) + ' Kg';
                        return label;
                    }
                }
            },
            animation: {
                // Enable looping animation
                loop: true,
                // Set animation easing
                easing: 'linear',
                // Set animation duration in milliseconds
                duration: 2000,
                // Update animation data on each frame
                onProgress: function(animation) {
                    // Update data values to create the appearance of animation
                    var progress = animation.currentStep / animation.numSteps;
                    for (var i = 0; i < animationData.length; i++) {
                        // Manipulate animation data values to create the desired animation effect
                        animationData[i] = initialData[i] * progress; // Example: Linear animation
                    }
                    // Update the chart with the new animation data
                    myChart.update();
                }
            }
        }
    });
</script>




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
