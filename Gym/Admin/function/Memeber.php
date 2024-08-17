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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Member1.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Reset default margin and padding */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #ecf0f1;
    color: #e1eefb;
}

.main-content {
    padding: 40px;
    width: 100%;
    min-height: 100vh;
    background-color: #e1eefb;
}

.main-content h1 {
    font-size: 36px;
    color: white;
    margin-bottom: 30px;
    text-align: center;
}

.table-container {
    margin-left: 180px;
    margin-right: 150px;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    overflow-x: auto;
}

.table-container table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.table-container th, .table-container td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.table-container th {
    background-color: #f4f6f7;
    color: #2c3e50;
}



.icon {
    width: 25px;
    height: 25px;
    margin-right: 10px;
}

.actions {
    display: flex;
    gap: 10px;
}

.actions .delete-btn, .actions .update-btn {
    cursor: pointer;
    color: #e74c3c;
    background-color: #ecf0f1;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.actions .update-btn {
    color: #3498db;
}

.actions .delete-btn:hover {
    background-color: #e74c3c;
    color: #fff;
}

.actions .update-btn:hover {
    background-color: #3498db;
    color: #fff;
}

/* Modal styling */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
    padding-top: 60px;
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
    border-radius: 10px;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.modal-content h2 {
    margin-bottom: 20px;
}

.modal-content form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.modal-content input[type="text"],
.modal-content input[type="email"],
.modal-content input[type="password"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

.modal-content button {
    padding: 10px;
    background-color: #2c3e50;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.modal-content button:hover {
    background-color: #34495e;
}

    </style>
</head>

<body>
 
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
<h1 style="color: black;">Member List</h1>
    <div class="table-container">
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym_management_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM user";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead>";
    echo "<tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Weight</th>
            <th>Gender</th>
            <th>Plan</th>
            <th>Actions</th>
        </tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><img src='Images\User_cicrle.png' class='icon'> " . $row['firstName'] . " " . $row['lastName'] . "</td>";
        echo "<td><i class='fas fa-envelope' style='color: #FF5C00;'></i> " . $row['email'] . "</td>";
        echo "<td><i class='fas fa-phone' style='color: #FF5C00;'></i> " . $row['Phone'] . "</td>";
        echo "<td><i class='fas fa-weight' style='color: #FF5C00;'></i> " . $row['weight'] . "</td>";
        echo "<td><i class='fas fa-venus-mars' style='color: #FF5C00;'></i> " . $row['gender'] . "</td>";
        // Adding a placeholder for 'plan' since it is not defined in the current table structure
        echo "<td><i class='fas fa-dumbbell' style='color: #FF5C00;'></i> " . (isset($row['plan']) ? $row['plan'] : 'N/A') . "</td>";
        echo "<td>
                <div class='actions'>
                    <div class='delete-btn' data-user-id='" . $row['email'] . "'><i class='fas fa-trash-alt'></i></div>
                    <div class='update-btn' data-user-id='" . $row['email'] . "' data-first-name='" . $row['firstName'] . "' data-last-name='" . $row['lastName'] . "' data-email='" . $row['email'] . "' data-phone='" . $row['Phone'] . "' data-weight='" . $row['weight'] . "' data-gender='" . $row['gender'] . "'><i class='fas fa-edit'></i></div>
                </div>
              </td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>

    </div>
</div>

<!-- Add a modal for updating member information -->
<div id="updateModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Update Member Information</h2>
        <form id="updateForm">
            <!-- Input fields for member information -->
            <input type="hidden" id="userId" name="userId">
            <input type="text" id="firstName" name="firstName" placeholder="First Name">
            <input type="text" id="lastName" name="lastName" placeholder="Last Name">
            <input type="email" id="email" name="email" placeholder="Email">
            <input type="text" id="phone" name="phone" placeholder="Phone">
            <input type="text" id="weight" name="weight" placeholder="Weight">
            <input type="text" id="gender" name="gender" placeholder="Gender">
            <button type="submit">Update</button>
        </form>
    </div>
</div>
<script>
// Get the modal
var modal = document.getElementById("updateModal");

// Get the update button that opens the modal
var updateBtns = document.querySelectorAll(".update-btn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
updateBtns.forEach(function(btn) {
    btn.addEventListener("click", function() {
        var userId = btn.dataset.userId;
        var firstName = btn.dataset.firstName;
        var lastName = btn.dataset.lastName;
        var email = btn.dataset.email;
        var phone = btn.dataset.phone;
        var weight = btn.dataset.weight;
        var gender = btn.dataset.gender;
        var plan = btn.dataset.plan;

        // Set input field values
        document.getElementById("userId").value = userId;
        document.getElementById("firstName").value = firstName;
        document.getElementById("lastName").value = lastName;
        document.getElementById("email").value = email;
        document.getElementById("phone").value = phone;
        document.getElementById("weight").value = weight;
        document.getElementById("gender").value = gender;
        document.getElementById("plan").value = plan;

        modal.style.display = "block";
    });
});

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Handle form submission
document.getElementById("updateForm").addEventListener("submit", function(event) {
    event.preventDefault();

    var formData = new FormData(this);

    fetch('update-member.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Member updated successfully');
            location.reload(); // Reload the page to reflect the changes
        } else {
            alert('Error updating member');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating member');
    });
});

// Handle delete button click
var deleteBtns = document.querySelectorAll(".delete-btn");

deleteBtns.forEach(function(btn) {
    btn.addEventListener("click", function() {
        var userId = btn.dataset.userId;
        if (confirm('Are you sure you want to delete this member?')) {
            fetch('delete-member.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ user_id: userId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Member deleted successfully');
                    location.reload(); // Reload the page to reflect the changes
                } else {
                    alert('Error deleting member');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting member');
            });
        }
    });
});

// Handle update button click
updateBtns.forEach(function(btn) {
    btn.addEventListener("click", function() {
        var userId = btn.dataset.userId;
        var firstName = btn.dataset.firstName;
        var lastName = btn.dataset.lastName;
        var email = btn.dataset.email;
        var phone = btn.dataset.phone;
        var weight = btn.dataset.weight;
        var gender = btn.dataset.gender;

        // Set input field values
        document.getElementById("userId").value = userId;
        document.getElementById("firstName").value = firstName;
        document.getElementById("lastName").value = lastName;
        document.getElementById("email").value = email;
        document.getElementById("phone").value = phone;
        document.getElementById("weight").value = weight;
        document.getElementById("gender").value = gender;

        modal.style.display = "block";
    });
});





</script>
</body>
</html>