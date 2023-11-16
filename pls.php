<?php
include('config/db_connect.php');

$q = $_GET['q'];

$sql = "SELECT first_name, last_name FROM users WHERE LOWER(first_name) LIKE LOWER('%$q%') ORDER BY created_at";

// make query and get result
// uses $conn variable ref to connect

$result = mysqli_query($conn, $sql);

// Have to get from result the array that want
// fetch resulting rows
// returns $result as associative array

$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

// printing array
// echo "</br>" . "Fetched Users" . "</br>";
// print_r($users);

?>


<!DOCTYPE html>
<html class="theme-pink">

<head>
    <!-- links and whatnot -->
    <title>Shopaby</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="styles/header-styles.css">
    <link rel="stylesheet" href="styles/gen-body-styles.css">
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
            <form id="search-form" method="get" action='/shopaby/index.php'>
                <input id="search-input" type="search" name="q" value="" placeholder="Search products..">
            </form>
        </div>
        <div class="dropdown">
            <button class="dropbtn">
                <i class="fa fa-bars"></i>
            </button>
            <div class="dropdown-content">
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
            </div>
        </div>
        <div class="nav-elements">
            <a href="#album" class="icons" id="pink-album"><i class="fa fa-book"></i></a>
        </div>
    </div>
    <hr class="color-hr">
    <hr class="color-hr">
    <div class="gen-body-div">
        <p> hello </p>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <p>hello</p>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <p>hello</p>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <p>hello</p>
    </div>
</body>

</html>


<?php include('templates/footer.php');  ?>