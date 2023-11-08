
<?php
include('config/db_connect.php');
  


  // write query for all users
  // SELECT = RETRIEVE, FROM = GET FROM
  // star (*) means u want all the columns for each record
  // if no want all, type them out instead

  // $sql = 'SELECT first_name, last_name FROM users ORDER BY created_at';

  //$search_field = DOMDocument::getElementById("demo");
  
  // $_POST["search"];
  // echo 'good process to get:'.$_GET['q'];
  
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
  // echo "</br>". "Fetched Users". "</br>";

  // print_r($users);
 
?>


<!DOCTYPE html>
<html>
<script type = "text/javascript">  
 // onSubmit = search_bar() //
    function search_bar() {   
      alert("how are you:"+ $search_condition);  
    }  
</script> 
  <?php include('templates/header.php'); ?>
  <form method = "get" 
    action = '/shopaby/index.php'>
    <label>Search Bar</label>
    <input id="search_id" type = "text" name = "q" value = "">
    <input type = "submit" >
  </form>

  <h4 class = "center grey-text">Users!</h4>

  <div class="container">
    <div class="row">
      <a href = "signup.php">sign up for new user</a>
    </div>
    <div class="row">
      <a href = "login.php">existing user login</a>
    </div>
    <div>
      <a href = "home.php">home shortcut</a>
      <?php foreach($users as $user){ ?>
        <div class="col s6 md3">
          <div class="card z-depth-0">
            <div class="content senter">
              <h6><?php echo htmlspecialchars($user['first_name']) ?></h6>
              <div><?php echo htmlspecialchars($user['last_name']) ?></div>
            </div>
            <div class="card-action right-align">
              <a href="" class="brand-text" href="#">more info</a>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
  
  <?php include('templates/footer.php')?>
  
</html>
