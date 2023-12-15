<?php
session_start();
require_once('../../settings.php');
require_once('../navbar.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Scrolling Nav - Start Bootstrap Template</title>
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../themes/css/styles.css" rel="stylesheet" />
</head>
<body>
    <header class="bg-primary bg-gradient text-white">
        <div class="container px-4 text-center">
            <h1 class="fw-bolder">Not logged in</h1>
        </div>
    </header><br /><br />
    <div class="container px-4 text-center">
        <h5>You need to create an account or log in to access this feature</h5><br />
        <a class="btn btn-lg btn-dark" href="<?php echo BASE_URL ?>auth/signup.php">Signup</a>
        <a class="btn btn-lg btn-dark" href="<?php echo BASE_URL ?>auth/login.php">Login</a>
    </div>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>