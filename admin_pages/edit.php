<?php
  require_once '../php/connection.php';
  // Check if connection was successful
  if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
  if (isset($_POST['edit'])) {
    // Get the form data
    $id = $_POST['gebruikerID'];
    $name = $_POST['gebruikersnaam'];
    $email = $_POST['email'];
    
    // Update query
    $update_query = "UPDATE gebruikers SET name='$name', email='$email' WHERE id='$id'";
    $result = mysqli_query($connection, $update_query);
    
    // Check if update was successful
    if ($result) {
      // Redirect the user back to the main page
      header('Location: admin_users.php');
      exit;
    } else {
      echo "Error updating record: " . mysqli_error($connection);
    }
  }
  
  // Close the database connection
  mysqli_close($connection);
  
  ?>