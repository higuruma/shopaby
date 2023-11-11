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

// printing array
// echo "</br>" . "Fetched Users" . "</br>";
// print_r($users);

?>






<head>
    <title>Shopaby</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js">
    </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dongle">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Gaegu">


    <style>
    .brand {
        color: #ffffff;
    }

    .footer {
        text-align: center;
        position: absolute;
        left: 40%;
        right: 40%;
        bottom: 10px;
        margin: auto;
        font-size: 10x;

    }

    /* Sign In/Up Form Styling */
    input[type=text],
    [type=password],
    [type=email],
    select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        width: 90%;
        text-align: center;
        background-color: #ffffff;
        border-radius: 25px;
        border: 2px solid #febdce;
        color: black;
        padding: 24px 24px;
        text-decoration: none;
        margin: 20px 2px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        color: white;
        transition-duration: 0.4s;
        background-color: #febdce;
    }

    .input_form {
        display: flex;
        flex-direction: column;
        max-width: 50vh;
        font-size: 25px;
        margin: 30px auto;
        padding: 20px;
    }

    /* Alert Dialog Styling */
    .alert {
        border-radius: 25px;
        border: 2px solid #ff8fab;
        margin-right: 25%;
        margin-left: 25%;
        text-align: center;
        padding: 20px;
        background-color: white;
        color: black;
    }

    .closebtn {

        margin-left: 15px;
        color: #ff8fab;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: #fadde1;
    }

    .logo {
        padding: 10px;
        font-size: 30px;
        font-family: "Dongle";
        color: #000000;
        display: inline;
        float: left;
        font-weight: bold;
        text-decoration: none;
    }

    body {
        font-family: "Dongle";
        margin: 0px;

    }

    .primary {
        background: #ffffff !important;
        height: 15%;
    }


    .header-elements-float-right {
        float: right;
        margin: auto;
    }


    /* Dropdown Menu Styling 
         margin-left: 10px;
            margin-right: 10px;
            float: right;
            padding-left: 15px;
            padding-right: 30px;
        */


    .dropdown {
        width: 50px;
        height: 50px;
        align-items: center;
        margin: auto;
        padding: 10px;
        color: #febcde;
        background-color: white;
    }

    #album-pic-div {
        width: 50px;
        height: 50px;
        align-items: center;
        margin: auto;
        padding: 10px;
        color: #febcde;
    }

    #album-pic {
        all: unset;
        cursor: pointer;
        width: 44px;
        height: 44px;
        position: absolute;
    }
    
    @media only screen and (max-width: 900px) {
        #album-pic {
            display: none;
        }
        #album-pic-div{
            display: none;
        }
    }


    .dropbtn {
        font-size: 16px;
        color: #febcde;
        padding-top: 9px;
        position: fixed;
        margin: auto;
    }

    .dropdown:hover .dropbtn {
        border-radius: 30px;

    }

    .dropdown-content {
        display: none;
        position: absolute;
        right: 30px;
        top: 90px;
        background-color: black;
        min-width: 200px;
        border-color: #febcde;
        border-style: solid;
        border-width: 3px;
    }

    .dropdown-content a {
        float: center;
        color: black;
        position: relative;
        align-items: center;
        flex-direction: column;
        text-decoration: none;
        padding-top: 20px;
        padding-bottom: 20px;
        padding-left: 20px;
        padding-right: 20px;
        display: block;
        text-align: left;
        border-color: #febcde;
        background-color: #ffffff;
    }

    .dropdown-content a:hover {
        background-color: #febcde;
    }

    .dropdown:hover .dropdown-content {
        display: inline;
    }

    /* Search Bar Styling */

    #search_form {
        background-color: #ffffff;
        height: 25px;
        width: 60%;
        display: inline;
    }

    #search-bar {
        margin-top: 10px;
        display: inline;
        width: 50%;
    }

    input {
        all: unset;
        font: 16px system-ui;
        color: black;
        font-family: 'Gaegu';
        height: 100%;
        width: 100%;
        padding: 10px;
        margin-left: 10px;

    }

    #search-input {
        height: 25px;
        width: 80%;
        margin-top: 8px;
        padding-left: 25px;
        padding-left: 15px;
        padding-top: 10px;
        border-radius: 30px;
        border-color: #febcde;
        border-style: solid;
        border-width: 3px;
    }

    @media screen and (max-width: 330px) {
        html {
            width: 330px;
            overflow: auto;
        }
    }

    @media screen and (max-height: 400px) {
        html {
            height: 400px;
            overflow: auto;
        }
    }

    button {
        all: unset;
        cursor: pointer;
        width: 44px;
        height: 44px;
        position: absolute;
    }

    svg {
        color: #febcde;
        fill: currentColor;
        width: 24px;
        height: 24px;
        padding-top: 20px;
        padding-left: 10px;
    }

    ul {
        list-style-type: none;
        align-items: center;
        background-color: #ffffff;
        min-height: 8vh;
        overflow: hidden;
    }


    li {
        float: left;
        display: inline;
        margin: 1%;
        height: 70px;
    }


    .listings-btn {
        color: #ffffff;
    }

    i {
        color: #febcde;
    }

    hr {
        display: block;
        margin-left: auto;
        margin-right: auto;
        border-style: solid;
        border-width: 2px;
        border-color: #000000;
        position: relative;
    }

    hr.pink-hr {
        border-color: #febcde;
    }

    #pink-logo {
        margin: 8px;
        width: 50px;
        height: 50px;
        float: left;
    }

    #logo {
        margin: 12px;
        background-image: url(assets/images/album_icon_white.png);
        background-repeat: no-repeat;
        background-size: auto;
        width: 32px;
        height: 32px;
        float: right;
    }
    h4.page-center-title{
    font-size: 50px;
    text-align: center;
    font-family: 'Dongle';
    color: #febcde;

}

