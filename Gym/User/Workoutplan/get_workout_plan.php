<?php
session_start(); // Start the session

// Check if user_id is set in GET parameters
if (isset($_GET['user_id'])) {
    // Store the user_id in a session variable
    $_SESSION['user_id'] = $_GET['user_id'];
} else {
    // If user_id is not set in GET parameters, check if it's already stored in session
    if (!isset($_SESSION['user_id'])) {
        die("Error: User ID not provided.");
    }
}

$user_id = $_SESSION['user_id'];

// Connect to the database
$conn = new mysqli("localhost", "root", "", "adminpanel");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT workouts.day, workouts.workout, workouts.weight, workouts.sets, workouts.reps, workouts.rest, workouts.description
        FROM workout_plan
        JOIN workouts ON workout_plan.plan_id = workouts.plan_id
        WHERE workout_plan.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$workout_plan = [];
while ($row = $result->fetch_assoc()) {
    $workout_plan[] = $row;
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($workout_plan);
?>
