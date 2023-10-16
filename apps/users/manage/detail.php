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

$accounts=$user['otherAccounts'];
$platformName=array_keys($accounts);

$i=0;
$int=0;

?>
    <div>
        <a href="index.php">Return to Users List</a>
        <h3><?= $user['username'] ?></h3>
        <p><b>Name:</b> <?= $user['name'] ?> | <b>Time Zone:</b> <?= $user['timeZone'] ?> | <b>Open To Invite:</b> <?= $inviteStatus ?> </p>
        <p><b>Play Time:</b> <?= $user['playTime'] ?> </p>
        <?php
            while($i < count($games)){
                echo '<p><b>'.$gameName[$i].'</b>: '.$games[$gameName[$i]].'</p>';
                $i++;
            }
        // reset game array index.
        $i=0;
        ?>
        <h3>Other Platforms</h3>
        <?php
            while($int < count($accounts)){
                echo '<p><b>'.$platformName[$int].'</b>: '.$accounts[$platformName[$int]].'</p>';
                $int++;
            }
        // reset account array index.
        $int=0;
        ?>
        <a href="#">Message this User</a> | Messages: <?= $messageStatus ?> | 
        <a href="edit.php?index=<?= $index ?>">Edit Profile</a> 
    </div>
<?php 