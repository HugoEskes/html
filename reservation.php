<?php
if (session_status() !== PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == true) {
        // User is logged in, redirect to loggedin reservation page
        header('Location: loggedin-reservation.php');
    }
    if (isset($_SESSION['admin']) || $_SESSION['admin'] == true) {
        // User is logged in, redirect to admin index page
        header('Location: admin_pages/admin_index.php');
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Reservations</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">

    <!-- API-key-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7tTtgSMOA_yFVqkh1zFZrpvouCorDXvE&callback=initMap"
    async defer></script>

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
    <link href="css/style.min.css" rel="stylesheet">

    <script type = "text/javascript">
            function login() {


               alert ("Please login to make a reservation.");
               location.replace("login.php")
            }
    </script>     
</head>

<body>
<!-- Navbar Start -->
<div class="container-fluid p-0 nav-bar">
    <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
        <a href="index.php" class="navbar-brand px-lg-4 m-0">
            <h1 class="m-0 display-4 text-uppercase text-white">Ski. I. P.</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav ml-auto p-4">
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="reservation.php" class="nav-item nav-link active">Reserve</a>
                <a href="about.php" class="nav-item nav-link">About</a>
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
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Reservation</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Reservation</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Reservation Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="reservation position-relative overlay-top overlay-bottom">
                <div class="row align-items-center">
                    <div class="col-lg-6 my-5 my-lg-0">
                        <div class="row">
                            <div class="col-md-12 pb-5">
                                <form>
                                <label for="availability_date">Choose a date:</label>
                                    <input type="date" id="availability_date" name="availability_date">
                                    <input type="submit" value="Submit">
                                </form>
                            <div id="table-container"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-center p-5" style="background: rgba(51, 33, 29, .8);">
                        <p class='m-0 text-white' style="float: right;">
                            You need to be logged in to make a reservation. <br>
                            Please login <a href='login.php'>here</a>. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reservation End -->
    
    <!-- Footer Start -->
    <div class="container-fluid footer text-white mt-5 pt-5 px-0 position-relative overlay-top">
        <div class="row mx-0 pt-5 px-sm-3 px-lg-5 mt-4">
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Get In Touch</h4>
                <p><i class="fa fa-map-marker-alt mr-2"></i>Science Park 904, Amsterdam</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+31 6 12345678</p>
                <p class="m-0"><i class="fa fa-envelope mr-2"></i>Skiliftreservations@gmail.com</p>
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
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <!-- Google API -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7tTtgSMOA_yFVqkh1zFZrpvouCorDXvE&callback=initMap"></script>

    <script>
        function initMap() {
          var map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 45.892417, lng: 7.540064 },
            zoom: 8
          });
        
        var marker = new google.maps.Marker({
    position: {lat: 45.892417, lng: 7.540064},
    map: map,
    title: 'Pian della Volpe ski lift '
});
        }
      </script>

    <script>
    document.querySelector("form").addEventListener("submit", function(event) {
        event.preventDefault();

        var date = document.querySelector("#availability_date").value;
        var xhr = new XMLHttpRequest();

        xhr.open("GET", "table_maker.php?availability_date=" + date);
        xhr.onload = function() {
        if (xhr.status === 200) {
            document.querySelector("#table-container").innerHTML = xhr.responseText;
        }
        };
        xhr.send();
    });
    </script>
</body>

</html>