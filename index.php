
<?php
  
  include('config/db_connect.php');
  

  // write query for all users
  // SELECT = RETRIEVE, FROM = GET FROM
  // star (*) means u want all the columns for each record
  // if no want all, type them out instead

  $sql = 'SELECT first_name, last_name FROM users ORDER BY created_at';


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
  <?php include('templates/header.php'); ?>
  <h4 class = "center grey-text">Users!</h4>

  <div class="container">
    <div class="row">
      <a href = "signup.php">sign up for new user</a>
    </div>
    <div>
      <a href = "home.php">home shortcut</a>
    </div>
  </div>
  
  <?php include('templates/footer.php')?>
</html>
