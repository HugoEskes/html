<?php

$emailcorrect = true;
$usernamecorrect = true;
$passwordsmatch = true;
$passwordstrong = true;

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
  include "php/connection.php";

  
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
    $usernamecorrect = false;
    }

  // checken of de wachtwoorden overeen komen
  if($password != $cpassword)
    {
    $passwordsmatch = false;
    }

  // Als de wachtwoorden overeen komen wordt het wachtwoord versleuteld en naar de database gestuurd
  //
  if($usernamecorrect && $emailcorrect && $passwordsmatch)
    {
    // wachtwoord versleutelen
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //informatie in de database zetten
    $sql = "INSERT INTO gebruikers (voornaam, achternaam, email, gebruikersnaam, wachtwoord) VALUES ('$firstname','$lastname', '$email', '$username', '$hashed_password')";
    mysqli_query($connection, $sql);

    // gebruiker naar homepagina sturen
    header("Location: login.php");
    }

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Sign Up</title>
<meta charset="utf-8">
    <title>Sign Up</title>
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
                <a href="index.php" class="nav-item nav-link active">Home</a>
                <a href="reservation.php" class="nav-item nav-link">Reserve</a>
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
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Sign Up</h1>
        <div class="d-inline-flex mb-lg-5">
            <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
            <p class="m-0 text-white px-2">/</p>
            <p class="m-0 text-white">Sign Up</p>
        </div> 
    </div>
</div>
<!-- Page Header End -->

<!-- Signup page start -->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>Register</h2>
        <p>Please fill in this form to create an account.</p>
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
            <input type="text" id="email" name="email" class="form-control" required>
          </div>
          <br>
          <div class="form-group">
            <label>Username</label>
            <input type="text" id="username" name="username" class="form-control" required>
          </div>
          <br>
          <div class="form-group">
            <label>Password:</label>
            <input type="password" id="password" name="password" class="form-control" required>
          </div>
          <br>
          <div class="form-group">
            <label>Confirm password:</label>
            <input type="password" id="cpassword" name="cpassword" class="form-control" required>
          </div>
          <br>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
          </div>
          <p>Already have an account? <a href="login.php">Log in here</a></p>
        </form>
      </div>
    </div>
  </div>
<!-- Signup page End -->

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

<!-- JQuery libary -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script language="JavaScript">

// functie voor het checken of de email kan kloppen ('tekst'@'tekst'.'kleine tekst')
function validateEmail(email) {
  const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

// Get the password input field
var password = document.getElementById("password");

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




// Get the email input field
var email = document.getElementById("email");

// Listen for changes to the email field
email.addEventListener("input", function() {
    // Get the email value
    var emailValue = email.value

    // Check the email against validation rules
    if (validateEmail(emailValue) == false ) {
        // Email is not valid
        email.setCustomValidity("Please use a valid Email address");
    } else {    
      $.ajax({
      type: "POST",
      url: "/php/check_email.php",
      data: {email_ajax: email.value},
      dataType: "html",
      success: function(data) {
        if ( data * 1 ) {
          email.setCustomValidity("Email is already in use");
        } else {
          email.setCustomValidity("");
        }
      }   
      });
        
    }
  });


// Get the email input field
var username = document.getElementById("username");

// Listen for changes to the email field
username.addEventListener("input", function() {
    // Get the email value
    var usernameValue = username.value

    // Check the email against validation rules
    if (usernameValue.length < 4) {
        // Username is too short
        username.setCustomValidity("Username must contain at least 4 letters");
    } else if (usernameValue.indexOf(" ") !== -1){
        //username contains a space
        username.setCustomValidity("Username can not contain a space")
    }else {    
      $.ajax({
      type: "POST",
      url: "/php/check_username.php",
      data: {username_ajax: username.value},
      dataType: "html",
      success: function(data) {
        if ( data * 1 ) {
          username.setCustomValidity("Username is already in use");
        } else {
          username.setCustomValidity("");
        }
      }   
      });
        
    }
  });

  // Get the cpassword input field
var cpassword = document.getElementById("cpassword");

// Listen for changes to the cpassword field
cpassword.addEventListener("input", function() {
    // Get the cpassword value
    var cpasswordValue = cpassword.value;
    
  // Get the password value
  var passwordValue = document.getElementById("password").value;

    // Check if the passwords are the same
    if (cpasswordValue !== passwordValue) {
        // Notify that the passwords are not the same
        cpassword.setCustomValidity("The passwords do not match");
    } else {
        // The passwords are the same
        cpassword.setCustomValidity("");
    
    }
  });



</script> 
</body>
</html>