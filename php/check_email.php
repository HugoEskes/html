<?php
include "connection.php";

  if(isset($_POST["email_ajax"])) 
  {
    $email = $_POST["email_ajax"];
    $sql = "Select * from gebruikers where email='$email'";
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