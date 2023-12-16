<?php
// EDIT.php: Allow Owner of group to change information.
require_once '../../../settings.php';
require_once APP_PATH.'/libraries/functions.php';

$conn = new mysqli("localhost", "username", "password", "squadup");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$group_id = $_GET['group_id'] ?? 0;

if (count($_POST) > 0) {
    // Update logic here
} else {
    // Fetch current group details for editing
    $stmt = $conn->prepare("SELECT * FROM Groups WHERE GroupID = ?");
    $stmt->bind_param("i", $group_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $guild = $result->fetch_assoc();
        // Display the edit form with current values
    } else {
        echo "Group not found.";
    }

    $stmt->close();
}

$conn->close();
?>
