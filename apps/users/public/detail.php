<?php
// DETAIL.php : Specific user browsing page for non-logged in, or non-admin users.
require_once '../../../settings.php';
require_once APP_PATH.'/libraries/pdo.php';
require_once APP_PATH.'/libraries/functions.php';

/*
$users=readJSONFile(APP_PATH.'/data/users/users.JSON');
$usersKey = array_keys($users);

$index=$_GET['index'];

$user=getItem($users,$index);

$games=$user['games'];
$gameName=array_keys($games);
$messageStatus = userMessageStatus($user['messagesOpen']);
$inviteStatus = userInviteStatus($user['openToInvite']);
*/

$user=$pdo->query('SELECT * FROM users WHERE userID='.$_GET['id']);

$userListings=$pdo->query('SELECT * FROM listings WHERE userID ='.$_GET['id']);



   /* echo '<div>
        <a href="index.php">Return to Users List</a>
        <h3>'. $user['username'] .'</h3>
        <p><b>Name:</b> '. $user['name'] .' | Time Zone: '. $user['timeZone'] .' | Open To Invite: '. $inviteStatus .' </p>
        <?php
            while($listing=$result2->fetch()){
                echo '<p><b>'.$result2['title'].'</b><br />
                <p>'.$result2['description'].'</p>';
            }
        // reset game array index.
        $i=0;
        ?>
        <a href="#">Message this User</a> | Messages: <?= $messageStatus ?>
        <a href="detail.php?index=<?= $index ?>">View Details</a> 
    </div>';
*/
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Small Business - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../themes/css/profileStyles.css" rel="stylesheet" />
    </head>
    <body>
        <div class="d-flex flex-column vh-100 container px-4 px-lg-5">
            <!-- Heading Row-->
            <div class="row gx-4 gx-lg-5 align-items-center my-5">
                <div class="col-lg-7">
                    <?php
                        /* if($user['profilePicture']!=''){
                            
                        }*/
                    ?>
                    <img class="img-fluid rounded mb-4 mb-lg-0" src="<?php echo htmlspecialchars($user['profilePicture']); ?>" alt="Profile Picture" />
                </div>
                <div class="d-flex col-lg-5 align-items-center justify-content-center" style="margin-top: 5%;">
                    <h1 class="font-weight-light"><?php echo htmlspecialchars($user['username']); ?></h1>
                </div>
            </div>

            <div class="card text-white bg-secondary my-5 py-4 text-center">
                <div class="card-body">
                    <p class="text-white m-0"><?php echo htmlspecialchars($user['description']); ?></p>
                </div>
            </div>

            <div class="row gx-4 gx-lg-5">
                <?php  while($listing=$userListings->fetch()){ 
                    echo '<div class="col-md-4 mb-5">
                        <div class="card h-100">
                            <div class="card-body">
                                <h2 class="card-title">'. htmlspecialchars($listing['title']).'</h2>
                                <p class="card-text">'. htmlspecialchars($listing['description']) .'</p>
                                <a href="edit.php?index='. $currentUser['userID'] .'">Edit Profile</a> 
                            </div>';
                    }
                ?>
                            <div class="card-footer"><a class="btn btn-primary btn-sm" href="#!">More Info</a></div>
                        </div>
                    </div>
            </div>
        </div>

        <!-- Footer-->
        <footer class="mt-auto py-5 bg-dark">
            <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>