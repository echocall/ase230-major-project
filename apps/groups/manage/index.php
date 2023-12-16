<?php
// INDEX.php : Main browsing page for non-logged in or non-admin users.
require_once '../../../settings.php';
require_once '../../navbar.php';
require_once APP_PATH.'/libraries/functions.php';

// Database connection
$conn = new mysqli("localhost", "root", "", "squadup");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to select all groups
$sql = "SELECT * FROM Groups";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Squad Up</title>
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../../themes/css/styles.css" rel="stylesheet" />
</head>
<body>
<header class="bg-primary bg-gradient text-white">
    <div class="container px-4 text-center">
        <h1 class="fw-bolder">All Groups</h1>
    </div>
</header><br/><br/>
<div class="container px-4 text-center">
    <a class="btn btn-lg btn-dark" href="create.php?">Create new group</a>
</div><br/><br/>
<?php
echo '
    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">';

if ($result && $result->num_rows > 0) {
    while($guild = $result->fetch_assoc()) {
        $status = guildJoinStatus($guild['freetojoin']);
        ?>
        <div>
            <h3><?= htmlspecialchars($guild['name']) ?></h3>
            <p>Owner: <?= htmlspecialchars($guild['ownerID']); ?> | Group Type: <?= htmlspecialchars($guild['type']) ?> | Open to Join: <?= htmlspecialchars($status) ?> </p>
            <p><?= htmlspecialchars($guild['bio']) ?> </p><br />
            <a href="detail.php?group_id=<?= htmlspecialchars($guild['groupID']) ?>">View Details</a>
        </div>
        <hr />
        <?php
    }
} else {
    echo '<p>No groups found.</p>';
}

$conn->close();

echo '</div>
    </div>
</div>';
?>
