<?php
// DETAIL.php : Specific  guild browsing page for non-logged in, or non-admin users.
require_once '../../../settings.php';
require_once APP_PATH.'/libraries/functions.php';

$groups=readJSONFile(APP_PATH.'/data/groups/groups.JSON');

$index=$_GET['index'];

$guild=getGroup($groups,$index);

// seperate members into their own array.
$members = $guild['members'];
// get the keys
$membersKey = array_keys($members);

// get join status
$status=groupJoinStatus($guild['freeToJoin']);

$i=0;
?>
<div>
    <a href="index.php">Groups Index</a> 
    <h2><?= $guild['name'] ?></h2>
    <p>Group Type: <?= $guild['type'] ?> | Open to Join: <?= $status ?> </p><br />
    <p>Website: <a href="#"><?= $guild['website'] ?></a> <?= $guild['webText'] ?> </p><br />
    <p><?= $guild['bio'] ?></p>
    <h3>Members</h3>
    <?php 
        while($i < count($members)){
            echo '<p>'.$members[$membersKey[$i]].': '.$membersKey[$i].'</p>';
            $i++;
        }
    ?>
           
</div>
<?php 