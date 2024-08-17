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
    <link rel="stylesheet" href="Feedback.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
</head>
<body>
    <!-- Side Bar-->
    
    <div class="sidebar">
        <div class="top">
            <div class="logo"> 
                <span>G Master</span> <!-- Added some text inside the logo for demonstration -->
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
            <li data-tooltip="Dashboard">
                <a href="Dashboard.php">
                    <i class='bx bxs-dashboard'></i>      
                    <span class="nav-item">Dashboard</span>
                </a>
                </li>
                
                <li data-tooltip="To-Do-List">
                    <a href="todo list.html">
                        <i class='bx bx-list-ul'></i>      
                        <span class="nav-item">To-Do-List</span>
                    </a>
                    </li>
                
                    <li data-tooltip="Chat with Trainer">
                        <a href="chat.html">
                            <i class='bx bx-chat' ></i>      
                            <span class="nav-item">Chat With Trainer</span>
                        </a>
                        </li>
                
                        <li data-tooltip="Time Schedule">
                            <a href="Schedule.php">
                                <i class='bx bx-time-five' ></i>   
                                <span class="nav-item">Time Schedule</span>
                            </a>
                            </li>
                  
                            <li data-tooltip="Workouut Plan">
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
                                                    <a href="#" id="logoutBtn">
                                                        <i class='bx bx-log-out' ></i>
                                                        <span class="nav-item">Logout</span>
                                                    </a>
                                                    </li>
                                                         
                                                     
 </ul>
</div>

    <div class="main-content">


    <div class="feedback-container">
    <h2>Feedback Form</h2>
    <form action="#" method="post" id="feedbackForm" onsubmit="return validateForm()">
        <div class="form-group">
            <label for="overall_rating">Overall Experience:</label>
            <input type="number" id="overall_rating" name="overall_rating" min="1" max="5" required>
            <span class="rating-description">(Rate from 1 to 5)</span>
        </div>
        <div class="form-group">
            <label for="customer_service">Customer Service:</label>
            <input type="number" id="customer_service" name="customer_service" min="1" max="5" required>
            <span class="rating-description">(Rate from 1 to 5)</span>
        </div>
        <div class="form-group">
            <label for="product_quality">Progress Traking:</label>
            <input type="number" id="product_quality" name="product_quality" min="1" max="5" required>
            <span class="rating-description">(Rate from 1 to 5)</span>
        </div>
        <div class="form-group">
            <label for="usability">Website/Platform Usability:</label>
            <input type="number" id="usability" name="usability" min="1" max="5" required>
            <span class="rating-description">(Rate from 1 to 5)</span>
        </div>
        <div class="form-group">
            <label for="delivery">Customize Mela plan and Workout Plan:</label>
            <input type="number" id="delivery" name="delivery" min="1" max="5" required>
            <span class="rating-description">(Rate from 1 to 5)</span>
        </div>
        <div class="form-group">
            <label for="value_for_money">Communication Between Client and Trainer:</label>
            <input type="number" id="value_for_money" name="value_for_money" min="1" max="5" required>
            <span class="rating-description">(Rate from 1 to 5)</span>
        </div>
        <div class="form-group">
            <label for="additional_comments">Additional Comments:</label>
            <textarea id="additional_comments" name="additional_comments" placeholder="Write your comments here..." required></textarea>
        </div>
        <button type="submit">Submit Feedback</button>
    </form>
</div>







    <script src="Feedback.js"></script>

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