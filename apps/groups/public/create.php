<?php
// CREATE.php: add a product to the already existing json file.

require_once '../../../settings.php';
require_once APP_PATH.'/libraries/functions.php';

if(count($_POST)>0){
    // create applications array
    if($_POST['applicationName']!='')
    {
        // if the second field for application names is not empty.
        if($_POST['applicationName1']!='')
        {
            $applications=array($_POST['applicationName']=>$_POST['applicationDescription'],$_POST['applicationName1']=>$_POST['applicationDescription1']);
        }
        else{
            // only load the first two bits in.
            $applications=array($_POST['applicationName']=>$_POST['applicationDescription']);
        }
    }else{
        // create empty array for applications.
        $applications=array();
    }
    
    $result = createInJSON(APP_PATH.'/data/data.JSON',$applications);

    if($result==true)
    {
        header('location: index.php');
    }
}else{
?>
<a href="index.php">Product Index</a>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
    <div>
        <label>Guild Name</label><br />
        <input type="text" name="guildName" placeholder="Guild Name" />
    </div>
    <div>
        <label>Guild ID</label><br />
        <input type="text" name="guildID" placeholder="Guild ID" />
    </div>
    <div>
        <label>Guild Owner</label><br />
        <input type="text" name="owner" placeholder="Username of Owner" />
    </div>
    <div>
        <label>Guild Type</label><br />
        <input type="text" name="type" placeholder="Type of Guild" />
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
        <input type="integer" name="openToMembers" placeholder="0" />
    </div>
    <div>
        <label>Bio</label><br />
        <textarea name="guildBio" placeholder="Guild Description"></textarea><br />
    </div>

    <div>
	    <button type="submit" a href="index.php">Create</button>
    </div>
</form>
<?php 
}