<?php
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $user_email = $_POST['user_email'];
    $trainer_email = $_POST['trainer_email'];
    $appointment_date = $_POST['appointment_date'] . ' ' . $_POST['appointment_time'];
    $message = $_POST['message'];
    $status = isset($_POST['status']) ? $_POST['status'] : 'pending'; // default to pending if not set

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO appointments (user_email, trainer_email, appointment_date, message, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $user_email, $trainer_email, $appointment_date, $message, $status);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to index.php and show success alert using JavaScript
        echo '<!DOCTYPE html>
              <html lang="en">
              <head>
                  <meta charset="UTF-8">
                  <meta name="viewport" content="width=device-width, initial-scale=1.0">
                  <title>Appointment Booked</title>
                  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
              </head>
              <body>
                  <script type="text/javascript">
                      Swal.fire({
                          icon: "success",
                          title: "Appointment Booked",
                          text: "Your appointment has been successfully booked!",
                          timer: 4000,
                          showConfirmButton: false
                      }).then(function() {
                          window.location.href = "";
                      });
                  </script>
              </body>
              </html>';
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
}

$conn->close();
?>
