<?php
  require_once '../php/connection.php';
  // Check if connection was successful
  if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
  // Update query
  $update_query = "UPDATE gebruikers SET name='" . $_POST['name'] . "', email='"
  ?>