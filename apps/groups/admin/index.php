<?php
$conn = new mysqli("localhost", "username", "password", "squadup");
require_once '../../../settings.php';
require_once APP_PATH.'/libraries/functions.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Groups";
$result = $conn->query($sql);

echo '<!-- About section-->
<section id="about">
    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">
                <h2>Guilds</h2>
                <a href="../manage/create.php?">Create A Guild</a> 
                <p class="lead">Browse the guilds open to the public to find your perfect match:</p>';

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $status = guildJoinStatus($row['freeToJoin']);
        ?>
        <div>
            <h3><?= $row['name'] ?></h3>
            <p>Owner: <?= $row['OwnerID']; ?> | Group Type: <?= $row['type'] ?> | Open to Join: <?= $status ?> </p>
            <p><?= $row['bio'] ?> </p><br />
            <a href="detail.php?group_id=<?= $row['GroupID'] ?>">View Details</a> |
            <a href="edit.php?group_id=<?= $row['GroupID'] ?>">Edit</a> |
            <a href="delete.php?group_id=<?= $row['GroupID'] ?>">Delete</a>
        </div>
        <hr />
        <?php
    }
} else {
    echo "0 results";
}

$conn->close();

echo '</div>
    </div>
</div>
</section>';
?>
