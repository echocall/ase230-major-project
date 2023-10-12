<?php
// CREATE.php: add a group to the already existing json file.

require_once '../../../settings.php';
require_once APP_PATH.'/libraries/functions.php';

/* TODO: 
    - change the 'Create Applications Array' into 'create Games array'
    - feed the Group Owner information into the Members array.
    - put an explanation of how Accepting New Members works.
    - pick first game to be associated with from dropdown list
*/

$gameList=readCSVFileLine(APP_PATH.'/data/games.csv');

$i=0;

if(count($_POST)>0){
    // create games array
    if($_POST['chooseGame']!='')
    {
      // write the data to array.
      $games=array($_POST('games'));
    }else{
        // create empty array for applications.
        $games=array();
    }
    
    $result = createInJSON(APP_PATH.'/data/data.JSON',$applications);

    if($result==true)
    {
        header('location: index.php');
    }
}else{
?>
<a href="index.php">Groups Index</a>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
    <div>
        <label>Group Name</label><br />
        <input type="text" name="groupName" placeholder="Group Name" />
    </div>
    <div>
        <label>Group ID</label><br />
        <input type="text" name="groupID" placeholder="###" />
    </div>
    <div>
        <label>Group Owner</label><br />
        <input type="text" name="owner" placeholder="Username of Owner" />
    </div>
    <div>
        <label>Group Type</label><br />
        <input type="text" name="type" placeholder="Type of Group" />
    </div>
    <div>
        <label>Choose A Game:</label><br />
        <select id="chooseGame" name="chooseGame">
            <?php
                foreach($gameList as $game){
                    echo '<option value="'.$game.'">'.$game.'</option>';
                }
            ?>
        </select>
    </div>
    <div>
        <label>Website Address</label><br />
        <input type="text" name="website" placeholder="www.example.com" />
    </div>
    <div>
        <label>Website Text</label><br />
        <input type="text" name="webText" placeholder="View our website!" />
    </div>
    <div>
        <label>Accepting New Members</label><br />
        <input type="radio" id="Open" name="newMembers" value="1" />
        <label for="Open">Open To All</label><br>
        <input type="radio" id="Invite" name="newMembers" value="2" />
        <label for="Invite">Invite Only</label><br>
        <input type="radio" id="Closed" name="newMembers" value="3" />
        <label for="Closed">Closed</label><br>
    </div>
    <div>
        <label>Bio</label><br />
        <textarea name="bio" placeholder="Group Description"></textarea><br />
    </div>

    <div>
	    <button type="submit" a href="index.php">Create</button>
    </div>
</form>
<?php 
}