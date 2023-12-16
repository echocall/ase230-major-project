<?php
// DELETE.php: remove an already existing user.

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

$i = 0;
$int = 0;

// seperate members into their own a
if(count($_POST)>0){
    echo '<br><br>';
    // delete the file.
    $result=deleteFromJSON(APP_PATH.'/data/users/users.JSON',$index);
    echo $result;

if($result==true){
  header('location: index.php');
}
}else{
?>
<a href="index.php">Return to Users List</a>
<p>Are you sure you want to delete this user?</p>
<form action="<?= $_SERVER['PHP_SELF'] ?>?index=<?= $_GET['index'] ?>" method="POST">
    <div>
        <label>Username</label><br />
        <input type="text" name="username" value="<?= $user['username'] ?>" disabled/>
    </div>
    <div>
        <label>Name</label><br />
        <input type="text" name="name" value="<?= $user['name'] ?>" disabled/>
    </div>
    <div>
        <label>Email</label><br />
        <input type="email" name="email" value="<?= $user['email'] ?>" disabled/>
    </div>
    <div>
        <label>Timezone</label><br />
        <input type="text" name="timeZone" value="<?= $user['timeZone'] ?>" disabled/>
    </div>
    <div>
        <label>Play Time</label><br />
        <input type="text" name="playTime" value="<?= $user['playTime'] ?>" disabled/>
    </div>
    <div>
        <label class="tooltip">Games</label><br />
        <?php 
            while($i < count($games)){
                echo '<input type="text" name="gameName" value="'.$gameName[$i].'" disabled/> | ';
                echo '<input type="text" name="gameDetails" value="'.$games[$gameName[$i]].'" disabled/> ';
                $i++;
                echo '<br>';
            }
        ?>
    </div>
    <div>
        <label class="tooltip">Other Accounts</label><br />
        <?php 
            while($int < count($accounts)){
                echo '<input type="text" name="platformName" value="'.$platformName[$int].'" disabled/> | ';
                echo '<input type="text" name="platformAccount" value="'.$accounts[$platformName[$int]].'" disabled/> ';
                $int++;
                echo '<br>';
            }
        ?>
    </div>
    <div>
	    <button type="submit" a href="index.php">Delete</button>
    </div>
</form>
<?php 
}