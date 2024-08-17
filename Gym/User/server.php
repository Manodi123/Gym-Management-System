<?php
// Database connection parameters
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

// Function to store a new message in the database
function storeMessage($sender_id, $recipient_id, $message) {
    global $conn;

    // Prepare and execute INSERT statement
    $sql = "INSERT INTO messages (sender_id, recipient_id, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $sender_id, $recipient_id, $message);
    $stmt->execute();

    // Check for errors
    if ($stmt->error) {
        return false;
    }

    return true;
}

// Function to fetch new messages from the database
function fetchMessages($lastMessageId) {
    global $conn;

    // Prepare and execute SELECT statement
    $sql = "SELECT * FROM messages WHERE id > ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $lastMessageId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch messages from the result set
    $messages = array();
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }

    return $messages;
}

// Check if there's a request to store a new message
if(isset($_POST['action']) && $_POST['action'] == 'send') {
    // Get message details from the POST request
    $sender_id = isset($_POST['sender_id']) ? $_POST['sender_id'] : null;
    $recipient_id = isset($_POST['recipient_id']) ? $_POST['recipient_id'] : null;
    $message = isset($_POST['message']) ? $_POST['message'] : null;

    // Store the message in the database
    $success = storeMessage($sender_id, $recipient_id, $message);

    // Send response
    if ($success) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false, 'error' => 'Failed to store message.'));
    }
}

// Check if there's a request to fetch new messages
if(isset($_GET['action']) && $_GET['action'] == 'fetch') {
    // Get last message ID from the GET request
    $lastMessageId = isset($_GET['last_message_id']) ? $_GET['last_message_id'] : 0;

    // Fetch new messages from the database
    $messages = fetchMessages($lastMessageId);

    // Return the messages as JSON
    echo json_encode($messages);
}

// Close the connection
$conn->close();
?>
