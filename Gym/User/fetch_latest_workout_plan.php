<?php
// Include database connection code if needed
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "adminpanel"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the latest workout plan
$sql = "SELECT * FROM workout_plans ORDER BY date_created DESC LIMIT 1";
$result = $conn->query($sql);

if ($result === false) {
    // Error in executing the query
    echo '{"error": "Error executing the query"}';
} else {
    if ($result->num_rows > 0) {
        // Fetch the latest workout plan data
        $latestWorkoutPlan = $result->fetch_assoc();
        // Return the latest workout plan data as JSON response
        echo json_encode($latestWorkoutPlan);
    } else {
        // No workout plan found
        echo '{"error": "No workout plan found"}';
    }
}

// Close the database connection
$conn->close();
?>
