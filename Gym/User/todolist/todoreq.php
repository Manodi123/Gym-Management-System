<?php
// db_connection.php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if the email exists in the users table
    $checkEmailQuery = "SELECT email FROM user WHERE email = ?";
    if ($checkStmt = $conn->prepare($checkEmailQuery)) {
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            // Insert the request into the to_do_requests table
            $insertQuery = "INSERT INTO to_do_requests (user_email, status) VALUES (?, 'Pending')";
            if ($insertStmt = $conn->prepare($insertQuery)) {
                $insertStmt->bind_param("s", $email);

                if ($insertStmt->execute()) {
                    // Show success message and redirect using JavaScript
                    echo '<!DOCTYPE html>
                          <html lang="en">
                          <head>
                              <meta charset="UTF-8">
                              <meta name="viewport" content="width=device-width, initial-scale=1.0">
                              <title>To-Do List Requested</title>
                              <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                          </head>
                          <body>
                              <script type="text/javascript">
                                  Swal.fire({
                                      icon: "success",
                                      title: "To-Do List Requested",
                                      text: "Your To-Do list has been successfully requested!",
                                      timer: 4000,
                                      showConfirmButton: false
                                  }).then(function() {
                                      window.location.href = "todolist.html";
                                  });
                              </script>
                          </body>
                          </html>';
                } else {
                    // Show error message if insertion fails
                    echo '<!DOCTYPE html>
                          <html lang="en">
                          <head>
                              <meta charset="UTF-8">
                              <meta name="viewport" content="width=device-width, initial-scale=1.0">
                              <title>Error</title>
                              <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                          </head>
                          <body>
                              <script type="text/javascript">
                                  Swal.fire({
                                      icon: "error",
                                      title: "Error",
                                      text: "There was an error submitting your request. Please try again later.",
                                      timer: 4000,
                                      showConfirmButton: false
                                  }).then(function() {
                                      window.location.href = "todolist.html";
                                  });
                              </script>
                          </body>
                          </html>';
                }

                $insertStmt->close();
            } else {
                echo "Error preparing statement: " . $conn->error;
            }
        } else {
            // Show error if email not found in users table
            echo '<!DOCTYPE html>
                  <html lang="en">
                  <head>
                      <meta charset="UTF-8">
                      <meta name="viewport" content="width=device-width, initial-scale=1.0">
                      <title>Error</title>
                      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                  </head>
                  <body>
                      <script type="text/javascript">
                          Swal.fire({
                              icon: "error",
                              title: "Error",
                              text: "Email not found. Please enter the valid email address.",
                              timer: 4000,
                              showConfirmButton: false
                          }).then(function() {
                              window.location.href = "todolist.html";
                          });
                      </script>
                  </body>
                  </html>';
        }
        $checkStmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
}
?>
