<?php
session_start();

require_once '../settings.php';
require_once APP_PATH.'/libraries/pdo.php';
require_once APP_PATH.'/libraries/functions.php';

require('navbar.php');
if (!isset($_SESSION['username'])) {
    die("Username not set in the session.");
}

$currentUser = null;

// pull the user info from database and into object
$result=$pdo->query('SELECT * FROM users');
while($user=$result->fetch()){
    if($_SESSION['username'] == $user['username']){
        // set user pulled from array as current user.
        $currentUser = $user;
        break;
    }
}

// get the user's listings.
$userListings=$pdo->query('SELECT * FROM listings WHERE userID ='.$currentUser['userID']);


if (!isset($_SESSION['username'])) {
    die("Username not set in the session.");
}

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
                    if($currentUser['profilePicture']!=''){
                        // TODO: display
                    }
                    ?>
                    <img class="img-fluid rounded mb-4 mb-lg-0" src="<?php echo htmlspecialchars($currentUser['profilePicture']); ?>" alt="Profile Picture" />
                </div>
                <div class="d-flex col-lg-5 align-items-center justify-content-center" style="margin-top: 5%;">
                    <h1 class="font-weight-light"><?php echo htmlspecialchars($currentUser['username']); ?></h1>
                </div>
            </div>

            <div class="card text-white bg-secondary my-5 py-4 text-center">
                <div class="card-body">
                    <p class="text-white m-0"><?php echo htmlspecialchars($currentUser['description']); ?></p>
                </div>
            </div>

            <div class="row gx-4 gx-lg-5">
            <?php  while($listing=$userListings->fetch()){ 
                    echo '<div class="col-md-4 mb-5">
                        <div class="card h-100">
                            <div class="card-body">
                                <h2 class="card-title">'. htmlspecialchars($listing['title']).'</h2>
                                <p class="card-text">'. htmlspecialchars($listing['description']) .'</p>
                                <a href="edit.php?index='. $user['userID'] .'">Edit Profile</a> 
                            </div>';
                    }
                     echo      '<div class="card-footer"><a class="btn btn-primary btn-sm" href="#!">More Info</a></div>
                        </div>
                    </div>';
                ?>
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
