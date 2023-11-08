<?php

//connect to db

$hostURL = "localhost";
$db_username = "fullbug";
$db_password = "honeytest";
$db_name = "shopaby";

$conn = mysqli_connect($hostURL, $db_username, $db_password, $db_name);

$currentUser;

//check connection
if(!$conn){
  echo 'Connection error: ' , mysqli_connect_error();
}


?>