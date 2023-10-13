<?php 
// INDEX.php : Main browsing page for logged in users.
require_once '../../../settings.php';
require_once APP_PATH.'/libraries/functions.php';

$users=readJSONFile(APP_PATH.'/data/users/users.JSON');
$usersKey = array_keys($users);

$index=0;

echo '<!-- About section-->
<section id="about">
    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">
                <h2>Guilds</h2>
                <a href="create.php?">Create A Guild</a> 
                <p class="lead">Browse the guilds open to the public to find your perfect match:</p>';

                foreach($users as $user){
                    $games=$user['games'];
                    $gameName=array_keys($games);
                    $messageStatus = userMessageStatus($user['messagesOpen']);
                    $inviteStatus = userInviteStatus($user['openToInvite']);
                    
                ?>
                    <div>
                        <h3><?= $user['name'] ?></h3>
                        <p>Username: <?= $user['username'] ?> | Time Zone: <?= $user['timeZone'] ?> | Open To Invite: <?= $inviteStatus ?> </p>
                        <?php
                            while($i < count($games)){
                                echo '<p><b>'.$gameName[$i].'</b>: '.$games[$gameName[$i]].'</p>';
                                $i++;
                            }
                        ?>
                        <a href="#">Message this User</a> | Messages: <?= $messageStatus ?>
                        <a href="detail.php?index=<?= $index ?>">View Details</a> | <a href="edit.php?index=<?= $index ?>">Edit User</a>
                    </div>
                    <hr />
                <?php
                $index++;
                };
            echo '</div>
        </div>
    </div>
</section>';