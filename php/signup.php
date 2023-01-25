<?php
include "connection.php";

$firstname = mysqli_real_escape_string($connection, htmlspecialchars($_POST['firstname']));
$lastname = mysqli_real_escape_string($connection, htmlspecialchars($_POST['lastname']));
$email = mysqli_real_escape_string($connection, htmlspecialchars($_POST['email']));
$username = mysqli_real_escape_string($connection, htmlspecialchars($_POST['username']));
$password = mysqli_real_escape_string($connection, htmlspecialchars($_POST['password']));

$sql = "INSERT INTO gebruikers (voornaam, achternaam, email, gebruikersnaam, wachtwoord) VALUES ('$firstname','$lastname', '$email', '$username', '$password')";
mysqli_query($connection, $sql);
?>