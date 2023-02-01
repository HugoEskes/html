<?php
include "connection.php";

  if(isset($_POST["username_ajax"])) 
  {
    $username = $_POST["username_ajax"];
    $sql = "Select * from gebruikers where gebruikersnaam='$username'";
    $result = mysqli_query($connection, $sql);
    $num = mysqli_num_rows($result);

    if($num!=0)
      {
      echo 1;
      }
    else
      {
      echo 0;
      }
  }

?>