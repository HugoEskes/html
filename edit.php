<?php

require_once 'php/connection.php';

// Check connection
if (!$connection) {
   die("Connection failed: " . mysqli_connect_error());
}

// Get the ID of the user to be edited
$id = $_POST['gebruikerid'];

// Select query to retrieve the data for the user
$select_query = "SELECT * FROM gebruikers WHERE gebruikerID = '$id'";
$result = mysqli_query($connection, $select_query);

$row = mysqli_fetch_assoc($result);

// Store the data in variables
$voornaam = $row['voornaam'];
$achternaam = $row['achternaam'];
$gebruikerID = $row['gebruikerID'];
$gebruikersnaam = $row['gebruikersnaam'];
$email = $row['email'];
$wachtwoord = $row['wachtwoord'];

// Check if the form has been submitted
if (isset($_POST['submit'])) {

  // Get the updated data from the form
  $updated_voornaam = $_POST['voornaam'];
  $updated_achternaam = $_POST['achternaam'];
  $updated_gebruikersnaam = $_POST['gebruikersnaam'];
  $updated_email = $_POST['email'];
  $updated_wachtwoord = $_POST['wachtwoord'];