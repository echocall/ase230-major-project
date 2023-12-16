<?php
// DETAIL.php: Specific group browsing page for non-logged in, or non-admin users.
require_once '../../../settings.php';
require_once APP_PATH.'/libraries/functions.php';

// Database connection
$conn = new mysqli("localhost", "username", "password", "squadup");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$group_id = isset($_GET['group_id']) ? intval($_GET['group_id']) : 0;

// Fetch group details
$sql = "SELECT * FROM Groups WHERE GroupID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $group_id);
$stmt->execute();
$result = $stmt->get_result();
$guild = $result->fetch_assoc();

if (!$guild) {
    echo "<p>Group not found.</p>";
    exit();
}

// Fetch group members
$sqlMembers = "SELECT UserID, role FROM GroupMembers WHERE GroupID = ?";
$stmtMembers = $conn->prepare($sqlMembers);
$stmtMembers->bind_param("i", $group_id);
$stmtMembers->execute();
$resultMembers = $stmtMembers->get_result();
$members = $resultMembers->fetch_all(MYSQLI_ASSOC);
?>
<div>
    <a href="index.php">Groups Index</a>
    <h2><?= htmlspecialchars($guild['name']) ?></h2>
    <p>Group Type: <?= htmlspecialchars($guild['type']) ?> | Open to Join: <?= groupJoinStatus($guild['freeToJoin']) ?> </p><br />
    <p>Website: <a href="<?= htmlspecialchars($guild['website']) ?>"><?= htmlspecialchars($guild['webText']) ?></a> </p><br />
    <p><?= htmlspecialchars($guild['bio']) ?></p>
    <h3>Members</h3>
    <?php
    foreach($members as $member){
        echo '<p>' . htmlspecialchars($member['role']) . ': ' . htmlspecialchars($member['UserID']) . '</p>';
    }
    ?>
</div>
<?php
$conn->close();
?>
