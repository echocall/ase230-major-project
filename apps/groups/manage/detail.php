<?php
// DETAIL.php: Specific guild browsing page for non-logged in, or non-admin users.
require_once '../../../settings.php';
require_once '../../navbar.php';
require_once APP_PATH.'/libraries/functions.php';

$conn = new mysqli("localhost", "root", "", "squadup");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$group_id = $_GET['group_id'] ?? 0;
$stmt = $conn->prepare("SELECT * FROM Groups WHERE GroupID = ?");
$stmt->bind_param("i", $group_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $guild = $result->fetch_assoc();
    // Display the details
} else {
    echo "Group not found.";
}

$stmt->close();
$conn->close();
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
            <h1 class="fw-bolder"><?= htmlspecialchars($guild['name']) ?></h1>
        </div>
    </header><br /><br />
    <div class="container px-4 text-center">
        <h5>Bio: <?= htmlspecialchars($guild['bio']) ?></h5>
        <h5>Type: <?= htmlspecialchars($guild['type']) ?></h5>
        <h5>Creator: <?= htmlspecialchars($guild['creatorID']) ?></h5>
        <h5>Owner: <?= htmlspecialchars($guild['ownerID']) ?></h5>
        <h5>Timezone: <?= htmlspecialchars($guild['timezone']) ?></h5>
        <h5>Website: <a href="//<?= htmlspecialchars($guild['website']) ?>"><?= htmlspecialchars($guild['webtext']) ?></a></h5><br />
        <a class="btn btn-lg btn-dark" href="edit.php?group_id=<?= $group_id ?>">Edit group</a>
        <a class="btn btn-lg btn-dark" href="delete.php?group_id=<?= $group_id ?>">Delete group</a>
        <a class="btn btn-lg btn-dark" href="index.php?">Back</a>
    </div>
</body>
</html>