.card-scroll{
    width: 100%;
    margin-left: auto;
    margin-right: auto;
    min-width: 400px;
    background-color: green;
    align-items: start;
    display: flex;
    justify-content: left;

}

.card{
    margin-left: 20px;
    margin-right: 20px;
    padding: 5px;
    font-family: 'Dongle';
    text-align: center;
    width: 200px;
    color: #000000;
    background-color: blue;
}

.card-image{
    padding: 5px;
    margin-left: auto;
    margin-right: auto;
    background-color: red;
    width: 190px;
    height: 200px;
}

.card-header{
    display: flex;
    justify-content: space-around;
}

.card-name{
    background-color: yellow;
    font-size: 25px;
    width: 40%;
    text-align: start;
    align-items: start;
}

.card-price{
    background-color: brown;
    font-size: 25px;
    width: 40%;
    text-align: end;
    align-self: end;
}

.card-list-date{
    margin-left: 10px;
    background-color: purple;
    height: 10x;
    font-size: 20px;
    text-align: start;
    align-self: start;
}
    </style>
</head>

<body>
    <div id="wrapper">
        <ul id="header">
            <li><img src="assets/images/shopaby_logo_pink.png" alt="shopaby" id="pink-logo" /></li>
            <li><a href="index.php" class="logo">shopaby</a></li>
            <li id="search-bar">
                <form id="search-form" method="get" action='/shopaby/index.php'>
                    <input id="search-input" type="search" name="q" value="">
                    <button>
                        <svg viewBox="0 0 1024 1024">
                            <path class="path1"
                                d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z">
                            </path>
                        </svg>
                    </button>
                </form>
            </li>
            <li class="header-elements-float-right">
                <div id="album-pic-div">
                    <a id="album-pic" href="album.php"><img src="assets/images/album_icon_pink.png" alt="album-pic"
                            id="logo"></a>

                </div>
            </li>
            <li class="header-elements-float-right">
                <div id="album-pic-div">
                    <a id="album-pic" href="album.php"><img src="assets/images/album_icon_pink.png" alt="album-pic"
                            id="logo"></a>

                </div>
            </li>
            <li class="header-elements-float-right">
                <div class="dropdown">
                    <button class="dropbtn"><i class="fa fa-bars"></i></button>
                    <?php if ($userLoggedIn == false): ?>
                <div class="dropdown-content">
                    <a href="login.php">login</a>
                    <a href="#login.php">sign up</a>

                </div>
            <?php else: ?>
                <div class="dropdown-content">
                    <a href="user.php">my profile</a>
                    <a href="#">log out</a>
                </div>
            <?php endif; ?>
                </div>
            </li>

        </ul>
    </div>
    <hr>
    <hr class="pink-hr">
</body>