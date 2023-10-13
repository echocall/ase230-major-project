<?php 
// INDEX.php : Main browsing page for site-admin users.
require_once '../../../settings.php';
require_once APP_PATH.'/libraries/functions.php';

$groups=readJSONFile(APP_PATH.'/data/groups/groups.JSON');

$index=0;

echo '<!-- About section-->
<section id="about">
    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">
                <h2>Guilds</h2>
                <a href="create.php?">Create A Guild</a> 
                <p class="lead">Browse the guilds open to the public to find your perfect match:</p>';

                foreach($groups as $guild){
                    $members=$guild['members'];
                    $status=guildJoinStatus($guild['freeToJoin']);
                ?>
                    <div>
                        <h3><?= $guild['name'] ?></h3>
                        <p>Owner: <?= array_key_first($members); ?> | Group Type: <?= $guild['type'] ?> | Open to Join: <?= $status ?> </p>
                        <p><?= $guild['bio'] ?> </p><br />
                        <a href="detail.php?index=<?= $index ?>">View Details</a> | 
                        <a href="edit.php?index=<?= $index ?>">Edit</a> | 
                        <a href="delete.php?index=<?= $index ?>">Delete</a>
                    </div>
                    <hr />
                <?php
                $index++;
                };
            
            echo '</div>
        </div>
    </div>
</section>';