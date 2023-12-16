<?php 
// INDEX.php : Main browsing page for all users
require_once '../settings.php';
require_once APP_PATH.'/libraries/pdo.php';
require_once APP_PATH.'/libraries/functions.php';

$result=$pdo->query('SELECT * FROM users');

echo '<!-- About section-->
<section id="about">
    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">
                <h2>Users</h2>';
                /* foreach($users as $user){
                    $games=$user['games'];
                    $gameName=array_keys($games);
                    $messageStatus = userMessageStatus($user['messagesOpen']);
                    $inviteStatus = userInviteStatus($user['openToInvite']);
                */
                    
                while($user=$result->fetch()){
                    echo '<div><h3>'.$user['username'].'</h3>';
                    echo '<p>Email: '.$user['email'].' | Time Zone: '.$user['timeZone'].' | Open to Invite: '.$user['openToInvite'].'</p>';
                    echo '<a href="detail.php?id='.$user['userID'].'">Go to page</a>
                    </div>
                    <hr />';
                }
            
            echo '</div>
        </div>
    </div>
</section>';