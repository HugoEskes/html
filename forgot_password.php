<?php
if(isset($_POST['submit'])) {
    // Connect to the database
    require_once 'php/connection.php';
    $email = mysqli_real_escape_string($connection, htmlspecialchars($_POST['email']));
    // Check if the email exists in the database
    $sql = "SELECT * FROM gebruikers WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) > 0) {
       $firstname = $row['voornaam'];
       $lastname = $row['achternaam'];
       // Email found in the database
       // Generate a password reset token
       $token = bin2hex(random_bytes(16));
       // Store the reset token in the database
       $sql = "UPDATE gebruikers SET reset_token='$token' WHERE email='$email'";
       mysqli_query($connection, $sql);
       // Send an email to the user with the reset link
       $reset_link = "https://webtech-ki59.webtech-uva.nl/reset.php?token=" . $token;
        $to = $email;
        $subject = "Forgot password";
        $message = "Hi $firstname $lastname, <br><br>Forgotten your password? No problem! Mistakes happen!<br>Please copy this code $token and click this link: $reset_link. <br><br>If you didn't request this password change, please ignore this email.<br>The SKI.I.P. team";
        $message = wordwrap($message, 70, "\r\n");
        $headers = "MIME-Version: 1.0" . "\r\n"; 
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
        $headers .= 'From: SKI.I.P. <noreply@skiip.com>';
        mail($to, $subject, $message, $headers);
       echo "<script>alert('An email with more instructions has been sent.')</script>";
    } else {
       // Email not found in the database
       echo "<script>alert('Email not found')</script>";
    }
 }
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Forgot Password</title>
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
    <link href="css/style.min.css" rel="stylesheet">
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
                  <a href="reservation.php" class="nav-item nav-link">Availability</a>
                  <a href="about.php" class="nav-item nav-link">About us</a>
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
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Forgot Password</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Forgot Password</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

<!-- Form Begin-->
<form action="forgot_password.php" method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <input name="submit" type="submit" value="Submit">
</form>
<!-- Form End -->


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

</body>
</html>