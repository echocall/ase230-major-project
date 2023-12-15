<?php
            session_start();
            require_once('../settings.php');
            require_once('navbar.php');
        ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Scrolling Nav - Start Bootstrap Template</title>
        <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../themes/css/styles.css" rel="stylesheet" />

    </head>
    <body id="page-top">
        <!-- Header-->
        <header class="bg-primary bg-gradient text-white">
            <div class="container px-4 text-center">
                <h1 class="fw-bolder">Welcome to Squad Up <?php if (isset($_SESSION['username'])) echo $_SESSION["username"]?></h1>
                <p class="lead">A website to find other like minded individuals for playing games!</p>
                <a class="btn btn-lg btn-light" href="#about">Start Finding!</a>
            </div>
        </header>
        <!-- About section-->
        <section id="about">
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8">
                        <h2>About Squad Up</h2>
                        <p class="lead">It is our mission to provide you with the tools you need to connect with gaming companions across the world:</p>
                        <ul>
                            <li>Customizable profiles allow you to express yourself and show what you are looking for</li>
                            <li>User-created groups allow you to collaborate, hangout, and plan events</li>
                            <li>Posts, events, messages, and more coming soon!</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact section-->
        <section class="bg-light" id="contact">
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8">
                        <h2>Contact us</h2>
                        <p class="lead">support@squadup.com</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container px-4"><p class="m-0 text-center text-white">Copyright &copy; Squad Up 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
