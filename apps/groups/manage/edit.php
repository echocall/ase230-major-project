<?php
// EDIT.php: Allow Owner of group to change information.
require_once '../../../settings.php';
require_once '../../navbar.php';
require_once APP_PATH.'/libraries/functions.php';


//if ($_SESSION['role'] != 2) {
//    header('Location: index.php'); // Redirect to index page if not logged in as admin
//}

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
}

if (count($_POST) > 0) {
    // Update logic here
} else {
    // Retrieve form data
    $groupName = $_POST['groupName'];
    $owner = $_POST['owner'];
    $groupType = $_POST['type'];
    $website = htmlspecialchars($guild['website']);
    $webText = htmlspecialchars($guild['webtext']);
    $freeToJoin = htmlspecialchars($guild['freetojoin']);
    $bio = $_POST['bio'];    $stmt = $conn->prepare("INSERT INTO Groups (name, CreatorID, OwnerID, type, website, webText, freeToJoin, bio) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssis", $groupName, $owner, $owner, $groupType, $website, $webText, $freeToJoin, $bio);
    $stmt->execute();

    if ($result && $result->num_rows > 0) {
        $guild = $result->fetch_assoc();
        header('Location: index.php');
    } else {
        echo "Group not found.";
    }

    $stmt->close();
}

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
        <h1 class="fw-bolder">Edit <?= htmlspecialchars($guild['name']) ?></h1>
    </div>
</header>
<div class="container px-4 text-center"><br /><br />
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <div>
            <label>Group Name</label><br />
            <input type="text" name="groupName" value="<?= htmlspecialchars($guild['name']) ?>" required/>
        </div>
        <div>
            <label>Group Owner</label><br />
            <input type="text" name="owner" value="<?= htmlspecialchars($guild['ownerID']) ?>" required/>
        </div>
        <div>
            <label>Group Type</label><br />
            <input type="text" name="type" value="<?= htmlspecialchars($guild['type']) ?>" required/>
        </div>
        <div>
            <label>Bio</label><br />
            <input type="text" name="bio" value="<?= htmlspecialchars($guild['bio']) ?>" required/>
        </div><br />
        <div>
            <button class="btn btn-lg btn-dark" type="submit">Submit</button>
        </div>
        <!-- ... (other form fields as before) -->
    </form>
</div>
</body>
</html>
