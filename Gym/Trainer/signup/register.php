<?php 
include 'connect.php';

if(isset($_POST['signUp'])){
    // Ensure $_POST variables are set and not empty before using them
    $fullName = isset($_POST['fname']) ? $_POST['fname'] : '';
    $trainerID = isset($_POST['id']) ? $_POST['id'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $experience = isset($_POST['experience']) ? $_POST['experience'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $password = md5($password);

    $checkEmail = "SELECT * FROM trainers WHERE email='$email'";
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
                          icon: "error",
                          title: "Registration failed",
                          text: "Email already exists.",
                          timer: 4000,
                          showConfirmButton: false
                      }).then(function() {
                          window.location.href = "login.php";
                      });
                  </script>
              </body>
              </html>';
    } else {
        // Corrected column names in the INSERT query
        $insertQuery = "INSERT INTO trainers (name, id, email, phone, experience, password)
            VALUES ('$fullName', '$trainerID', '$email', '$phone', '$experience', '$password')";

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
                              window.location.href = "login.php";
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
    
    $sql = "SELECT * FROM trainers WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        header("Location: \Gym\Trainer\Appoinment\TrainerAppointment.php");
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
                          window.location.href = "login.php";
                      });
                  </script>
              </body>
              </html>';
    }
}
?>
