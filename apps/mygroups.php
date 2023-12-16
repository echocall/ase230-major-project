<?php
session_start();
require_once('../settings.php');
require('navbar.php');
require('../libraries/pdo.php');

// Check if user is logged in and has a valid user ID in the session
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php'); // Redirect to login page if not logged in
    exit();
}

$user_id = $_SESSION['user_id'];

// Database connection
$conn = new PDO("mysql:host=localhost;dbname=squadup", "username", "password");

// Prepare and execute query to fetch groups the user is part of
$stmt = $conn->prepare("SELECT g.GroupID, g.name, g.type FROM Groups g 
                         JOIN GroupMembers gm ON g.GroupID = gm.GroupID 
                         WHERE gm.UserID = :userid");
$stmt->bindParam(':userid', $user_id, PDO::PARAM_INT);
$stmt->execute();
$groups = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>User Groups - Group Finder</title>
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
    <link href="../themes/css/groupFinderStyle.css" rel="stylesheet" />
</head>
<body>
<!-- Existing Navbar Code -->

<div class="container">
    <div class="text-center mt-5">
        <h1>Your Groups</h1>
    </div>
    <div class="groups-list">
        <?php foreach ($groups as $group): ?>
            <div class="group">
                <h3><?= htmlspecialchars($group['name']) ?></h3>
                <p>Type: <?= htmlspecialchars($group['type']) ?></p>
                <a href="groupDetail.php?group_id=<?= $group['GroupID'] ?>">View Details</a>
            </div>
        <?php endforeach; ?>
        <?php if (count($groups) === 0): ?>
            <p>You are not part of any groups yet.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Bootstrap JS and other scripts -->
</body>
</html>
