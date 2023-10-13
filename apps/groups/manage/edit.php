<?php
// EDIT.php - Allow Owner of group to change information.
/* TODO:
    - allow Owner to add more games to the guild.
    - allow Owner to customize, add, and assign ranks.
    - allow Owner to change guild info
    - allow Owner to add a picture.
*/

require_once '../../../settings.php';
// require_once '../../../navbar.php';
require_once APP_PATH.'/libraries/functions.php';
// Loading in a selected group.
$groups=readJSONFile(APP_PATH.'/data/groups/groups.JSON');
$index=$_GET['index'];
$guild=getItem($groups,$index);
// seperate members into their own array.
$members = $guild['members'];
// get the keys
$membersKey = array_keys($members);
// get join status
$status=groupJoinStatus($guild['freeToJoin']);
$i=1;
$int=0;
// get Group Ranks
$allRanks = readCSVFile(APP_PATH.'/data/groups/ranks.csv');
$ranks=getGroupRanks($allRanks,$guild['id'] );

if(count($_POST)>0){
    // send information to array builder.
    $updatedGroup=newGroupArrayBuilder($guild['games'],$guild['members']);
    // write edit to file
    $result=updateInJSON(APP_PATH.'/data/groups/groups.JSON',$updatedGroup,$index);

    if($result==true){
        header('location: index.php');
    }
}else{
?>
<a href="index.php">Groups Index</a>
<form action="<?= $_SERVER['PHP_SELF'] ?>?index=<?= $_GET['index'] ?>" method="POST">
    <div>
        <label>Group Name</label><br />
        <input type="text" name="groupName" value="<?= $guild['name'] ?>" required/>
    </div>
    <div>
        <label>Group ID</label><br />
        <input type="text" name="groupID" value="<?= $guild['id'] ?>" required/>
    </div>
    <div>
        <label>Group Owner</label><br />
        <select id="groupOwner" name="groupOwner">
        </select><br />
        <input type="text" name="owner" value="<?= $membersKey[0] ?>" required/>
    </div>
    <div>
        <label class="tooltip">Members & Ranks</label><br />
        <?php 
            while($i < count($members)){
                echo '<input type="text" name="memberUsername" value="'.$membersKey[$i].'" disabled/> | ';
                echo '<input type="text" name="memberRank" value="'.$members[$membersKey[$i]].'" disabled/> ';
                $i++;
                echo '<br>';
            }
        ?>
    </div>
   <?php /*<div>
        <label for='groupLogo'>Select a File</label><br />
        <input type="file" id='groupLogo' name="groupLogo"/>
    </div> */ ?>
    <div>
        <label>Group Type</label><br />
        <input type="text" name="type" value="<?= $guild['type'] ?>" required/>
    </div>
    <div>
        <label>Website Address</label><br />
        <input type="text" name="website" value="<?= $guild['website'] ?>" />
    </div>
    <div>
        <label>Website Text</label><br />
        <input type="text" name="webText" value="<?= $guild['webText'] ?>"" />
    </div>
    <div>
        <label>Accepting New Members</label><br />
        <input type="radio" id="Open" name="newMembers" value="1" />
        <label for="Open">Open To All</label><br>
        <input type="radio" id="Invite" name="newMembers" value="2" />
        <label for="Invite">Invite Only</label><br>
        <input type="radio" id="Closed" name="newMembers" value="3"/>
        <label for="Closed">Closed</label><br>
    </div>
    <div>
        <label>Bio</label><br />
        <textarea name="bio" placeholder="Group Description" required><?= $guild['bio'] ?></textarea><br />
    </div>

    <div>
	    <button type="submit" a href="detail.php?index=<?= $index ?>">Edit</button>
    </div>
</form>
<?php 
}