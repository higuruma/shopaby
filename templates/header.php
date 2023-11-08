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
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Agbalumo">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Gaegu">


<style>
.brand {
    color: #ffffff;
}
.footer{
    text-align: center;
}

/* Sign In/Up Form Styling */
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type="submit"] {
    text-align: center;
    background-color: #ff8fab;
    border-radius: 25px;
    border: none;
    color: white;
    padding: 24px 24px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
}
input[type="submit"]:hover {
    background-color: #febdce;
}
.input_form{
    display: flex;
    flex-direction: column;
    max-width: 50vh;
    font-size: 15px;
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
    color: #ff8fab;
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
    font-family: "Gaegu";
    color: white;
    display: inline;
    float: left;
}


body {
    font-family: "Gaegu";
    margin: 0px;
    
}

.primary {
    background: #ffffff !important;
    height: 15%;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    height: 10%;
    overflow: hidden;
}

li {
    float: left;
    height: 15%;
}

i {
    color: #ffffff;
}

.header-elements-float-right {
    float: right;
}

/* Dropdown Menu Styling */

.dropdown {
    float: left;
    overflow: hidden;
}

.dropdown .dropbtn {
    font-size: 16px;
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}

.navbar a:hover,
.dropdown:hover .dropbtn {
    padding: 20px;
    background-color: pink;
    border-radius: 30px;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.dropdown-content a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.dropdown:hover .dropdown-content {
    display: block;
}

/* Search Bar Styling */

#search_form {
    background-color: #ffffff;
    width: 300px;
    height: 44px;
    border-radius: 5px;
    display: flex;
    flex-direction: row;
    align-items: center;
    margin: 10px;
}

input {
    all: unset;
    font: 16px system-ui;
    color: #febcde;
    height: 100%;
    width: 100%;
    padding: 10px;
    margin-left: 10px;
    border: 0px solid #ffffff;
}

#search {
    padding-left: 15px;
    padding-top: 10px;
    border: none;
    border-width: 0px;
    border-style: none;
    border-color: #febcde;
    border-radius: 30px;
}

::placeholder {
    color: #febcde;
    opacity: 0.7;
}

button {
    all: unset;
    cursor: pointer;
    width: 44px;
    height: 44px;
}

svg {
    color: #febcde;
    fill: currentColor;
    width: 24px;
    height: 24px;
    padding: 10px;
}



ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #febcde;
}

li {
    float: left;
    margin: 1%;
    height: 78px;
}

.listings-btn {
    color: #ffffff;
}

.label-icon {
    float: center;
    margin: 10px;
    padding: 10px;
}

.material-icon {
    float: center;
    margin: 10px;
    padding: 10px;
}

#pink-logo {
    margin: 10px;
    width: 50px;
    height: 50px;
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
</style>
</head>

<body>
<ul>
<li><img src="assets/images/shopaby_logo_white.png" alt="Shopaby" id="pink-logo" /></li>
<li><a href="index.php" class="logo">Shopaby</a></li>
<li>
<form id="search_form" method="get" action='/shopaby/index.php'>
<input id="search" type="search" name="q" value="" aria-label="Search through site content"
class="z-depth-0">
<button>
<svg viewBox="0 0 1024 1024">
<path class="path1"
d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z">
</path>
</svg>
</button>
</form>
</li>
<li"header-elements-float-right">
<div class="dropdown">
<button class="dropbtn"><i class="fa fa-bars"></i></button>
<div class="dropdown-content">
<a href="#">Link 1</a>
<a href="#">Link 2</a>
<a href="#">Link 3</a>
</div>
</div>
</li>
<li class="header-elements-float-right"><a href="album.php"><img src="assets/images/album_icon_white.png"
alt="album" id="logo"></a></li>



</ul>
</body>
