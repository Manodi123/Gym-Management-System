<?php
session_start();
require_once('fpdf186/fpdf.php'); // Make sure this path is correct for FPDF

$host = "localhost";
$user = "root";
$pass = "";
$db = "gym_management_db";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Failed to connect DB: " . $conn->connect_error);
}

if (!isset($_SESSION['email'])) {
    header("Location: /Gym/User/Signup/login.html");
    exit();
}

$email = $_SESSION['email'];

// Fetch user details
$sql = "SELECT firstName, lastName FROM user WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($firstName, $lastName);
$stmt->fetch();
$stmt->close();

$user_id = $_SESSION['email'];

// Fetch workout plan data
$plan_query = "SELECT * FROM workout_plan WHERE user_id = ?";
$stmt = $conn->prepare($plan_query);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$plan_result = $stmt->get_result();
$plan = $plan_result->fetch_assoc();
$stmt->close();

if (!$plan) {
    die("Error: Workout plan for User ID $user_id not found.");
}

// Fetch workout details
$workouts_query = "SELECT * FROM workouts WHERE plan_id = ?";
$stmt = $conn->prepare($workouts_query);
$stmt->bind_param("i", $plan['plan_id']);
$stmt->execute();
$workouts_result = $stmt->get_result();
$workouts = $workouts_result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$conn->close();

// Create PDF with FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Title
$pdf->Cell(0, 10, 'Workout Plan', 0, 1, 'C');
$pdf->Ln(10);

// Plan details
$pdf->Cell(0, 10, 'Assigned By: ' . $plan['assigned_by'], 0, 1);
$pdf->Cell(0, 10, 'From Date: ' . $plan['from_date'], 0, 1);
$pdf->Cell(0, 10, 'No of Days Repeat: ' . $plan['no_of_days_repeat'], 0, 1);
$pdf->Ln(10);

// Workouts
foreach ($workouts as $workout) {
    $pdf->Cell(0, 10, 'Day: ' . $workout['day'] . ' - ' . $workout['workout'], 0, 1);
    $pdf->Cell(0, 10, 'Weight: ' . $workout['weight'] . ' Kg', 0, 1);
    $pdf->Cell(0, 10, 'Sets: ' . $workout['sets'], 0, 1);
    $pdf->Cell(0, 10, 'Reps: ' . $workout['reps'], 0, 1);
    $pdf->Cell(0, 10, 'Rest: ' . $workout['rest'] . ' min', 0, 1);
    $pdf->Cell(0, 10, 'Description: ' . $workout['description'], 0, 1);
    $pdf->Ln(10);
}

// Output PDF
$pdf->Output('workout_plan.pdf', 'D');
?>
