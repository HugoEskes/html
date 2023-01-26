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
<style>
/* Create a top navigation bar with a black background color  */
.topnav {
  background-color: #333;
  overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Create a right-aligned (split) link inside the navigation bar */
.topnav a.split {
  float: right;
  background-color: #04AA6D;
  color:white;
  overflow: hidden;
}
.active {
  background-color: #04AA6D;
}

@media screen and (max-width: 500px) {
  .navbar a {
    float: none;
    display: block;
  }
}
</style>

</head>
<body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="topnav">
    <a href="/index.html"><i class="fa fa-fw fa-home"></i>Home</a>
    <a href="/Pagina's/reserve.html">Reserve</a>
    <a href="/Pagina's/myreservations.html">My Reservations</a>
    <a href="/Pagina's/about.html"><i class="fa fa-fw fa-envelope"></i>About</a>
    <a href="/Pagina's/signup.php" class="split"></i>Sign up</a>
    <a href="/Pagina's/login.html" class="split"><i class="fa fa-fw fa-user"></i>Log in</a>
</div>
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
            <label>E-mail Adress</label>
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
<script>
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