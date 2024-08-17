<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Create Massenger account..! </header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="First name" required>
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last name" required>
          </div>
        </div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter new password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Already signed up? <a href="login.php">Login now</a></div>
    </section>
    <form action="\Gym\User\Signup\login.html" method="POST" style="margin-top: 20px;">
      <div class="field button">
        <input type="submit" name="submit" value="          Go back-Gym                      " class="mr">
      </div>
    </form>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

  <style>
    .mr{
      padding: 10px 140px; 
      background-color: #2196F3; 
      color: white; 
      border: none; 
      cursor: pointer; 
      transition: background-color 0.3s, box-shadow 0.3s;
    }

    .field.button input[type="submit"]:hover {
      background-color: #1569ac;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }
  </style>
</body>
</html>
