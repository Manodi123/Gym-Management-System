<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration Successful</title>
  <style>
    /* Background gradient with two colors */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 150px;
      text-align: center;
      background-image: linear-gradient(to right, #f7f7f7, #e0e0e0); /* Light gray gradient */
    }

    h1 {
      font-size: 3em;
      margin-bottom: 20px;
      color: #C40C0C;
      animation: tada 1.5s infinite alternate ease-in-out; /* Tada animation */
    }

    @keyframes tada {
      from {
        transform: scale(1);
      }
      
      10%, 20%, 30%, 50%, 70%, 80%, 90% {
        transform: scale(0.9) scaleY(1.1);
      }
      
      40%, 60% {
        transform: scale(1.1) scaleY(0.9);
      }
      
      to {
        transform: scale(1);
      }
    }

    p {
      font-size: 20px;
      color:; /* Gray text */
      font-weight: bold; /* Bold text for emphasis */
    }

    a {
      background-color: #C40C0C; 
      border: none;
      color: white;
      padding: 15px 30px; /* Increased padding for better visual weight */
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 18px; /* Larger font size for the button */
      margin-top: 20px;
      cursor: pointer;
      border-radius: 10px; /* More rounded corners */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15); /* Increased shadow for depth */
      transition: background-color 0.2s ease-in-out; /* Smooth transition on hover */
    }

    a:hover {
      background-color: brown; 
    }
  </style>
</head>
<body>
  <h1>Congratulations!</h1>
  <p>Your registration was successful.</p>
  <a href="login.php">Login Here</a>
</body>
</html>
