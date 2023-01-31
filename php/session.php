<?php

session_start();

if (isset($_SESSION['gebruikerID']) && $_SESSION['gebruikerID']){
    header('location: loggedin-index.php');
    exit;
}
?>