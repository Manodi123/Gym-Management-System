<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayHere Payment Gateway</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dashboard1.css">
    <link rel="stylesheet" href="pay.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
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
                            <a href="#">
                                <i class='bx bx-time-five' ></i>   
                                <span class="nav-item">Time Schedule</span>
                            </a>
                            </li>
                  
                            <li data-tooltip="Workouut Plan">
                                <a href="#">
                                    <i class='bx bx-dumbbell' ></i>     
                                    <span class="nav-item">Workout Plan</span>
                                </a>
                                </li>
                
                                <li data-tooltip="Meal Plan">
                                    <a href="#">
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
                                                <a href="#">
                                                    <i class='bx bx-message-alt-add'></i>
                                                <span class="nav-item">Feedback</span>
                                            </a>
                                            </li>
                
                                            <li data-tooltip="User Profile">
                                                <a href="index.html">
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

        <!-- Subscription plans -->
        
        <div class="container">
    <h1>PayHere Payment Gateway</h1>

    <!-- Subscription plans -->
    <div class="subscription-options">
        <div class="card" onclick="paymentGateway('basic')">
            <div class="card-content">
                <h3>Basic Plan</h3>
                <h1>$10 <span>/Month</span></h1>
                <p>Access to basic features</p>
                <p>Access to basic features</p>
                <p>Access to basic features</p>
                <p>Access to basic features</p>
                <p>Access to basic features</p>
                  <p>Limited support</p>
            </div>
            <a href="#" class="subscribe-button">Subscribe</a>
        </div>

        <div class="card" onclick="paymentGateway('standard')">
            <div class="card-content">
                <h3>Standard Plan</h3>
                <h1>$20 <span>/Month</span></h1>
                <p>Access to standard features</p>
                <p>Email support</p>
            </div>
            <a href="#" class="subscribe-button">Subscribe</a>
        </div>

        <div class="card" onclick="paymentGateway('premium')">
            <div class="card-content">
                <h3>Premium Plan</h3>
                <h1>$30 <span>/Month</span></h1>
                <p>Access to premium features</p>
                <p>Priority support</p>
            </div>
            <a href="#" class="subscribe-button">Subscribe</a>
        </div>
    </div>
</div>

        
    <script src="script.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>




    <script>
        let btn = document.querySelector('#btn');
        let sidebar = document.querySelector('.sidebar');

        btn.onclick = function() {
            sidebar.classList.toggle('active'); 
        };
        </script>


</body>
</html>
