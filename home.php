<?php include('templates/header.php');

$q = $_GET['q'];
$r = $_GET['r'];

$sql = "SELECT listing_id, listing_name, user_id, seller_name, price, listing_image, created_at FROM listings WHERE LOWER(listing_name) LIKE LOWER('%$q%') ORDER BY created_at";

// make query and get result
// uses $conn variable ref to connect

$result = mysqli_query($conn, $sql);

// Have to get from result the array that want
// fetch resulting rows
// returns $result as associative array

$listings = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Have to get from result the array that want
// fetch resulting rows
// returns $result as associative array

$add = $_GET['add-listing'];
if (isset($add)) {
  $listing_id = intval($add);
  $u_id = intval($_SESSION["currentUser"]);
  $insert_sql = "INSERT INTO albums (listing_id, u_id) VALUES ('$listing_id', '$u_id')";
  $insert_result = mysqli_query($conn, $insert_sql);
}

$view = $_GET['view-listing'];
if (isset($view)) {
  echo $view;
  $_SESSION["currentListing"] = intval($view);
  echo "<script> location.href='/shopaby/display_listing.php'; </script>";
}
?>

<!DOCTYPE html>
<html>

<body>
  <div class="gen-body-div">
    <h4 class="page-center-title">explore listings</h4>
    <div class="scroll-container">
      <div class="card-scroll">
        <?php foreach ($listings as $listing) { ?>
          <a href='/shopaby/display_listing.php'>
            <div class="card">
              <div class="card-image"><img class="card-image-file"
                  src="data:image/jpg;charset=utf8;base64,<?php echo stripcslashes(base64_encode($listing['listing_image'])); ?>" />
              </div>
              <div class="card-header">
                <div class="card-name">
                  <?php echo htmlspecialchars($listing['listing_name']) ?>
                </div>
                <div class="card-price">
                  $
                  <?php echo htmlspecialchars($listing['price']) ?>
                </div>
              </div>
              <div class="card-list-seller">
                <?php echo htmlspecialchars($listing['seller_name']) ?>
              </div>
              
              <form method="get">
                <input type="hidden" name="q" value="<?php echo $q ?>">
                <input type="hidden" name="add-listing" value="<?php echo htmlspecialchars($listing['listing_id']) ?>">
                <input class="add-to-album-button" type="submit" name="submit" value="add to album" />
              </form>
              <form method="get">
                <input type="hidden" name="r" value="<?php echo $r ?>">
                <input type="hidden" name="view-listing" value="<?php echo htmlspecialchars($listing['listing_id']) ?>">
                <input class="view-listing-button" type="submit" name="submit" value="view" />
              </form>
          </a>
        </div>
      <?php } ?>
    </div>
  </div>
  </div>

</body>

<?php include('templates/footer.php') ?>

</html>