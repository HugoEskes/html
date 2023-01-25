<?php

$exists = false;
$showError = false;
$showAlert = false;

include "connection.php";

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
    echo "Username not available";
}


// Checken of het email al in gebruik is
$sql = "Select * from gebruikers where email='$email'";
$result = mysqli_query($connection, $sql);
$num = mysqli_num_rows($result);

if($num!=0)
{
    echo "This emailaddress is already in use";
}


// Checken of de wachtwoorden overeen komen
if(($password == $cpassword) && $exists==false)
    {
    // wachtwoord versleutelen
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //informatie in de database zetten
    $sql = "INSERT INTO gebruikers (voornaam, achternaam, email, gebruikersnaam, wachtwoord) VALUES ('$firstname','$lastname', '$email', '$username', '$hashed_password')";
    mysqli_query($connection, $sql);

    // gebruiker naar homepagina sturen
    header('location: /../index.html');
    }
?>