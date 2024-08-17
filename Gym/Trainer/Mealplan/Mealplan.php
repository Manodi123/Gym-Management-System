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
    <link rel="stylesheet" href="Mealplan.css">
    <link rel="stylesheet" href="/Gym/Trainer/style.css">
   
   <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'><link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        

         body {
            font-family: Arial, sans-serif;
            background:#fff;
            background-size: 400% 400%;
            font-family: Arial, sans-serif;
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
        
        .container {
            max-width: 600px;
            margin: 20px auto;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label, input, select, button {
            margin-bottom: 10px;
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
        <h2>Create Meal Plan</h2>
        <form action="create_meal_plan.php" method="POST">
            <div class="form-section">
                <div>
                    <label for="user_email">User Email:</label>
                    <input type="text" id="user_email" name="user_email" required>
                </div>
                <div>
                    <label for="trainer_name">Trainer Name:</label>
                    <input type="text" id="trainer_name" name="trainer_name" required>
                </div>
                <div>
                    <label for="goal">Meal Plan Goal:</label>
                    <input type="text" id="goal" name="goal" required>
                </div>
                <div>
                    <label for="start_date">Start Date:</label>
                    <input type="date" id="start_date" name="start_date" required>
                </div>
                <div>
                    <label for="end_date">End Date:</label>
                    <input type="date" id="end_date" name="end_date" required>
                </div>
            </div>

            <label for="meals">Meals:</label>
            <div id="meals">
                <div class="meal">
                    <select name="meals[0][type]" required>
                        <option value="Breakfast">Breakfast</option>
                        <option value="Lunch">Lunch</option>
                        <option value="Dinner">Dinner</option>
                        <option value="Snack">Snack</option>
                    </select>
                    <input type="text" name="meals[0][option1]" placeholder="Option 1" required>
                    <input type="text" name="meals[0][option1_desc]" placeholder="Option 1 Description" required>
                    <input type="text" name="meals[0][option2]" placeholder="Option 2" required>
                    <input type="text" name="meals[0][option2_desc]" placeholder="Option 2 Description" required>
                </div>
            </div>

            <button type="button" onclick="addMeal()">Add Another Meal</button>
            <button type="submit">Create Meal Plan</button>
        </form>
    </div>
    </div>
    <script>
        function addMeal() {
            const mealsDiv = document.getElementById('meals');
            const mealCount = mealsDiv.children.length;
            const mealDiv = document.createElement('div');
            mealDiv.classList.add('meal');
            mealDiv.innerHTML = `
                <select name="meals[${mealCount}][type]" required>
                    <option value="Breakfast">Breakfast</option>
                    <option value="Lunch">Lunch</option>
                    <option value="Dinner">Dinner</option>
                    <option value="Snack">Snack</option>
                </select>
                <input type="text" name="meals[${mealCount}][option1]" placeholder="Option 1" required>
                <input type="text" name="meals[${mealCount}][option1_desc]" placeholder="Option 1 Description" required>
                <input type="text" name="meals[${mealCount}][option2]" placeholder="Option 2" required>
                <input type="text" name="meals[${mealCount}][option2_desc]" placeholder="Option 2 Description" required>
            `;
            mealsDiv.appendChild(mealDiv);
        }
    </script>
</body>
</html>