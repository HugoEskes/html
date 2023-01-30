<?php

$emailcorrect = true;
$usernamecorrect = true;
$passwordsmatch = true;
$passwordstrong = true;

if($_SERVER["REQUEST_METHOD"] == "POST") {
  include "../php/connection.php";

  // alert functie aanmaken
  function alert($msg) 
    {
    echo "<script type='text/javascript'>alert('$msg');</script>";
    }

  function password_strength_test($password)
    {
    $uppercase    = preg_match('@[A-Z]@', $password);
    $lowercase    = preg_match('@[a-z]@', $password);
    $number       = preg_match('@[0-9]@', $password);

    if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) 
      {
      return false;
      }
    else 
      {
      return true;
      } 
    }

  // Alle informatie ophalen
  $firstname = mysqli_real_escape_string($connection, htmlspecialchars($_POST['firstname']));
  $lastname = mysqli_real_escape_string($connection, htmlspecialchars($_POST['lastname']));
  $email = mysqli_real_escape_string($connection, htmlspecialchars($_POST['email']));
  $username = mysqli_real_escape_string($connection, htmlspecialchars($_POST['username']));
  $password = mysqli_real_escape_string($connection, htmlspecialchars($_POST['password']));
  $cpassword = mysqli_real_escape_string($connection, htmlspecialchars($_POST['cpassword']));

  // Checken of de gebruikernaam al bestaat
  $sql = "Select * from gebruikers where gebruikersnaam='$username'";
  $result = mysqli_query($connection, $sql);
  $num = mysqli_num_rows($result);

  if($num!=0)
    {
    alert("Username not available");
    $usernamecorrect = false;
    }


  // Checken of het email al in gebruik is
  $sql = "Select * from gebruikers where email='$email'";
  $result = mysqli_query($connection, $sql);
  $num = mysqli_num_rows($result);

  if($num!=0)
    {
    alert("This emailaddress is already in use");
    $emailcorrect = false;
    }

  // checken of de wachtwoorden overeen komen
  if($password != $cpassword)
  {
    alert("Passwords don't match");
    $passwordsmatch = false;
  }

  // checken of het wachtwoord sterk genoeg is
  if(password_strength_test($password)==false)
  {
    alert("Password is not strong enough");
    $passwordstrong = false;
  }

  // Als de wachtwoorden overeen komen wordt het wachtwoord versleuteld en naar de database gestuurd
  //
  if($usernamecorrect && $emailcorrect && $passwordsmatch && $passwordstrong)
    {
    // wachtwoord versleutelen
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //informatie in de database zetten
    $sql = "INSERT INTO gebruikers (voornaam, achternaam, email, gebruikersnaam, wachtwoord) VALUES ('$firstname','$lastname', '$email', '$username', '$hashed_password')";
    mysqli_query($connection, $sql);

    // gebruiker naar homepagina sturen
    alert("Je account is aangemaakt!");
    }

} 
?>

<!DOCTYPE html>
<html>
<head>
<title>Sign Up</title>
<meta charset="utf-8">
    <title>Signup</title>
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
            <h1 class="m-0 display-4 text-uppercase text-white">Ski. I. P</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav ml-auto p-4">
                <a href="index.html" class="nav-item nav-link">Home</a>
                <a href="reservation.html" class="nav-item nav-link">Reserve</a>
                <a href="about.html" class="nav-item nav-link">About us</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">My Ski. I. P</a>
                    <div class="dropdown-menu text-capitalize">
                        <a href="login.html" class="dropdown-item">Login</a>
                        <a href="signup.php" class="dropdown-item active">Signup</a>
                    </div>
                </div>
                
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->

<br>
<br>
<br>
<br>
<br>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>Register</h2>
        <p>please fill in this form to create an account.</p>
        <form action="signup.php" method="post">
          <div class="form-group"> 
            <label>First Name</label>
            <input type="text" id="firstname" name="firstname" class="form-control" required>
          </div>
          <br>
          <div class="form-group">
            <label>Last name</label>
            <input type="text" id="lastname" name="lastname" class="form-control" required>
          </div>
          <br>
          <div class="form-group">
            <label>E-mail Address</label>
            <input type="text" id="Email" name="email" class="form-control" required>
          </div>
          <br>
          <div class="form-group">
            <label>Username</label>
            <input type="text" id="Username" name="username" class="form-control" required>
          </div>
          <br>
          <div class="form-group">
            <label>Password:</label>
            <input type="password" id="Password" name="password" class="form-control" required>
          </div>
          <br>
          <div class="form-group">
            <label>Confirm password:</label>
            <input type="password" name="cpassword" class="form-control" required>
          </div>
          <br>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
          </div>
          <p>Already have an account? <a href="/Pagina's/login.html">Login here</a></p>
        </form>
      </div>
    </div>
  </div>

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
                <p>Amet elitr vero magna sed ipsum sit kasd sea elitr lorem rebum</p>
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

<script language="JavaScript">

// Get the password input field
var password = document.getElementById("Password");

// Listen for changes to the password field
password.addEventListener("input", function() {
    // Get the password value
    var passwordValue = password.value;

    // Check the password against validation rules
    if (passwordValue.length < 8) {
        // Password is too short
        password.setCustomValidity("Password must be at least 8 characters long.");
    } else if (!/[A-Z]/.test(passwordValue)) {
        // Password does not contain an uppercase letter
        password.setCustomValidity("Password must contain at least one uppercase letter.");
    } else if (!/[a-z]/.test(passwordValue)) {
        // Password does not contain a lowercase letter
        password.setCustomValidity("Password must contain at least one lowercase letter.");
    } else if (!/\d/.test(passwordValue)) {
        // Password does not contain a digit
        password.setCustomValidity("Password must contain at least one digit.");
    } else {
        // Password is valid
        password.setCustomValidity("");
    }
  });
</script> 
</body>
</html>