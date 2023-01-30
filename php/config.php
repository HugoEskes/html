<?php

define('DBSERVER', 'localhost');
define('DBUSERNAME', 'hugoe');
define('DBPASSWORD', 'EDNZxAfEptklmtplrOmgeGquRAuvhNHw');
define('DBNAME', 'Skilift website');

$db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

if ($db === False){
    die ("Error: connection error. Have a nice day :)".mysqli_connect_error());
}
?>