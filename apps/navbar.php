<?php
echo '<!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container px-4">
            <a class="navbar-brand" href="index.html">Squad Up</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="groupFinder.php">Group Finder</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Your Groups</a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>';

if (!isset($_SESSION['username'])) { // User is not logged in
    echo '  <li class="nav-item"><a class="nav-link" href="../apps/auth/signup.php">Sign up</a></li>
            <li class="nav-item"><a class="nav-link" href="../apps/auth/login.php">Login</a></li>';
}else{
    echo '<li class="nav-item"><a class="nav-link" href="../apps/auth/signout.php">Sign out</a></li>';
}

echo '      </ul>
        </div>
    </div>
</nav>';
?>

