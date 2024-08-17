<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="Dashboard2.css">

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
                      <a href="#">
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


<div class="main-content" style="margin-top: 50px;">

    <div class="upload-photo-section">
        <label for="photo" class="upload-photo">
            <input type="file" id="photo" name="photo" accept="image/*">
        </label>
    </div>
    <form class="profile-form" method="post" action="">
        <div class="form-group">
            <label for="name"><i class='bx bx-group'></i></i> Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter Your Name" required>
        </div>
        <div class="form-group">
            <label for="email"><i class='bx bxs-envelope' ></i></i> Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter Your Email" required>
        </div>
        <div class="form-group">
            <label for="address"><i class='bx bxs-location-plus'></i> Address:</label>
            <input type="text" id="address" name="address" placeholder="Enter Your Address" required>
        </div>
        <div class="form-group">
            <label for="gender"><i class='bx bx-child'></i> Gender:</label>
            <select name="gender" id="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="phone"><i class='bx bxs-phone-call' ></i> Phone Number:</label>
            <input type="tel" id="phone" name="phone" placeholder="Enter Your Phone Number" required>
        </div>
        <div class="form-group">
            <label for="dob"><i class='bx bxs-calendar'></i> Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>
        </div>
        <div class="form-group">
            <label for="username"><i class='bx bxs-user'></i> Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter Your Username" required>
        </div>
        <div class="form-group">
            <label for="password"><i class='bx bx-show'></i> Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter Your Password" required>
        </div>
        <button type="submit">Save</button>
    </form>
</div>

<script src="profile.js"></script>
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
