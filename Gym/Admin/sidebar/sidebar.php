

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Gym dashbord</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'>
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <div class="content">
<!-- partial:index.partial.html -->
<div id="nav-bar">
  <input id="nav-toggle" type="checkbox"/>
  <div id="nav-header"><a id="nav-title" href="#" target="_blank">GYM
  <?php 
   if(isset($_SESSION['name'])){
    $name=$_SESSION['name'];
    $query=mysqli_query($conn, "SELECT * FROM `admin` WHERE name='$name'");
    while($row=mysqli_fetch_array($query)){
        echo $row['name'];
    }
   }
   ?>
  </a>
    <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
    <hr/>
  </div>
  <div id="nav-content">
          <div class="nav-button"><i class="fas fa-tachometer-alt"></i></i><a href="/gym/admin/function/AdminDashbaord.php"><span>Dashboard</span></a></div>
          <div class="nav-button"><i class="fa fa-users"></i><a href="Memeber.php"><span>Member List</span></a></div>
          <div class="nav-button"><i class="fa fa-user-plus"></i><a href="Memberentry.php"><span>Member Entry</span></a></div>
          <div class="nav-button"><i class="fa fa-users-cog"></i><a href="Trainerlist.php"><span>Trainer List</span></a></div>
          <div class="nav-button"><i class="fa fa-user-tie"></i><a href="Trainerentry.php"><span>Trainer Entry</span></a></div>
          <div class="nav-button"><i class="fas fa-clipboard-check"></i><a href="/gym/admin/function/Attendance.php"><span>Attendance</span></a></div>
          <div class="nav-button"><i class="fa fa-comment-dots"></i><a href="Feedback.php"><span>Feedback</span></a></div>
    <hr/>
    <div class="nav-button"><i class="fa fa-sign-out"></i><a href="/Gym/index.html"><span>Log-out</span></a></div>
    <hr/>
    <div id="nav-content-highlight"></div>
  </div>
  <input id="nav-footer-toggle" type="checkbox"/>
  <div id="nav-footer">
    <div id="nav-footer-heading">
      <div id="nav-footer-avatar"><img src="https://gravatar.com/avatar/4474ca42d303761c2901fa819c4f2547"/></div>
      <div id="nav-footer-titlebox"><a id="nav-footer-title" href="#" target="_blank">User</a><span id="nav-footer-subtitle">Admin</span></div>
      <label for="nav-footer-toggle"><i class="fas fa-caret-up"></i></label>
    </div>
    <div id="nav-footer-content">
      <Lorem>ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</Lorem>
    </div>
  </div>
</div>



</div>
</body>
</html>


