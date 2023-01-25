<?php
include "connection.php";

$firstname = mysqli_real_escape_string($connection, htmlspecialchars($_POST['firstname']));
$lastname = mysqli_real_escape_string($connection, htmlspecialchars($_POST['lastname']));
$email = mysqli_real_escape_string($connection, htmlspecialchars($_POST['email']));
$username = mysqli_real_escape_string($connection, htmlspecialchars($_POST['username']));
$password = mysqli_real_escape_string($connection, htmlspecialchars($_POST['password']));

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO gebruikers (voornaam, achternaam, email, gebruikersnaam, wachtwoord) VALUES ('$firstname','$lastname', '$email', '$username', '$hashed_password')";
mysqli_query($connection, $sql);
header('location=index.html');
?>