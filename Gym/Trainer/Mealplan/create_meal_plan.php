<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_email = $_POST['user_email']; // Keep user_email for user lookup
    $trainer_name = $_POST['trainer_name'];
    $goal = $_POST['goal'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $meals = $_POST['meals'];

    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "gym_management_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the user exists in the user table
    $user_check_query = "SELECT email FROM user WHERE email = ?";
    $stmt = $conn->prepare($user_check_query);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        die("Error: User with email $user_email does not exist.");
    }

    // Insert data into the mealplan table
    $insert_mealplan_query = "INSERT INTO mealplan (user_id, trainer_name, goal, start_date, end_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_mealplan_query);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("sssss", $user_email, $trainer_name, $goal, $start_date, $end_date);
    $stmt->execute();
    $meal_plan_id = $stmt->insert_id;
    $stmt->close();

    // Insert meal details into the meal table
    $insert_meal_query = "INSERT INTO meal (meal_plan_id, type, option1, option1_desc, option2, option2_desc) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_meal_query);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    foreach ($meals as $meal) {
        $type = $meal['type'];
        $option1 = $meal['option1'];
        $option1_desc = $meal['option1_desc'];
        $option2 = $meal['option2'];
        $option2_desc = $meal['option2_desc'];
        
        $stmt->bind_param("isssss", $meal_plan_id, $type, $option1, $option1_desc, $option2, $option2_desc);
        $stmt->execute();
    }
    $stmt->close();
    $conn->close();

    // Generate PDF
    require('fpdf186/fpdf.php');
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Meal Plan');
    $pdf->Ln();

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(40, 10, 'User Email: ' . $user_email);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Trainer Name: ' . $trainer_name);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Goal: ' . $goal);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Start Date: ' . $start_date);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'End Date: ' . $end_date);
    $pdf->Ln();

    foreach ($meals as $meal) {
        $pdf->Ln();
        $pdf->Cell(40, 10, 'Type: ' . $meal['type']);
        $pdf->Ln();
        $pdf->Cell(40, 10, 'Option 1: ' . $meal['option1']);
        $pdf->Ln();
        $pdf->Cell(40, 10, 'Option 1 Description: ' . $meal['option1_desc']);
        $pdf->Ln();
        $pdf->Cell(40, 10, 'Option 2: ' . $meal['option2']);
        $pdf->Ln();
        $pdf->Cell(40, 10, 'Option 2 Description: ' . $meal['option2_desc']);
        $pdf->Ln();
    }

    $pdf->Output('D', 'meal_plan_' . $user_email . '.pdf');

    echo '<!DOCTYPE html>
              <html lang="en">
              <head>
                  <meta charset="UTF-8">
                  <meta name="viewport" content="width=device-width, initial-scale=1.0">
                  <title>Meal Plan Generated</title>
                  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
              </head>
              <body>
                  <script type="text/javascript">
                      Swal.fire({
                          icon: "success",
                          title: "Meal plan generated!",
                          text: "Meal plan generated successfully.",
                          timer: 4000,
                          showConfirmButton: false
                      }).then(function() {
                          window.location.href = "/Gym/Trainer/Mealplan/Mealplan.php";
                      });
                  </script>
              </body>
              </html>';
}
?>
