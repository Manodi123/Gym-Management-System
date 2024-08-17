<?php
    include("connect.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Trainer Login</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <div class="cont">
        <div class="main">
            <img src="Image/undraw_fitness_tracker_3033.svg" alt="fitness-image">
            <div class="container" id="signup" style="display:none;">
                <h1 class="form-title">Create Trainer Account</h1>
                <form method="post" action="register.php">
                  <div class="input-group">
                     <i class="fas fa-user"></i>
                     <input type="text" name="name" id="fname" placeholder="Full Name" required>
                     <label for="fname">Full Name</label>
                  </div>
                  <div class="input-group">
                      <i class="fas fa-user"></i>
                      <input type="text" name="id" id="id" placeholder="Trainer ID" required>
                      <label for="id">Trainer ID</label>
                  </div>
                  <div class="input-group">
                      <i class="fas fa-envelope"></i>
                      <input type="email" name="email" id="email" placeholder="Email" required>
                      <label for="email">Email</label>
                  </div>
                  <div class="input-group">
                    <i class="fas fa-phone"></i>
                    <input type="tel" name="phone" id="phone" placeholder="077-453 2145" required>
                    <label for="Phone">Phone</label>
                </div>
                    <div class="input-group">
                    <i class="fas fa-clock"></i>
                    <input type="text" name="experience" id="experience" placeholder="How many years" required>
                    <label for="experience">How many years</label>
                </div>


                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
                 <input type="submit" class="btn" value="Sign Up" name="signUp">
                </form>
                <div class="links">
                    <p>Already have account.</p>
                    <button id="signInButton">Sign In</button>
                  </div>
              </div>
          
              <div class="container" id="signIn">
                  <h1 class="form-title">Sign In</h1>
                  <form method="post" action="register.php">
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" id="email" placeholder="Email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>
                    <p class="recover">
                      <a href="#">Recover Password</a>
                    </p>
                   <input type="submit" class="btn" value="Sign In" name="signIn">
                  </form>
                  <div class="links">
                    <p>Don't have account yet?</p>
                    <button id="signUpButton">Sign Up</button>
                  </div>
                </div>
                <script src="script.js"></script>
        </div>
    </div>
    <?php
    include("connect.php");

    // Check if user is registered
    if(isset($_GET['registered']) && $_GET['registered'] == 'true') {
        echo "<p>User registered successfully! Please login.</p>";
    }
?>

</body>
</html>

