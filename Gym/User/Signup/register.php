<?php 
include 'connect.php';

if(isset($_POST['signUp'])){
    // Ensure $_POST variables are set and not empty before using them
    $firstName = isset($_POST['fName']) ? $_POST['fName'] : '';
    $lastName = isset($_POST['lName']) ? $_POST['lName'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['Phone']) ? $_POST['Phone'] : '';
    $weight = isset($_POST['weight']) ? $_POST['weight'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $password = md5($password);

    $checkEmail = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($checkEmail);
    if($result->num_rows > 0){
        echo '<!DOCTYPE html>
              <html lang="en">
              <head>
                  <meta charset="UTF-8">
                  <meta name="viewport" content="width=device-width, initial-scale=1.0">
                  <title>Registration Failed</title>
                  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
              </head>
              <body>
                  <script type="text/javascript">
                      Swal.fire({
                          icon: "warning",
                          title: "Registration failed",
                          text: "Email already exists.",
                          timer: 4000,
                          showConfirmButton: false
                      }).then(function() {
                          window.location.href = "login.html";
                      });
                  </script>
              </body>
              </html>';
    } else {
        // Corrected column names in the INSERT query
        $insertQuery = "INSERT INTO user (firstName, lastName, email, Phone, weight, gender, password)
            VALUES ('$firstName', '$lastName', '$email', '$phone', '$weight', '$gender', '$password')";

        if($conn->query($insertQuery) === TRUE){
            echo '<!DOCTYPE html>
                  <html lang="en">
                  <head>
                      <meta charset="UTF-8">
                      <meta name="viewport" content="width=device-width, initial-scale=1.0">
                      <title>Registration Successful</title>
                      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                  </head>
                  <body>
                      <script type="text/javascript">
                          Swal.fire({
                              icon: "success",
                              title: "Registration Successful",
                              text: "You have successfully registered!",
                              timer: 4000,
                              showConfirmButton: false
                          }).then(function() {
                              window.location.href = "login.html";
                          });
                      </script>
                  </body>
                  </html>';
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

if(isset($_POST['signIn'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);
    
    $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        header("Location: \Gym\User\Prograss\Dashboard.php");
        exit();
    } else {
        echo '<!DOCTYPE html>
              <html lang="en">
              <head>
                  <meta charset="UTF-8">
                  <meta name="viewport" content="width=device-width, initial-scale=1.0">
                  <title>Login Failed</title>
                  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
              </head>
              <body>
                  <script type="text/javascript">
                      Swal.fire({
                          icon: "error",
                          title: "Login failed",
                          text: "Your email not found or incorrect password.",
                          timer: 4000,
                          showConfirmButton: false
                      }).then(function() {
                          window.location.href = "login.html";
                      });
                  </script>
              </body>
              </html>';
    }
}
?>
