<?php
  session_start();
  if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    // User is not logged in, redirect to login page with a flag indicating the user was not logged in
    header('Location: ../admin_login.php?not_logged_in=1');
  }

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    {
    include "../php/connection.php";
  
    
    // Alle informatie ophalen
    $username = mysqli_real_escape_string($connection, htmlspecialchars($_POST['username']));
    $email = mysqli_real_escape_string($connection, htmlspecialchars($_POST['email']));
    $password = mysqli_real_escape_string($connection, htmlspecialchars($_POST['password']));
    $cpassword = mysqli_real_escape_string($connection, htmlspecialchars($_POST['cpassword']));
  
  
    // wachtwoord versleutelen
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  
    //informatie in de database zetten
    $sql = "INSERT INTO admins (naam, email, wachtwoord) VALUES ('$username', '$email', '$hashed_password')";
    mysqli_query($connection, $sql);
  
    // send an email to the user that the account has been created
    $to = $email;
    $subject = "You are now a SKI. I. P. Admin!";
    $message = "Congratulations $username! <br><br> You have now been made an admin on the SKI. I. P site!<br> Your username is $username and you can now login via the admin login page <a href='https://webtech-ki59.webtech-uva.nl/admin_login.php'> here!</a>. <br><br> Please be responsable with all your new priviliges.<br>The SKI.I.P. team";
    $message = wordwrap($message, 70, "\r\n");
    $headers = "MIME-Version: 1.0" . "\r\n"; 
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
    $headers .= 'From: SKI.I.P. <noreply@skiip.com>';
    mail($to, $subject, $message, $headers);
  
    echo "<script>alert('A new admin has been created. They have been send an email!')</script>";
    }
  
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Account</title>
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
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="../css/style.min.css" rel="stylesheet">
</head>

<body>
<!-- Navbar Start -->
<div class="container-fluid p-0 nav-bar">
    <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
        <a href="admin_index.php" class="navbar-brand px-lg-4 m-0">
            <h1 class="m-0 display-4 text-uppercase text-white">Ski. I. P.</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav ml-auto p-4">
                <a href="admin_index.php" class="nav-item nav-link">Home</a>
                <a href="admin_reservations.php" class="nav-item nav-link">Reservations</a>
                <a href="admin_users.php" class="nav-item nav-link">Other Users</a>
                <a href="admin_account.php" class="nav-item nav-link active">Add Admin Accounts</a>
                <a href="../php/logout.php" class="nav-item nav-link">Log Out</a>
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Add Admin Accounts</h1>
        <div class="d-inline-flex mb-lg-5">
            <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
            <p class="m-0 text-white px-2">/</p>
            <p class="m-0 text-white">Add Admin Accounts</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Add admin page start -->
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>Creating a new admin</h2>
        <p>Please fill in this form to create a new admin.</p>
        <form action="admin_account.php" method="post">
        <div class="form-group">
            <label>Name:</label>
            <input type="text" id="username" name="username" class="form-control" required>
          </div>
          <br>
          <div class="form-group">
            <label>E-mail Address:</label>
            <input type="text" id="email" name="email" class="form-control" required>
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
            <input type="submit" name="submit" class="btn btn-primary" value="Add admin">
          </div>

        </form>
      </div>
    </div>
  </div>
<!-- Add admin page end -->

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
<script src="../lib/easing/easing.min.js"></script>
<script src="../lib/waypoints/waypoints.min.js"></script>
<script src="../lib/owlcarousel/owl.carousel.min.js"></script>
<script src="../lib/tempusdominus/js/moment.min.js"></script>
<script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="../js/main.js"></script>

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
          email.setCustomValidity("Email is already a regular user, please delete them first before making them an admin.");
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