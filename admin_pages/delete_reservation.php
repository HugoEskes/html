<?php
  require_once '../php/connection.php';
  // Check connection
  if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
  }

  if (isset($_POST['delete'])) {
    // Get the form data
    $id = $_POST['id'];

    // Delete query
    $delete_query = "DELETE FROM reserveringen WHERE reservatieID='$id'";
    $result = mysqli_query($connection, $delete_query);

    // Check if delete was successful
    if ($result) {
      // Redirect the user back to the main page
      header('Location: admin_reservations.php');
      exit;
    } else {
      echo "Error deleting record: " . mysqli_error($connection);
    }
  }

  // Close the database connection
  mysqli_close($connection);
?>