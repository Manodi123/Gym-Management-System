<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: /Gym/User/Signup/login.html");
    exit();
}

$user_email = $_SESSION['email'];

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $queries = [];

    // Check and prepare SQL statements for each type of progress
    if (!empty($_POST['weight'])) {
        $weight = $_POST['weight'];
        $queries[] = "INSERT INTO weight_progress (user_email, date, weight) VALUES ('$user_email', '$date', '$weight')";
    }

    if (!empty($_POST['body_fat_percentage'])) {
        $body_fat_percentage = $_POST['body_fat_percentage'];
        $queries[] = "INSERT INTO body_fat_progress (user_email, date, body_fat_percentage) VALUES ('$user_email', '$date', '$body_fat_percentage')";
    }

    if (!empty($_POST['muscle_mass'])) {
        $muscle_mass = $_POST['muscle_mass'];
        $queries[] = "INSERT INTO muscle_gain_progress (user_email, date, muscle_mass) VALUES ('$user_email', '$date', '$muscle_mass')";
    }

    // Execute all queries
    $success = true;
    foreach ($queries as $query) {
        if (!$conn->query($query)) {
            echo "Error: " . $query . "<br>" . $conn->error;
            $success = false;
            break;
        }
    }

    if ($success) {
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Successfully</title>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </head>
        <body>
            <script type="text/javascript">
                Swal.fire({
                    icon: "success",
                    title: "Data Updated",
                    text: "Your progress data has been successfully updated!",
                    timer: 4000,
                    showConfirmButton: false
                }).then(function() {
                    window.location.href = "Dashboard.php";
                });
            </script>
        </body>
        </html>';
        exit();
    }
}

$conn->close();
?>
