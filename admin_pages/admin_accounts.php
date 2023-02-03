<?php
require_once '../php/connection.php';

$name_admin1 = 'Hugo';
$password_admin1 = 'Welkom123';
$email_admin1 = 'eskeshugo@gmail.com';
$hashed_admin1 = password_hash($password_admin1, PASSWORD_DEFAULT);

$sql = "INSERT INTO admins (naam, wachtwoord, email) VALUES ('$name_admin1', '$password_admin1', '$email_admin1')";
mysqli_query($connection, $sql);

$name_admin2 = 'Iris';
$password_admin2 = 'Welkom123';
$email_admin2 = 'iriseenhoorn@gmail.com';
$hashed_admin2 = password_hash($password_admin2, PASSWORD_DEFAULT);

$sql = "INSERT INTO admins (naam, wachtwoord, email) VALUES ('$name_admin2', '$password_admin2', '$email_admin2')";
mysqli_query($connection, $sql);

$name_admin3 = 'Rafael';
$password_admin3 = 'Welkom123';
$email_admin3 = 'rafaelbeekman@gmail.com';
$hashed_admin3 = password_hash($password_admin3, PASSWORD_DEFAULT);

$sql = "INSERT INTO admins (naam, wachtwoord, email) VALUES ('$name_admin3', '$password_admin3', '$email_admin3')";
mysqli_query($connection, $sql);

$name_admin4 = 'Jacob';
$password_admin4 = 'Welkom123';
$email_admin4 = 'jacobhalewijn1@gmail.com';
$hashed_admin4 = password_hash($password_admin4, PASSWORD_DEFAULT);

$sql = "INSERT INTO admins (naam, wachtwoord, email) VALUES ('$name_admin4', '$password_admin4', '$email_admin4')";
mysqli_query($connection, $sql);

$name_admin5 = 'Arthur';
$password_admin5 = 'Welkom123';
$email_admin5 = 'Arthurcampenhout@gmail.com';
$hashed_admin5 = password_hash($password_admin5, PASSWORD_DEFAULT);

$sql = "INSERT INTO admins (naam, wachtwoord, email) VALUES ('$name_admin5', '$password_admin5', '$email_admin5')";
mysqli_query($connection, $sql);

?>