<?php
if(isset($_POST['submit'])) {
   // Connect to the database
   require_once 'php/connection.php';
   $password = mysqli_real_escape_string($connection, htmlspecialchars($_POST['password']));
   $password_hash = password_hash($password, PASSWORD_DEFAULT);
   // Get the reset token from the form
   $token = mysqli_real_escape_string($connection, htmlspecialchars($_POST['reset_token']));
   // Verify the reset token
   $select_query = "SELECT * FROM gebruikers WHERE reset_token='$token'";
   $result = mysqli_query($connection, $select_query);
   if(mysqli_num_rows($result) > 0) {
      // Reset token is valid
      // Update the user's password in the database
      $updated_query = "UPDATE gebruikers SET wachtwoord='$password_hash' WHERE reset_token='$token'";
      mysqli_query($connection, $updated_query);
      $new_query = "UPDATE gebruikers SET reset_token= NULL WHERE reset_token='$token'";
      mysqli_query($connection, $new_query);
      echo "<script>alert('Password reset successfully')</script>";
   } else {
    // Reset token is invalid
     echo "<script>alert('Invalid reset token')</script>";
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Reset Password</title>
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
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Reset Password</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Reset Password</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

<!-- Form Begin-->
<form action="reset.php" method="post" name="reset-form" onsubmit="return validateForm()">
   <input type="password" name="password" placeholder="Password">
   <br><br>
   <input type='reset_token' name="reset_token" placeholder="Reset token">
   <input type="submit" name="submit" value="Submit">
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

<script>
function validateForm() {
   var password = document.forms["reset-form"]["password"].value;
   if(password == "") {
      alert("Password is required");
      return false;
   }
   return true;
}
</script>

</body>
</html>