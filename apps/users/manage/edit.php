<?php
// EDIT.php - Allow a user to change their own details
/* TODO:
    - allow user to add/edit other account information.
    - allow user to add/edit other games.
    - allow user to add a picture.
*/
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
    // send information to array builder.
    $updatedUser=newUserArrayBuilder($user['username'],$user['password'],$user['profilePicture'],$user['games'],$user['otherAccounts']);
    // write edit to file
   $result=updateInJSON(APP_PATH.'/data/users/users.JSON',$updatedUser,$index);

   if($result==true){
        header('location: detail.php?index='.$index);
    } 
}else{
?>
<a href="detail.php?index=<?= $index ?>">Return to Profile</a>
<form action="<?= $_SERVER['PHP_SELF'] ?>?index=<?= $_GET['index'] ?>" method="POST">
    <div>
        <label>Username</label><br />
        <input type="text" name="username" value="<?= $user['username'] ?>" disabled/>
    </div>
    <div>
        <label>Name</label><br />
        <input type="text" name="name" value="<?= $user['name'] ?>"/>
    </div>
    <div>
        <label>Email</label><br />
        <input type="email" name="email" value="<?= $user['email'] ?>"/>
    </div>
    <div>
        <label>Age Range</label><br />
        <input type="text" name="ageRange" value="<?= $user['ageRange'] ?>"/>
    </div>
    <div>
        <label>Timezone</label><br />
        <input type="text" name="timeZone" value="<?= $user['timeZone'] ?>"/>
    </div>
    <div>
        <label>Play Time</label><br />
        <input type="text" name="playTime" value="<?= $user['playTime'] ?>"/>
    </div>
    <div>
        <label>Looking for Group</label><br />
        <input type="radio" id="lfgYes" name="openToInvite" value="true" />
        <label for="lfgYes">Yes</label><br>
        <input type="radio" id="lfgNo" name="openToInvite" value="false" />
        <label for="lfgNo">No</label><br>
    </div>
    <div>
        <label>Open to Messages</label><br />
        <input type="radio" id="messagesYes" name="messagesOpen" value="true" />
        <label for="messagesYes">Yes</label><br>
        <input type="radio" id="messagesNo" name="messagesOpen" value="false" />
        <label for="messagesNo">No</label><br>
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
    <div>
	    <button type="submit" a href="detail.php?index=<?= $index ?>">Edit</button>
    </div>
</form>
<?php 
}