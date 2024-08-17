<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminpanel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$appointment_id = $_GET['id'];

// Update appointment status in database
$success = false;
$message = "";

$sql = "UPDATE appointments SET status='accept' WHERE appointment_id='$appointment_id'";

if ($conn->query($sql) === TRUE) {
    $success = true;
    $message = "Appointment accepted successfully.";
} else {
    $message = "Error updating record: " . $conn->error;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .message-container {
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            text-align: center;
        }
        .message {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
        .go-back-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
        }
        .go-back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <p class="message <?php echo $success ? 'success' : 'error'; ?>">
            <?php echo $message; ?>
        </p>
        <button class="go-back-button" onclick="history.back()">Go Back</button>
    </div>
</body>
</html>
