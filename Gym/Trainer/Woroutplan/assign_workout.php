<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $assigned_by = $_POST['assigned_by'];
    $user_email = $_POST['user_email']; // Use user_email to check the user table
    $from_date = $_POST['from_date'];
    $no_of_days_repeat = $_POST['no_of_days_repeat'];

    $days = $_POST['day'];
    $workouts = $_POST['workout'];
    $weights = $_POST['weight'];
    $sets = $_POST['sets'];
    $reps = $_POST['reps'];
    $rests = $_POST['rest'];
    $descriptions = $_POST['description'];

    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "gym_management_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the user exists in the user table
    $user_check_query = "SELECT * FROM user WHERE email = ?";
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

    // Get the user_id from the user table
    $user_row = $result->fetch_assoc();
    $user_id = $user_row['email']; // Assuming email is used as user_id in workout_plan

    // Insert data into the workout_plan table
    $insert_plan_query = "INSERT INTO workout_plan (assigned_by, user_id, from_date, no_of_days_repeat) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_plan_query);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("sssi", $assigned_by, $user_id, $from_date, $no_of_days_repeat);
    $stmt->execute();
    $plan_id = $stmt->insert_id;
    $stmt->close();

    // Insert workout details into the workouts table
    $insert_workouts_query = "INSERT INTO workouts (plan_id, day, workout, weight, sets, reps, rest, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_workouts_query);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    for ($i = 0; $i < count($days); $i++) {
        $stmt->bind_param("issiiiss", $plan_id, $days[$i], $workouts[$i], $weights[$i], $sets[$i], $reps[$i], $rests[$i], $descriptions[$i]);
        $stmt->execute();
    }
    $stmt->close();
    $conn->close();

    // Generate PDF
    require('fpdf186/fpdf.php');
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,'Workout Plan');
    $pdf->Ln();

    $pdf->SetFont('Arial','',12);
    $pdf->Cell(40,10,'Assigned By: ' . $assigned_by);
    $pdf->Ln();
    $pdf->Cell(40,10,'User Email: ' . $user_email);
    $pdf->Ln();
    $pdf->Cell(40,10,'From Date: ' . $from_date);
    $pdf->Ln();
    $pdf->Cell(40,10,'No of Days Repeat: ' . $no_of_days_repeat);
    $pdf->Ln();
    
    for ($i = 0; $i < count($days); $i++) {
        $pdf->Ln();
        $pdf->Cell(40,10,'Day: ' . $days[$i]);
        $pdf->Ln();
        $pdf->Cell(40,10,'Workout: ' . $workouts[$i]);
        $pdf->Ln();
        $pdf->Cell(40,10,'Weight: ' . $weights[$i] . ' Kg');
        $pdf->Ln();
        $pdf->Cell(40,10,'Sets: ' . $sets[$i]);
        $pdf->Ln();
        $pdf->Cell(40,10,'Reps: ' . $reps[$i]);
        $pdf->Ln();
        $pdf->Cell(40,10,'Rest: ' . $rests[$i] . ' min');
        $pdf->Ln();
        $pdf->Cell(40,10,'Description: ' . $descriptions[$i]);
        $pdf->Ln();
    }

    $pdf->Output('D', 'workout_plan_' . $user_email . '.pdf');

    echo '<!DOCTYPE html>
              <html lang="en">
              <head>
                  <meta charset="UTF-8">
                  <meta name="viewport" content="width=device-width, initial-scale=1.0">
                  <title>Appointment Booked</title>
                  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
              </head>
              <body>
                  <script type="text/javascript">
                      Swal.fire({
                          icon: "success",
                          title: "Workout plan generated..!",
                          text: "Workout plan generated successfully.",
                          timer: 4000,
                          showConfirmButton: false
                      }).then(function() {
                          window.location.href = "Gym/Trainer/Woroutplan/assign_workout.php";
                      });
                  </script>
              </body>
              </html>';
}
?>
