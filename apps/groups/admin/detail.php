<?php
require_once '../../../settings.php';
require_once APP_PATH.'/libraries/functions.php';

$conn = new mysqli("localhost", "username", "password", "groupfinder");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$group_id = isset($_GET['group_id']) ? intval($_GET['group_id']) : 0;

$sql = "SELECT * FROM Groups WHERE GroupID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $group_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $guild = $result->fetch_assoc();
    $status = guildJoinStatus($guild['freeToJoin']);
    ?>
    <div>
        <a href="index.php">Guild Index</a> | <a href="edit.php?group_id=<?= $group_id ?>">Edit This Group</a> | <a href="delete.php?group_id=<?= $group_id ?>">Delete This Group </a>
        <h2><?= htmlspecialchars($guild['name']) ?></h2>
        <p>Group Type: <?= htmlspecialchars($guild['type']) ?> | Open to Join: <?= htmlspecialchars($status) ?> </p><br />
        <p>Website: <a href="<?= htmlspecialchars($guild['website']) ?>"><?= htmlspecialchars($guild['website']) ?></a> <?= htmlspecialchars($guild['webText']) ?> </p><br />
        <p><?= htmlspecialchars($guild['bio']) ?></p>
        <h3>Members</h3>
        <?php
        ?>
    </div>
    <?php
} else {
    echo "Group not found.";
}

$conn->close();
?>
