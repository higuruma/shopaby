<?php

//connect to db

$hostURL = "localhost";
$db_username = "fullbug";
$db_password = "honeytest";
$db_name = "shopaby";

$conn = mysqli_connect($hostURL, $db_username, $db_password, $db_name);
$conn1 = mysqli_connect($hostURL, $db_username, $db_password, $db_name);
$albums_conn = mysqli_connect($hostURL, $db_username, $db_password, $db_name);
$listings_conn = mysqli_connect($hostURL, $db_username, $db_password, $db_name);

session_start();
$_SESSION["currentUser"];
$userLoggedIn = false;

//check connection
if(!$conn){
  echo 'Connection error (users table): ' , mysqli_connect_error();
}
if(!$conn1){
  echo 'Connection error (conn1): ' , mysqli_connect_error();
}
if(!$albums_conn){
  echo 'AlbuConnection error: (albums table)' , mysqli_connect_error();
}
if(!$listings_conn){
  echo 'Connection error (listings table): ' , mysqli_connect_error();
}


?>