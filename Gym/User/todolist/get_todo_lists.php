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

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Fetch to-do lists for the user
    $sql = "SELECT t.task, t.deadline, t.priority, t.status 
            FROM to_do_tasks t
            JOIN to_do_lists l ON t.todo_list_id = l.id
            WHERE l.user_email = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        $tasks = array();
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }

        if (count($tasks) === 0) {
            // No tasks found, insert a request into to_do_requests table
            $insertQuery = "INSERT INTO to_do_requests (user_email, status) VALUES (?, 'Pending')";
            if ($insertStmt = $conn->prepare($insertQuery)) {
                $insertStmt->bind_param("s", $email);
                $insertStmt->execute();
                $insertStmt->close();
            }
        }

        echo json_encode($tasks);
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

$conn->close();
?>
