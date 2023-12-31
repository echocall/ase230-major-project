<?php
    session_start();
    require_once('../settings.php');
    require('navbar.php');
    require('../libraries/pdo.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Group Finder</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../themes/css/groupFinderStyle.css" rel="stylesheet" />
</head>
<body>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container px-5">
        <a class="navbar-brand" href="#!">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="groupFinder.html">Group Finder</a></li>
                <li class="nav-item"><a class="nav-link" href="yourGroups.html">Your Groups</a></li>
                <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="text-center mt-5">
        <h1>Group Finder</h1>
    </div>
    <div class="text-center mt-5">
        <a class="btn btn-lg btn-dark" href="<?PHP echo BASE_URL ?>groups/manage/index.php?">View all</a>
    </div>
    <div class="wrapper">
        <div id="search-container">
            <input
                    type="search"
                    id="search-input"
                    placeholder="Search group name"
            />
            <button id="search">Search</button>
        </div>
        <div id="buttons">
            <button class="button-value" onclick="filterProduct('all')">All</button>
            <button class="button-value" onclick="filterProduct('MMORPG')">MMORPG</button>
            <button class="button-value" onclick="filterProduct('FPS')">FPS</button>
            <button class="button-value" onclick="filterProduct('MOBA')">MOBA</button>
            <button class="button-value" onclick="filterProduct('OTHER')">OTHER</button>
        </div>
        <div id="products"></div>
    </div>
</div>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Group Finder JS -->
<script src="../themes/js/groupFinderJS.js"></script>
</body>
</html>
