<?php
    
   
    session_start();
    
    if (!isset($_SESSION['email'])) {
        // Redirect to login page if not logged in
        header("Location: /gym/admin/signup/login.html");
        exit();
    }
    
    $email = $_SESSION['email'];
    
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "gym_management_db";
    $conn = new mysqli($host, $user, $pass, $db);
    
    if ($conn->connect_error) {
        die("Failed to connect to DB: " . $conn->connect_error);
    }
    
    // Your code to handle admin actions goes here
    
    
    // Initialize the message variable
    $message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user_id and attendance_date are set in $_POST
    if (isset($_POST['user_id']) && isset($_POST['attendance_date'])) {
        // Database connection parameters
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

        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO attendance (user_id, attendance_date) VALUES (?, ?)");
        $stmt->bind_param("ss", $user_id, $attendance_date);

        // Set parameters
        $user_id = $_POST['user_id'];
        $attendance_date = $_POST['attendance_date']; 

        // Execute the statement
        if ($stmt->execute()) {
            $message = "Attendance recorded successfully.";
        } else {
            $message = "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // If the form is submitted but the required fields are not set, don't display an error message
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $message = "Error: user_id and/or attendance_date not set.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Attendance.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <!-- Side Bar -->
    <div id="nav-bar">
        <input id="nav-toggle" type="checkbox"/>
        <div id="nav-header">
            <a id="nav-title" href="#" target="_blank">GYM
                <?php 
                if(isset($_SESSION['name'])){
                    $name = $_SESSION['name'];
                    $query = mysqli_query($conn, "SELECT * FROM `admin` WHERE name='$name'");
                    while($row = mysqli_fetch_array($query)){
                        echo $row['name'];
                    }
                }
                ?>
            </a>
            <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
            <hr/>
        </div>
        <div id="nav-content">
            <div class="nav-button"><i class="fas fa-tachometer-alt"></i><a href="/gym/admin/function/AdminDashbaord.php"><span>Dashboard</span></a></div>
            <div class="nav-button"><i class="fa fa-users"></i><a href="Memeber.php"><span>Member List</span></a></div>
            <div class="nav-button"><i class="fa fa-user-plus"></i><a href="MemberEntry.php"><span>Member Entry</span></a></div>
            <div class="nav-button"><i class="fa fa-users-cog"></i><a href="TrainerList.php"><span>Trainer List</span></a></div>
            <div class="nav-button"><i class="fa fa-user-tie"></i><a href="TrainerEntry.php"><span>Trainer Entry</span></a></div>
            <div class="nav-button"><i class="fas fa-clipboard-check"></i><a href="Attendance.php"><span>Attendance</span></a></div>
            <div class="nav-button"><i class="fa fa-comment-dots"></i><a href="Subscription_req.php"><span>Subscription Request</span></a></div>
            <hr/>
            <div class="nav-button"><i class="fa fa-sign-out"></i><a href="/gym/admin/signup/login.html"><span>Log-out</span></a></div>
            <hr/>
            <div id="nav-content-highlight"></div>
        </div> 
        <input id="nav-footer-toggle" type="checkbox"/>
        <div id="nav-footer">
            <div id="nav-footer-heading">
                <div id="nav-footer-avatar"><img src="https://gravatar.com/avatar/4474ca42d303761c2901fa819c4f2547"/></div>
                <div id="nav-footer-titlebox"><a id="nav-footer-title" href="" target="_blank">User</a><span id="nav-footer-subtitle">Admin</span></div>
                <label for="nav-footer-toggle"><i class="fas fa-caret-up"></i></label>
            </div>
            <div id="nav-footer-content">
                <Lorem>ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</Lorem>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="card">
            <div class="container">
                <h1>Mark Attendance</h1>
                <form action="Attendance.php" method="post">
                    <div class="form-group">
                        <label for="user_id"><i class="fas fa-user"></i> User Email:</label>
                        <input type="text" id="user_id" name="user_id" required>
                    </div>
                    <div class="form-group">
                        <label for="attendance_date"><i class="far fa-calendar-alt"></i> Attendance Date:</label>
                        <input type="date" id="attendance_date" name="attendance_date" required>
                    </div>
                    <button type="submit"><i class="fas fa-check-circle"></i> Mark Attendance</button>
                </form>
            </div>
        </div>
    </div>

    <script>
    <?php if (!empty($message)) { ?>
        swal({
            title: "<?php echo ($message === 'Attendance recorded successfully.') ? 'Success' : 'Error'; ?>",
            text: "<?php echo $message; ?>",
            icon: "<?php echo ($message === 'Attendance recorded successfully.') ? 'success' : 'error'; ?>",
        });
    <?php } ?>
    </script>
</body>
</html>
