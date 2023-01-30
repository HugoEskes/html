<?php
  session_start();

  // Check if the user is logged in
  if (!isset($_SESSION['email'])) {
    // User is not logged in, redirect to the login page
    header("Location: login.php");
  }

  // User is logged in, display a welcome message
  echo "Welcome, " . $_SESSION['name'] . "!";
?>