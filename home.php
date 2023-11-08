
<?php
include('config/db_connect.php');
  


  // write query for all users
  // SELECT = RETRIEVE, FROM = GET FROM
  // star (*) means u want all the columns for each record
  // if no want all, type them out instead

  // $sql = 'SELECT first_name, last_name FROM users ORDER BY created_at';

  //$search_field = DOMDocument::getElementById("demo");
  
  // $_POST["search"];
  echo 'good process to get:'.$_GET['q'];
  
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
  echo "</br>". "Fetched Users". "</br>";

  print_r($users);
 
?>


<!DOCTYPE html>
<html>

<h4 class = "center grey-text">Explore Listings</h4>
<script type = "text/javascript">  
 // onSubmit = search_bar() //
    function search_bar() {   
      alert("how are you:"+ $search_condition);  
    }  
</script> 
  <?php include('templates/header.php'); ?>
  <form method = "get" 
    action = '/shopaby/home.php'>
    <label>Search Bar</label>
    <input id="search_id" type = "text" name = "q" value = "">
    <input type = "submit" >
  </form>
  <li><a href = "add.php" class = "btn brand z-depth-0">Add Listing</a></li>

  <div class="container">
    <div class="row">
    </div>
    <div>
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
