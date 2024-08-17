<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form login">
      <header>Gym Management System</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Not yet signed up? <a href="index.php">Signup now</a></div>
    </section>
    <form action="\Gym\User\Signup\login.html" method="POST" style="margin-top: 20px;">
      <div class="field button">
        <input type="submit" name="submit" value="          Go back-Gym                      " class="mr">
      </div>
    </form>
  </div>
  
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>

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
