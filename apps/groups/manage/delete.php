<?php
// DELETE.php: remove an already existing group.
require_once '../../../settings.php';
require_once '../../navbar.php';
require_once APP_PATH.'/libraries/functions.php';


//if ($_SESSION['role'] != 2) {
//    header('Location: index.php'); // Redirect to index page if not logged in as admin
//}

// Database connection
$conn = new mysqli("localhost", "root", "", "squadup");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$group_id = $_GET['group_id'] ?? 0;

if (count($_POST) > 0) {
    // Delete logic here
} else {
    // Fetch group details for confirmation
    $stmt = $conn->prepare("SELECT * FROM Groups WHERE GroupID = ?");
    $stmt->bind_param("i", $group_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $guild = $result->fetch_assoc();
        echo "Group successfully deleted.";
    } else {
        echo "Group not found.";
    }

    $stmt->close();
}

$conn->close();
?>
