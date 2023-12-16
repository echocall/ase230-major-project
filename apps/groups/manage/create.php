<?php
// CREATE.php: add a group to the database.

require_once '../../../settings.php';
require_once APP_PATH.'/libraries/functions.php';

// Connect to the database - adjust with your actual database credentials
$conn = new mysqli("localhost", "username", "password", "squadup");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read the game list from the database
$sqlGames = "SELECT GameID, Name FROM Games";
$resultGames = $conn->query($sqlGames);
$gameList = [];
if ($resultGames && $resultGames->num_rows > 0) {
    while($row = $resultGames->fetch_assoc()) {
        $gameList[$row['GameID']] = $row['Name'];
    }
}

if(count($_POST) > 0){
    // Retrieve form data
    $groupName = $_POST['groupName'];
    $owner = $_POST['owner'];
    $groupType = $_POST['type'];
    $website = $_POST['website'];
    $webText = $_POST['webText'];
    $newMembers = $_POST['newMembers'];
    $bio = $_POST['bio'];
    $chooseGame = $_POST['chooseGame'];

    $stmt = $conn->prepare("INSERT INTO Groups (name, CreatorID, type, website, webText, freeToJoin, bio) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssis", $groupName, $owner, $groupType, $website, $webText, $newMembers, $bio);
    $stmt->execute();

    if($stmt->affected_rows > 0) {
        header('location: index.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    ?>
    <a href="index.php">Groups Index</a>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <div>
            <label>Group Name</label><br />
            <input type="text" name="groupName" placeholder="Group Name" required/>
        </div>
        <div>
            <label>Group Owner</label><br />
            <input type="text" name="owner" placeholder="Owner ID" required/>
        </div>
        <div>
            <label>Group Type</label><br />
            <input type="text" name="type" placeholder="Type of Group" required/>
        </div>
        <!-- ... (other form fields as before) -->
    </form>
    <?php
}
$conn->close();
?>
