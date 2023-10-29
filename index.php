
<?php
  echo "Database Initation!";

  //variables

  $hostURL = "localhost";
  $db_username = "fullbug";
  $db_password = "honeytest";
  $db_name = "shopaby";

  // making new DB connection

  $conn = mysqli_connect($hostURL, $db_username, $db_password, $db_name);
  if(!$conn){
    echo 'Connection error: ' , mysqli_connect_error();
  }

  // write query for all users
  // SELECT = RETRIEVE, FROM = GET FROM
  // star (*) means u want all the columns for each record
  // if no want all, type them out instead

  $sql = 'SELECT first_name, last_name FROM users';

  // make query and get result
  // uses $conn variable ref to connect

  $result = mysqli_query($conn, $sql);

  // Have to get from result the array that want
  // fetch resulting rows
  // returns $result as associative array

  $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // printing array
  echo "</br>". "Fetched Users". "</br>";

  print_r($users);

?>

<!DOCTYPE html>
<html>
  <head>
    <title>my first PHP</title>
      </head>
  <body>

      <h1><?php echo "GEESH"; ?></h1>

      <script src="scripts/main.js"></script>
  </body>
</html>
