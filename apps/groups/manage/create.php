<?php
// CREATE.php: add a group to the already existing json file.

require_once '../../../settings.php';
require_once APP_PATH.'/libraries/functions.php';

/* TODO: 
    - change the 'Create Applications Array' into 'create Games array'
    - feed the Group Owner information into the Members array.
    - put an explanation of how Accepting New Members works.
    - pick first game to be associated with from dropdown list
    - Make better way of doing GroupID
*/

$gameList=readCSVFileLine(APP_PATH.'/data/games.csv');
$i=0;

if(count($_POST)>0){
    // create games array
    if($_POST['chooseGame']!='')
    {
      // write the data to array.
      $games=array($_POST['chooseGame']);
    }else{
        // create empty array for applications.
        $games=array();
    }

    // create Users array with owner
    if($_POST['owner']!='')
    {
        // write the data to array.
        $members=array($_POST['owner']=>'Owner');
    }else{
        // create empty array for applications.
        $members=array();
    }

    // assembles all the pieces into array
    $newGroup=newArrayBuilder($games,$members);

    // sends array to be written to JSON file.
    $result = createInJSON(APP_PATH.'/data/groups/groups.JSON',$newGroup);

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
        <input type="text" name="groupName" placeholder="Group Name" required/>
    </div>
    <div>
        <label>Group ID</label><br />
        <input type="text" name="groupID" placeholder="###" required/>
    </div>
    <div>
        <label>Group Owner</label><br />
        <input type="text" name="owner" placeholder="Username of Owner" required/>
    </div>
    <div>
        <label for='groupLogo'>Select a File</label><br />
        <input type="file" id='groupLogo' name="groupLogo"/>
    </div>
    <div>
        <label>Group Type</label><br />
        <input type="text" name="type" placeholder="Type of Group" required/>
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
        <input type="radio" id="Closed" name="newMembers" value="3" checked/>
        <label for="Closed">Closed</label><br>
    </div>
    <div>
        <label>Bio</label><br />
        <textarea name="bio" placeholder="Group Description" required></textarea><br />
    </div>

    <div>
	    <button type="submit" a href="index.php">Create</button>
    </div>
</form>
<?php 
}