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
    <link rel="stylesheet" href="\sidebar\style.css">
    <link rel="stylesheet" href="Member1.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'><link rel="stylesheet" href="./style.css">
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
    color: #2c3e50;
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

 <!-- Side Bar-->
 <!-- Side Bar -->
 <div class="content">
        <div id="nav-bar">
            <input id="nav-toggle" type="checkbox"/>
            <div id="nav-header"><a id="nav-title" href="#" target="_blank">GYM</a>
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
              
                <div class="nav-button"><i class="fa fa-sign-out-alt"></i><a href="#"><span>Log-out</span></a></div>
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
    <h1 style="color: black;">Trainer List</h1>
    <div class="table-container">
    <?php
// Fetch data from the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym_management_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM trainers"; // Updated table name
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead>";
    echo "<tr>
            <th>Image</th>
            <th>Name</th>
            <th>ID</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Experience</th>
            <th>Actions</th>
        </tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><img src='" . ($row['image_path'] ? 'Images/' . $row['image_path'] : 'Images/default.png') . "' class='icon'></td>";
        echo "<td>" . $row['Name'] . "</td>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['experience'] . "</td>";
        echo "<td>
                <div class='actions'>
                    <div class='delete-btn' data-trainer-id='" . $row['email'] . "'><i class='fas fa-trash-alt'></i></div>
                    <div class='update-btn' data-trainer-id='" . $row['email'] . "' data-name='" . $row['Name'] . "' data-id='" . $row['ID'] . "' data-email='" . $row['email'] . "' data-phone='" . $row['phone'] . "' data-experience='" . $row['experience'] . "'><i class='fas fa-edit'></i></div>
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

<!-- Add a modal for updating trainer information -->
<!-- Add a modal for updating trainer information -->
<div id="updateModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Update Trainer Information</h2>
        <form id="updateForm">
            <input type="hidden" id="trainerId" name="trainerId">
            <input type="text" id="name" name="name" placeholder="Name">
            <input type="text" id="id" name="id" placeholder="ID">
            <input type="text" id="email" name="email" placeholder="Email">
            <input type="text" id="phone" name="phone" placeholder="Phone Number">
            <input type="text" id="experience" name="experience" placeholder="Experience">
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
            var trainerId = btn.dataset.trainerId;
            var name = btn.dataset.name;
            var id = btn.dataset.id;
            var email = btn.dataset.email;
            var phone = btn.dataset.phone;
            var experience = btn.dataset.experience;

            // Set input field values
            document.getElementById("trainerId").value = trainerId;
            document.getElementById("name").value = name;
            document.getElementById("id").value = id;
            document.getElementById("email").value = email;
            document.getElementById("phone").value = phone;
            document.getElementById("experience").value = experience;

            modal.style.display = "block";
        });
    });

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };

    // AJAX request to update trainer information
    document.getElementById("updateForm").addEventListener("submit", function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_trainer.php", true);
        xhr.onload = function() {
            if (xhr.status == 200) {
                // Update successful
                alert(xhr.responseText); // Display success message or handle response
                modal.style.display = "none";
                // Reload or update trainer list if needed
                window.location.reload();
            } else {
                // Update failed
                alert('Error: ' + xhr.statusText);
            }
        };
        xhr.onerror = function() {
            alert('Request failed');
        };
        xhr.send(formData);
    });

    // Delete trainer
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const trainerId = button.dataset.trainerId;

            fetch(`delete_trainer.php?email=${trainerId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Trainer deleted successfully!');
                        window.location.reload();
                    } else {
                        alert('Error deleting trainer: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again later.');
                });
        });
    });
</script>




    </div>
    <div>
</body>
</htm/>