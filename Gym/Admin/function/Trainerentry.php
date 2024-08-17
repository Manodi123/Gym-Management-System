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
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Trainer</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Memeberentry1.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Side Bar -->
    <div id="nav-bar">
        <input id="nav-toggle" type="checkbox"/>
        <div id="nav-header">
            <a id="nav-title" href="#" target="_blank">GYM
                <?php
                
                if (isset($_SESSION['name'])) {
                    $name = $_SESSION['name'];
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "gym_management_db";

                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $query = $conn->prepare("SELECT name FROM admin WHERE name = ?");
                    $query->bind_param("s", $name);
                    $query->execute();
                    $query->bind_result($adminName);
                    $query->fetch();
                    echo htmlspecialchars($adminName);
                    $query->close();
                    $conn->close();
                }
                ?>
            </a>
            <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
            <hr/>
        </div>
        <div id="nav-content">
            <div class="nav-button"><i class="fas fa-tachometer-alt"></i><a href="AdminDashbaord.php"><span>Dashboard</span></a></div>
            <div class="nav-button"><i class="fa fa-users"></i><a href="Memeber.php"><span>Member List</span></a></div>
            <div class="nav-button"><i class="fa fa-user-plus"></i><a href="Memberentry.php"><span>Member Entry</span></a></div>
            <div class="nav-button"><i class="fa fa-users-cog"></i><a href="Trainerlist.php"><span>Trainer List</span></a></div>
            <div class="nav-button"><i class="fa fa-user-tie"></i><a href="Trainerentry.php"><span>Trainer Entry</span></a></div>
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
                <div id="nav-footer-titlebox"><a id="nav-footer-title" href="#" target="_blank">User</a><span id="nav-footer-subtitle">Admin</span></div>
                <label for="nav-footer-toggle"><i class="fas fa-caret-up"></i></label>
            </div>
            <div id="nav-footer-content">
                <Lorem>ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</Lorem>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="container">
            <h1>Add New Trainer</h1>
            <form id="addTrainerForm" action="" method="post">
                <div class="form-group">
                    <label for="name"><i class="fas fa-user"></i> Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="ID"><i class="fas fa-id-badge"></i> ID:</label>
                    <input type="text" id="ID" name="ID" required>
                </div>
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone"><i class="fas fa-phone"></i> Phone Number:</label>
                    <input type="text" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="experience"><i class="fas fa-briefcase"></i> Experience:</label>
                    <input type="text" id="experience" name="experience" required>
                </div>
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit"><i class="fas fa-plus-circle"></i> Add Trainer</button>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "gym_management_db";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Connection Failed',
                            text: 'Failed to connect to the database.'
                        });
                    </script>";
                    die("Connection failed: " . $conn->connect_error);
                }

                $name = $_POST['name'];
                $ID = $_POST['ID'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $experience = $_POST['experience'];
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

                $stmt = $conn->prepare("INSERT INTO trainers (Name, ID, email, phone, experience, password) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $name, $ID, $email, $phone, $experience, $password);

                if ($stmt->execute()) {
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Trainer Added',
                            text: 'New trainer added successfully.'
                        }).then(function() {
                            window.location.href = 'Trainerlist.php'; // Redirect to trainer list
                        });
                    </script>";
                } else {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to add new trainer.'
                        });
                    </script>";
                }

                $stmt->close();
                $conn->close();
            }
            ?>
        </div>
    </div>
</body>
</html>
