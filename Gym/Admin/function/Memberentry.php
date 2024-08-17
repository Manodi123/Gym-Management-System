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
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <title>Members List</title>
    <link rel="stylesheet" href="Dashbaord2.css">
    <link rel="stylesheet" href="Memeberentry1.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'><link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

 <!-- Side Bar-->
 
 <!-- Side Bar -->
 <div id="nav-bar">
  <input id="nav-toggle" type="checkbox"/>
  <div id="nav-header"><a id="nav-title" href="#" target="_blank">GYM
  <?php 
   if(isset($_SESSION['name'])){
    $name=$_SESSION['name'];
    $query=mysqli_query($conn, "SELECT * FROM `admin` WHERE name='$name'");
    while($row=mysqli_fetch_array($query)){
        echo $row['name'];
    }
   }
   ?>
  </a>
    <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
    <hr/>
  </div>
  <div id="nav-content">
          <div class="nav-button"><i class="fas fa-tachometer-alt"></i></i><a href="AdminDashbaord.php"><span>Dashboard</span></a></div>
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
        <h1>Add Member</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="firstName"><i class="fas fa-user"></i> First Name</label>
                <input type="text" id="firstName" name="firstName" required>
            </div>
            <div class="form-group">
                <label for="lastName"><i class="fas fa-user"></i> Last Name</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone"><i class="fas fa-phone"></i> Phone</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="weight"><i class="fas fa-weight"></i> Weight</label>
                <input type="text" id="weight" name="weight" required>
            </div>
            <div class="form-group">
                <label for="gender"><i class="fas fa-venus-mars"></i> Gender</label>
                <select id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="medical_report"><i class="fas fa-file-medical"></i> Medical Report</label>
                <input type="file" id="medical_report" name="medical_report" required>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>

<?php
// Database configuration
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

// Add column for medical report if not exists
$sql = "ALTER TABLE user ADD COLUMN IF NOT EXISTS medical_report VARCHAR(255)";
$conn->query($sql);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $weight = $_POST['weight'];
    $gender = $_POST['gender'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    // Handle medical report upload
    $medical_report = "";
    if (isset($_FILES["medical_report"]) && $_FILES["medical_report"]["error"] == 0) {
        $target_dir = "User/medical_reports/";
        
        // Ensure the directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($_FILES["medical_report"]["name"]);
        $uploadOk = 1;
        $reportFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check file size (limit to 5MB)
        if ($_FILES["medical_report"]["size"] > 5000000) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Sorry, your file is too large.',
                    });
                  </script>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($reportFileType != "pdf" && $reportFileType != "doc" && $reportFileType != "docx") {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Sorry, only PDF, DOC & DOCX files are allowed.',
                    });
                  </script>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Sorry, your file was not uploaded.',
                    });
                  </script>";
        } else {
            // Attempt to upload file
            if (move_uploaded_file($_FILES["medical_report"]["tmp_name"], $target_file)) {
                $medical_report = $target_file;
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Sorry, there was an error uploading your file.',
                        });
                      </script>";
            }
        }
    }

    // SQL query to insert data into user table
    $sql = "INSERT INTO user (firstName, lastName, email, phone, weight, gender, password, medical_report)
            VALUES ('$firstName', '$lastName', '$email', '$phone', '$weight', '$gender', '$password', '$medical_report')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'New record created successfully',
                }).then(function() {
                    window.location = 'Memberentry.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error: " . $sql . "<br>" . $conn->error . "',
                }).then(function() {
                    window.location = 'Memberentry.php';
                });
              </script>";
    }
}

// Close connection
$conn->close();
?>


</body>
</html>