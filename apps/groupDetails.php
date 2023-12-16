<?php
session_start();
require_once('../settings.php');
require('navbar.php');
require('../libraries/pdo.php');

// Check for a valid group ID in the URL
if (!isset($_GET['group_id'])) {
    header('Location: index.php'); // Redirect to home if no group ID is provided
    exit();
}

$group_id = $_GET['group_id'];

// Database connection
$conn = new PDO("mysql:host=localhost;dbname=squadup", "username", "password");

// Prepare and execute query to fetch group details
$stmt = $conn->prepare("SELECT * FROM Groups WHERE GroupID = :groupid");
$stmt->bindParam(':groupid', $group_id, PDO::PARAM_INT);
$stmt->execute();
$group = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$group) {
    echo "<p>Group not found.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Group Details - Group Finder</title>
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
    <link href="../themes/css/groupFinderStyle.css" rel="stylesheet" />
</head>
<body>
<!-- Existing Navbar Code -->

<div class="container">
    <div class="text-center mt-5">
        <h1><?= htmlspecialchars($group['name']) ?></h1>
    </div>
    <div class="group-details">
        <p><strong>Type:</strong> <?= htmlspecialchars($group['type']) ?></p>
        <p><strong>Description:</strong> <?= htmlspecialchars($group['bio']) ?></p>
        <p><strong>Website:</strong> <a href="<?= htmlspecialchars($group['website']) ?>"><?= htmlspecialchars($group['website']) ?></a></p>
        <!-- Add more details as needed -->
    </div>
</div>

<!-- Bootstrap JS and other scripts -->
</body>
</html>
