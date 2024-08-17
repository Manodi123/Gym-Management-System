<?php
require('fpdf186/fpdf.php');

session_start();

if (!isset($_SESSION['email'])) {
    // Redirect to login page if not logged in
    header("Location: /gym/user/signup/login.html");
    exit();
}

// Retrieve the form data
$trainer_name = $_POST['trainer_name'];
$goal = $_POST['goal'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

// Check if meals is a string or array
$meals = isset($_POST['meals']) ? $_POST['meals'] : '';

// Check if it's a JSON string and decode
if (is_string($meals)) {
    $meals = json_decode($meals, true); // Decode the JSON string
    if (json_last_error() !== JSON_ERROR_NONE) {
        die('JSON decode error: ' . json_last_error_msg()); // Output JSON decode errors
    }
} elseif (is_array($meals)) {
    // No decoding needed if it's already an array
} else {
    die('Invalid meals data'); // Handle invalid data
}

// Create a new PDF document
class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, 'Meal Plan', 0, 1, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Meal Plan Details
$pdf->Cell(40, 10, 'Trainer Name: ');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, $trainer_name, 0, 1);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Goal: ');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, $goal, 0, 1);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Start Date: ');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, $start_date, 0, 1);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'End Date: ');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, $end_date, 0, 1);

// Meal Details
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Meals', 0, 1);

if (is_array($meals)) {
    foreach ($meals as $meal) {
        if (is_array($meal)) { // Ensure $meal is an array
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 10, 'Type: ' . $meal['type'], 0, 1);
            
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(0, 10, 'Option 1: ' . $meal['option1'], 0, 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->MultiCell(0, 10, 'Description: ' . $meal['option1_desc']);

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(0, 10, 'Option 2: ' . $meal['option2'], 0, 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->MultiCell(0, 10, 'Description: ' . $meal['option2_desc']);

            $pdf->Ln(5);
        } else {
            $pdf->Cell(0, 10, 'Invalid meal data', 0, 1);
        }
    }
} else {
    $pdf->Cell(0, 10, 'No meals available', 0, 1);
}

// Output the PDF
$pdf->Output('D', 'Meal_Plan.pdf');
?>
