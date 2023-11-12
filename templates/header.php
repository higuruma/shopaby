<?php
include('config/db_connect.php');

// write query for all users
// SELECT = RETRIEVE, FROM = GET FROM
// star (*) means u want all the columns for each record
// if no want all, type them out instead

// $sql = 'SELECT first_name, last_name FROM users ORDER BY created_at';

//$search_field = DOMDocument::getElementById("demo");

// $_POST["search"];
// echo 'Testing–Retrieve search item:' . $_GET['q'];

$q = $_GET['q'];

$sql = "SELECT first_name, last_name FROM users WHERE LOWER(first_name) LIKE LOWER('%$q%') ORDER BY created_at";

// make query and get result
// uses $conn variable ref to connect

$result = mysqli_query($conn, $sql);

// Have to get from result the array that want
// fetch resulting rows
// returns $result as associative array

$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html>

<head>
    <!-- links and whatnot -->
    <title>Shopaby</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="styles/header-styles.css">
    <link rel="stylesheet" href="styles/gen-body-styles.css">
    <link rel="stylesheet" href="styles/add-listing-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dongle">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Gaegu">
</head>

<body>
    <div class="nav-bar" id="myNav">
        <div class="nav-elements">
            <img src="assets/images/shopaby_logo_pink.png" alt="shopaby" id="pink-logo" />
        </div>
        <div class="nav-elements">
            <a href="index.php" class="brand-text">shopaby</a>
        </div>
        <div class="nav-elements">
            <a href="album" class="icons"><i class="fa fa-search"></i></a>
        </div>
        <div class="search-div">
            <form id="search-form" method="get" action='/shopaby/home.php'>
                <input id="search-input" type="search" name="q" value="" placeholder="Search products..">
            </form>
        </div>
        <div class="dropdown">
            <button class="dropbtn">
                <i class="fa fa-bars"></i>
            </button>
            <?php if ($userLoggedIn = false): ?>
                <div class="dropdown-content">
                    <a href="login.php">login</a>
                    <a href="signup.php">sign up</a>
                    
                </div>
            <?php else: ?>
                <div class="dropdown-content">
                    <a href="user.php">my profile</a>
                    <button onclick="<?php $userLoggedIn = false; ?>">Hello</button>
            
                </div>
            <?php endif; ?>

        </div>
        <div class="nav-elements">
            <a href="album.php" class="icons" id="pink-album"><i class="fa fa-book" alt="view my album"></i></a>
        </div>
    </div>
    <hr class="color-hr">
    <hr class="color-hr">
</body>