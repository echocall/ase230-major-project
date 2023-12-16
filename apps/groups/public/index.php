<?php
// INDEX.php: Main browsing page for non-logged in or non-admin users.
require_once '../../../settings.php';
require_once APP_PATH.'/libraries/functions.php';

// Database connection - adjust with your actual database credentials
$conn = new mysqli("localhost", "username", "password", "squadup");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to select all groups
$sql = "SELECT * FROM Groups";
$result = $conn->query($sql);

echo '<!-- About section-->
<section id="about">
    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">
                <h2>Groups</h2>
                <p class="lead">Browse the groups open to the public to find your perfect match or create your own:</p>';

if ($result && $result->num_rows > 0) {
    // Output data of each row
    while($guild = $result->fetch_assoc()) {
        // Assume 'groupJoinStatus' function exists. You may need to adjust this based on your actual data
        $status = groupJoinStatus($guild['freeToJoin']);
        ?>
        <div>
            <h3><?= htmlspecialchars($guild['name']) ?></h3>
            <p>Owner: <?= htmlspecialchars($guild['OwnerID']) ?> | Group Type: <?= htmlspecialchars($guild['type']) ?> | Open to Join: <?= htmlspecialchars($status) ?> </p>
            <p><?= htmlspecialchars($guild['bio']) ?> </p><br />
            <a href="detail.php?group_id=<?= htmlspecialchars($guild['GroupID']) ?>">View Details</a>
        </div>
        <hr />
        <?php
    }
} else {
    echo "No groups found.";
}

$conn->close();

echo '</div>
    </div>
</div>
</section>';
?>
