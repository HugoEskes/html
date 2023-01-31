<?php
session_start();
  if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    // User is not logged in, redirect to login page with a flag indicating the user was not logged in
    header('Location: ../admin_login.php?not_logged_in=1');
  }

echo "<script>alert('Welcome, " . $_SESSION['naam'] . "!');</script>";


header('refresh:0.5; url=admin_index.php');

?>