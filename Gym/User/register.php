<?php 
    include 'connect.php';

    if(isset($_POST['signUp'])){
        $firstName = $_POST['fName'];
        $lastName = $_POST['lName'];
        $email = $_POST['email'];
        $weight = $_POST['weight'];
        $gender = $_POST['gender'];
        $phone = $_POST['Phone'];
        $password = $_POST['password'];
        $password = md5($password);

        $checkEmail = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($checkEmail);
        if($result->num_rows > 0){
            echo "Email Address Already Exists!";
        } else {
            $insertQuery = "INSERT INTO users (firstName, lastName, email, phone, weight, gender, password)
                            VALUES ('$firstName', '$lastName', '$email', '$phone', '$weight', '$gender', '$password')";
            if($conn->query($insertQuery) === TRUE){
                header("location: login.php?registered=true"); // Redirect to login screen
                exit();
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }

    if(isset($_POST['signIn'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = md5($password);
        
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            session_start();
            $row = $result->fetch_assoc();
            $_SESSION['email'] = $row['email'];
            header("Location: Sidebar/index.php");
            exit();
        } else {
            echo "Not Found, Incorrect Email or Password";
        }
    }
?>
