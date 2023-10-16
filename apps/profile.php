<?php
session_start();
require('navbar.php');
if (!isset($_SESSION['username'])) {
    die("Username not set in the session.");
}
$jsonData = file_get_contents('../data/users/users.json');
$data = json_decode($jsonData, true);

if (!isset($_SESSION['username'])) {
    die("Username not set in the session.");
}

$currentUser = null;
foreach ($data as $user) {
    if ($user['username'] === $_SESSION['username']) {
        $currentUser = $user;
        break;
    }
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
                <?php foreach ($currentUser['games'] as $gameName => $gameDescription): ?>
                    <div class="col-md-4 mb-5">
                        <div class="card h-100">
                            <div class="card-body">
                                <h2 class="card-title"><?php echo htmlspecialchars($gameName); ?></h2>
                                <p class="card-text"><?php echo htmlspecialchars($gameDescription); ?></p>
                                <a href="/users/manage/edit.php?index=<?= $currentUser ?>">Edit Profile</a> 
                            </div>
                            <div class="card-footer"><a class="btn btn-primary btn-sm" href="#!">More Info</a></div>
                        </div>
                    </div>
                <?php endforeach; ?>
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
