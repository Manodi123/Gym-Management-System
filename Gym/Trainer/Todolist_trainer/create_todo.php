<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym_management_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_email = $_POST['userEmail'];
    $task = $_POST['task'];
    $deadline = $_POST['deadline'];
    $priority = $_POST['priority'];
    $trainer_email = 'harshalakshitha123456@gmail.com'; // Replace with actual trainer email from session or input

    $sql = "INSERT INTO to_do_lists (user_email, trainer_email) VALUES (?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $user_email, $trainer_email);
        $stmt->execute();
        $todo_list_id = $stmt->insert_id;
        $stmt->close();

        $sql = "INSERT INTO to_do_tasks (todo_list_id, task, deadline, priority) VALUES (?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("isss", $todo_list_id, $task, $deadline, $priority);
            $stmt->execute();
            $stmt->close();

            $sql = "UPDATE to_do_requests SET status = 'Completed' WHERE user_email = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("s", $user_email);
                $stmt->execute();
                $stmt->close();
            }

            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false, 'error' => $conn->error));
        }
    } else {
        echo json_encode(array('success' => false, 'error' => $conn->error));
    }
}

$conn->close();
?>
