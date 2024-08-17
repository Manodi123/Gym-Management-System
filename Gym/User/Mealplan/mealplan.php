<?php
session_start();

if (!isset($_SESSION['email'])) {
    // Redirect to login page if not logged in
    header("Location: /gym/user/signup/login.html");
    exit();
}

$user_email = $_SESSION['email']; // Assuming the user_id is the user's email

// Function to display SweetAlert and exit
function displayAlert($type, $title, $text) {
    echo '<!DOCTYPE html>
          <html lang="en">
          <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Alert</title>
              <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
          </head>
          <body>
              <script type="text/javascript">
                  Swal.fire({
                      icon: "' . $type . '",
                      title: "' . $title . '",
                      text: "' . $text . '",
                      timer: 4000,
                      showConfirmButton: false
                  }).then(function() {
                      window.location.reload();
                  });
              </script>
          </body>
          </html>';
    exit();
}

// Connect to the database
$conn = new mysqli("localhost", "root", "", "gym_management_db");
if ($conn->connect_error) {
    displayAlert('error', 'Connection Failed', 'Failed to connect to the database.');
}

// Fetch meal plan data
$plan_query = "SELECT * FROM mealplan WHERE user_id = ?";
$stmt = $conn->prepare($plan_query);
if ($stmt === false) {
    displayAlert('error', 'Query Failed', 'Failed to prepare the meal plan query.');
}
$stmt->bind_param("s", $user_email);
$stmt->execute();
$plan_result = $stmt->get_result();
$plan = $plan_result->fetch_assoc();
$stmt->close();

// Check if plan exists
if (!$plan) {
    displayAlert('error', 'No Meal Plan Found', "Meal plan for User Email $user_email not found.");
}

// Fetch meal details
$meals_query = "SELECT * FROM meal WHERE meal_plan_id = ?";
$stmt = $conn->prepare($meals_query);
if ($stmt === false) {
    displayAlert('error', 'Query Failed', 'Failed to prepare the meals query.');
}
$stmt->bind_param("i", $plan['id']);
$stmt->execute();
$meals_result = $stmt->get_result();
$meals = $meals_result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Check if meals array is set correctly
if (empty($meals)) {
    displayAlert('error', 'No Meals Found', "No meals found for Meal Plan ID " . $plan['id']);
}

// Fetch user details including the profile image
$sql = "SELECT firstName, lastName, image_path FROM user WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$stmt->bind_result($firstName, $lastName, $image_path);
$stmt->fetch();
$stmt->close();

// Close the connection
$conn->close();

// Show success message if not shown before
if (!isset($_SESSION['success_message_shown'])) {
    $_SESSION['success_message_shown'] = true;
    displayAlert('success', 'Meal Plan Found', "Meal plan and meals found for User Email $user_email.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Mealplan.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
</head>
<body>
    <!-- Side Bar-->
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

    <div class="main-content">
        <div class="button-container">
            <form method="POST" action="download_pdf.php">
                <input type="hidden" name="trainer_name" value="<?php echo htmlspecialchars($plan['trainer_name']); ?>">
                <input type="hidden" name="goal" value="<?php echo htmlspecialchars($plan['goal']); ?>">
                <input type="hidden" name="start_date" value="<?php echo htmlspecialchars($plan['start_date']); ?>">
                <input type="hidden" name="end_date" value="<?php echo htmlspecialchars($plan['end_date']); ?>">
                <?php foreach ($meals as $meal): ?>
                    <input type="hidden" name="meals[]" value='<?php echo json_encode($meal); ?>'>
                <?php endforeach; ?>
                <button type="submit" class="download-button">Download PDF</button>
            </form>
        </div>

        <div class="meal-plan-container">
            <h2 class="meal-plan-title">Meal Plan</h2>

            <div class="meal-plan-details">
                <p><strong>Trainer Name:</strong> <?php echo htmlspecialchars($plan['trainer_name']); ?></p>
                <p><strong>Goal:</strong> <?php echo htmlspecialchars($plan['goal']); ?></p>
                <p><strong>Start Date:</strong> <?php echo htmlspecialchars($plan['start_date']); ?></p>
                <p><strong>End Date:</strong> <?php echo htmlspecialchars($plan['end_date']); ?></p>
            </div>

            <h3 class="meals-title">Meals</h3>
            <?php foreach ($meals as $meal): ?>
                <div class="meal-item">
                    <h4>Type: <?php echo htmlspecialchars($meal['type']); ?></h4>
                    <div class="meal-details">
                        <p><strong>Option 1:</strong> <?php echo htmlspecialchars($meal['option1']); ?></p>
                        <p><strong>Option 1 Description:</strong> <?php echo htmlspecialchars($meal['option1_desc']); ?></p>
                        <p><strong>Option 2:</strong> <?php echo htmlspecialchars($meal['option2']); ?></p>
                        <p><strong>Option 2 Description:</strong> <?php echo htmlspecialchars($meal['option2_desc']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>  
</body>
</html>
