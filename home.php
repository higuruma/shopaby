
<?php
  
  include("config/db_connect.php");

  // write query for all users
  // SELECT = RETRIEVE, FROM = GET FROM
  // star (*) means u want all the columns for each record
  // if no want all, type them out instead

  $sql = 'SELECT listing_name FROM listings ORDER BY rating';

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
  <h4 class = "center grey-text">Explore Listings</h4>

  <div class="container">
    <div class="row">
      <!-- -->
      <?php foreach($listings as $listing): ?>
        <div class="col s6 md3">
          <div class="card z-depth-0">
            <div class="content senter">
              <h6><?php echo htmlspecialchars($listing['listing_name']) ?></h6>
            </div>
            <div class="card-action right-align">
              <a href="" class="brand-text" href="#">more info</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <?php if(count($listings) <= 0): ?>
        <p>There are no listings</p>
        <?php else : ?>
          <p>there are listing</p>
        <?php endif; ?>

    </div>
  </div>
  
  <?php include('templates/footer.php')?>
</html>
