<?php
include '/config/db_connect.php';
$_SESSION["userLoggedIn"] = false;
session_unset();
//destroy the session
session_destroy();
//redirect to login page
header("location: login.php");
?>