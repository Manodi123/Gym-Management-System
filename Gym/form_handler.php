<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Gym/connect.php');

if (isset($_POST['submit'])) {
    echo '<pre>';
    print_r($_POST);  // Print the entire POST array to see all submitted form data
    echo '</pre>';

    $name = $_POST['fname'];  // Access 'fname' for the name field
    $email = $_POST['email'];  // Correctly access 'email'
    $message = $_POST['message'];

    // Debugging: Check if form data is being received correctly
    if (empty($name) || empty($email) || empty($message)) {
        die("Form data is missing: name='$name', email='$email', message='$message'");
    }

    // Using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO contact (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
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
                          title: "Your message send successfully..&#128512",
                          text: "We will contact you soon, get in touch.",
                          timer: 4000,
                          showConfirmButton: false
                      }).then(function() {
                          window.location.href = "/Gym/index.html";
                      });
                  </script>
              </body>
              </html>';
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Form was not submitted.";
}
?>