<?php

define('DBSERVER', 'localhost');
define('DBUSERNAME', 'hugoe');
define('DBPASSWORD', 'EDNZxAfEptklmtplrOmgeGquRAuvhNHw');
define('DBNAME', 'Skilift website');

$link = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

if ($link === False){
    die ("Error: connection error. Have a nice day :)".mysqli_connect_error());
}
?>