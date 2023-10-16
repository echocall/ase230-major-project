<?php
// DETAIL.php : Specific  guild browsing page for non-logged in, or non-admin users.
require_once '../../../settings.php';
require_once APP_PATH.'/libraries/functions.php';

$users=readJSONFile(APP_PATH.'/data/users/users.JSON');
$usersKey = array_keys($users);

$index=$_GET['index'];

$user=getItem($users,$index);


$games=$user['games'];
$gameName=array_keys($games);
$messageStatus = userMessageStatus($user['messagesOpen']);
$inviteStatus = userInviteStatus($user['openToInvite']);

$i=0;
?>
    <div>
        <a href="index.php">Return to Users List</a>
        <h3><?= $user['username'] ?></h3>
        <p><b>Name:</b> <?= $user['name'] ?> | Time Zone: <?= $user['timeZone'] ?> | Open To Invite: <?= $inviteStatus ?> </p>
        <?php
            while($i < count($games)){
                echo '<p><b>'.$gameName[$i].'</b>: '.$games[$gameName[$i]].'</p>';
                $i++;
            }
        // reset game array index.
        $i=0;
        ?>
        <a href="#">Message this User</a> | Messages: <?= $messageStatus ?>
        <a href="detail.php?index=<?= $index ?>">View Details</a>  | <a href="edit.php?index=<?= $index ?>">Edit User</a> | <a href="delete.php?index<?= $index ?>">Delete User</a>
    </div>
<?php 