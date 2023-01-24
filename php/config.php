<?php

define('DBSERVER', 'localhost');
define('DBUSERNAME', 'root');
define('DBPASSWORD', '');
define('DBNAME', 'gebruikers');

$db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

if ($db === False){
    die ("Error: connection error. Have a nice day :)".mysqli_connect_error());
}
>