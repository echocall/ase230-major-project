<?php
// CREATE.php: add a group to the database.

require_once '../../../settings.php';
require_once '../../navbar.php';
require_once APP_PATH.'/libraries/functions.php';

//if ($_SESSION['role'] == 0) {
//    header('Location: index.php'); // Redirect to index page if not logged in
//}

// Connect to the database - adjust with your actual database credentials
$conn = new mysqli("localhost", "root", "", "squadup");

// Check connection
if ($conn->connect_error) {   die("Connection failed: " . $conn->connect_error);
}

if(count($_POST) > 0){
    // Retrieve form data
    $groupName = $_POST['groupName'];
    $owner = $_POST['owner'];
    $groupType = $_POST['type'];
    $website = 'website';
    $webText = 'website';
    $freeToJoin = 1;
    $bio = $_POST['bio'];    $stmt = $conn->prepare("INSERT INTO Groups (name, CreatorID, OwnerID, type, website, webText, freeToJoin, bio) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssis", $groupName, $owner, $owner, $groupType, $website, $webText, $freeToJoin, $bio);
    $stmt->execute();

    if($stmt->affected_rows > 0) {
        header('location: index.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
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
            <h1 class="fw-bolder">Create a New Group</h1>
        </div>
    </header>
    <div class="container px-4 text-center"><br /><br />
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <div>
                <label>Group Name</label><br />
                <input type="text" name="groupName" placeholder="Group Name" required/>
            </div>
            <div>
                <label>Group Owner</label><br />
                <input type="text" name="owner" placeholder="Owner Username" required/>
            </div>
            <div>
                <label>Group Type</label><br />
                <input type="text" name="type" placeholder="Type of Group" required/>
            </div>
            <div>
                <label>Bio</label><br />
                <input type="text" name="bio" placeholder="Group Bio" required/>
            </div><br />
            <div>
                <button class="btn btn-lg btn-dark" type="submit">Create group</button>
            </div>
            <!-- ... (other form fields as before) -->
        </form>
    </div>
</body>
    </html>
    <?php
}
$conn->close();
?>
