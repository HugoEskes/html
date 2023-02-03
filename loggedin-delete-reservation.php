<?php
  require_once 'php/connection.php';
  // Check connection
  if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
  }

  if (isset($_POST['delete'])) {
    // Get the form data
    $id = $_POST['id'];

    $sql_find_information = "SELECT datum, tijdslot, personen FROM reserveringen WHERE reservatieID='$id'";
    $reservation_result = mysqli_query($connection, $sql_find_information);

    $reservation_row = $reservation_result->fetch_assoc();
    $date = $reservation_row["datum"];
    $timeslot = $reservation_row["tijdslot"];
    $personen = $reservation_row["personen"];

    $sql_tijden = "SELECT beschikbare_plekken FROM tijden WHERE datum='$date' and tijd='$timeslot'"; 
    $availability_result = $connection->query($sql_tijden);
    $availability_row = $availability_result->fetch_assoc();
    $previous_availability = $availability_row["beschikbare_plekken"];
    $new_availability = $previous_availability + $personen;

    $sql_availability_update = "UPDATE tijden SET beschikbare_plekken='$new_availability' WHERE datum='$date' and tijd='$timeslot'";
    mysqli_query($connection, $sql_availability_update);

    // Delete query
    $delete_query = "DELETE FROM reserveringen WHERE reservatieID='$id'";
    $result = mysqli_query($connection, $delete_query);

    // Check if delete was successful
    if ($result) {
      // Redirect the user back to the main page
      header('Location: loggedin-myreservations.php');
      exit;
    } else {
      echo "Error deleting record: " . mysqli_error($connection);
    }
  }

  // Close the database connection
  mysqli_close($connection);
?>