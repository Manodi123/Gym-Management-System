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

// Handle profile image upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profileImage'])) {
    $targetDir = "images/";
    $targetFile = $targetDir . basename($_FILES["profileImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["profileImage"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["profileImage"]["size"] > 500000) {
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo json_encode(["status" => "error", "message" => "File is not an image or too large."]);
    } else {
        if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $targetFile)) {
            $sql = "UPDATE user SET image_path = ? WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $targetFile, $email);
            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "imagePath" => $targetFile]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to update database."]);
            }
            $stmt->close();
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to upload image."]);
        }
    }
    exit();
}

// Fetch user details
$sql = "SELECT firstName, lastName, email, Phone, image_path FROM user WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($firstName, $lastName, $email, $phone, $image_path);
$stmt->fetch();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($firstName) . ' ' . htmlspecialchars($lastName); ?></title>
  <link rel="stylesheet" href="user_profile.css">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo htmlspecialchars($image_path); ?>">
  <link rel="stylesheet" href="\Gym\Sidebar\style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
 
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
        <div class="nav-button"><i class="fa fa-comments"></i><a href="\Gym\Chatapp\php\login.php"><span>Chat with trainer</span></a></div>
        <div class="nav-button"><i class="fa fa-calendar"></i><a href="\Gym\User\Timeshedule\Schedule.php"><span>Time scheduling</span></a></div>
        <div class="nav-button"><i class="fa fa-cutlery"></i><a href="/Gym/User/Mealplan/mealplan.php"><span>Meal plan</span></a></div>
        <div class="nav-button"><i class="fa fa-universal-access"></i><a href="\Gym\User\Workoutplan\Workoutplan.php"><span>Workout plan</span></a></div>
        <div class="nav-button"><i class="fa-solid fa-hand-holding-dollar"></i><a href="#"><span>Subscription</span></a></div>
        <div class="nav-button"><i class="fa fa-window-restore"></i><a href="/Gym/User/Appoinmet/Appointment.php"><span>Appointment</span></a></div>
        <div class="nav-button"><i class="fa fa-commenting"></i><a href="#"><span>Feedback</span></a></div>
        <hr/>
        <div class="nav-button"><i class="fa fa-sign-out"></i><a href="/Gym/index.html"><span>Log-out</span></a></div>
        <hr/>
        <div id="nav-content-highlight"></div>
      </div>
      <input id="nav-footer-toggle" type="checkbox"/>
      <div id="nav-footer">
        <div id="nav-footer-heading">
          <div id="nav-footer-avatar">
            <img src="<?php echo htmlspecialchars($image_path); ?>" alt="Profile Image"/>
          </div>
          <div id="nav-footer-titlebox">
            <a id="nav-footer-title" href="#" target="_blank">
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
  <div class="profile-container">
    <div class="profile-header">
      <div class="profile-img">
        <img src="<?php echo htmlspecialchars($image_path); ?>" alt="Profile Image" id="profileImage">
        <div class="upload-button">
          <label for="imageUpload">✏️</label>
          <input type="file" id="imageUpload" name="profileImage" accept="image/*">
        </div>
      </div>
      <h1 id="userName"><?php echo htmlspecialchars($firstName) . ' ' . htmlspecialchars($lastName); ?></h1>
      <p id="userEmail"><?php echo htmlspecialchars($email); ?></p>
    </div>
    <div class="profile-details">
      <form id="editForm" method="post" action="update_profile.php" enctype="multipart/form-data">
        <div class="form-group">
          <label for="firstName">First Name</label>
          <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>">
        </div>
        <div class="form-group">
          <label for="lastName">Last Name</label>
          <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>">
        </div>
        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
        </div>
        <button type="submit" class="save-changes">Save Changes</button>
      </form>
    </div>
  </div>
  <script>
    document.getElementById('imageUpload').addEventListener('change', function() {
      var formData = new FormData();
      formData.append('profileImage', this.files[0]);

      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'user_profile.php', true);
      xhr.onload = function () {
        if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          if (response.status === 'success') {
            document.getElementById('profileImage').src = response.imagePath;
          } else {
            alert('Image upload failed. Please try again.');
          }
        } else {
          alert('An error occurred while uploading the image.');
        }
      };
      xhr.send(formData);
    });
  </script>
</body>
</html>
