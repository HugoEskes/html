<?php
session_start();
if (isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == true) {
    // User is logged in, redirect to loggedin about page
    header('Location: loggedin-about.php');
  }
if (isset($_SESSION['admin']) || $_SESSION['admin'] == true) {
    // User is logged in, redirect to admin index page
    header('Location: admin_pages/admin_index.php');
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>About us</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
<div class="container-fluid p-0 nav-bar">
    <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
        <a href="index.html" class="navbar-brand px-lg-4 m-0">
            <h1 class="m-0 display-4 text-uppercase text-white">Ski. I. P.</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav ml-auto p-4">
                <a href="index.html" class="nav-item nav-link ">Home</a>
                <a href="reservation.html" class="nav-item nav-link">Reserve</a>
                <a href="about.html" class="nav-item nav-link active">About us</a>
                <a href="login.php" class="nav-item nav-link">Log In</a>
                <a href="signup.php" class="nav-item nav-link">Sign Up</a>
            </div>
        </div>
    </nav>
</div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">About us</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">About us</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;"></h4>
                <h4 class="display-4 text-primary">About</h4>
            </div>
            <div class="row">
                    <h1 class="mb-3"></h1>
                    <h5 class="mb-3">Hello there! If it was faith, a happy little accident or if you just clicked on the about button on this website. Whichever one of these it was, you ended up in the right place. We’re happy to tell you about our quest regarding skiing and about the motivated people behind this initiative. <br> <br>

                        Okay, so, imagine this: You’re peacefully sliding down the mountain, whether it’s on ski’s, snowboard or on a sled with four reindeers in front of you. Nothing on your mind but snowy hills and the aftertaste of the hot chocolate you just drank at the nearby cafe up on one of the slopes. Until you finally get down and find yourself having to join the tedious long line for the gondola all the way at the back. Maybe it’s ten minutes, maybe it’s half an hour or maybe it’s even more precious time not spent skiing, but standing in a crowd of people, looking at the backs of other people's sweaty heads and listening to small children crying because they didn’t get to have the lollipop they wanted. Now, we from Ski.I.P. asked ourselves: ‘Is this really necessary?’ <br> <br>
                        
                        Here we strive to make your skiing journey quick and easy with our gondola reservation system. We believe skiing is enjoyed best when being able to spend the most amount of time actually on the slopes! No more waiting in line, but going straight up again for your next adventure. You put your skis or snowboard in the designated basket (this’ll be a bit more challenging when going by the sled and reindeers) and you’re off! Perfect right? That’s what we thought. With a few fast clicks create an account in the upper right corner, if you haven’t already done this, and reserve your first gondola ride! <br> <br>
                        
                        Now let me introduce you to the people who came up with this idea. First we have: Arthur van Campenhout. This young lad is a pioneer on website design and he even has a girlfriend (which isn't easy for an AI major, trust me) and if you thought that wasn’t enough, he also has some governance ambitions. We believe he has a very rich life in front of him. Then I’ll introduce you to our own Hugo Eskes. They say the apple doesn’t fall far from the tree, and that is the case for Hugo. He is keeping
                        AI in the family and making his father very proud. But this isn’t his only interest. This guy has many ambitions, one of which is fixing other peoples bikes, he is even getting professional training to be a bike mechanic. Why does he find this fun, you ask? I wouldn't know, ask him. Then we have Jacob Halewijn. The man, the myth, the cookiemaster. What is het not? When Jacob isn’t spending his time being the social animal that he is, partying with people of Amsterdam, entertaining them with his bubble personality until deep in the night. He likes to spend his time with only the computer. He can get so swallowed up by it sometimes he doesn’t even hear his best friend telling him his interesting stories. That actually brings me to the next amazing member of our team: Rafael Beekman. While being a very talented young programmer he’s also the joker of our group. Rafael has this talent of always seeing the bright side of things. When things aren’t totally going your way, you can always go to Rafael and he makes all your problems disappear with a simple joke or by just being his fun goofy self. A great asset for any team, if you ask me. But who is: me? Oh who really knows! I am many things but they seem to say I go by the name of Iris Helder. I am a mystery.. and i’d like to keep it that way if you don’t mind. Oh! I forgot to tell you something about us five. Even though our interests are sometimes different, we all share a passion for skiing and AI. And we loved bringing those things together in Ski.I.P.. If you read all the way to the end, I thank you for your patience. You are an individual with great power and perseverance and I wish you all the best. Hope to see you on the slope sometimes? Then maybe you can tell me all about you :) <br> <br> Bye!</h5>
                    <p></p>
                </div>
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/matterhorn.png" style="object-fit: cover;">
                    </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Footer Start -->
    <div class="container-fluid footer text-white mt-5 pt-5 px-0 position-relative overlay-top">
        <div class="row mx-0 pt-5 px-sm-3 px-lg-5 mt-4">
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Get In Touch</h4>
                <p><i class="fa fa-map-marker-alt mr-2"></i>Science Park 904, Amsterdam</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+31 6 12345678</p>
                <p class="m-0"><i class="fa fa-envelope mr-2"></i>Skiliftreservations@gmail.com</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Newsletter</h4>
                <p>Sign up for our newsletter to receive valuable updates about our skilift and our slopes.</p>
                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-light" style="padding: 25px;" placeholder="Your Email">
                        <div class="input-group-append">
                            <button class="btn btn-primary font-weight-bold px-3">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid text-center text-white border-top mt-4 py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
            <p class="mb-2 text-white">Copyright &copy; <a class="font-weight-bold" href="#">Domain</a>. All Rights Reserved.</a></p>
            <p class="m-0 text-white">Designed by <a class="font-weight-bold" href="https://htmlcodex.com">HTML Codex</a></p>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>