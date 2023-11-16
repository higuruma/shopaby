<?php include('templates/header.php');

//retrieve logged in user
$listing_id = $_SESSION["currentListing"];
$q = $_GET['q'];

//query all listings' info
$sql = "SELECT 
        listing_id, 
        listing_name, 
        user_id, 
        seller_name, 
        price, quantity, 
        listing_image, 
        listing_desc, 
        created_at 
        FROM listings WHERE listing_id = $listing_id ORDER BY created_at";
$result = mysqli_query($conn, $sql);

// Have to get from result the array that want
// fetch resulting rows
// returns $result as associative array

$listings = mysqli_fetch_all($result, MYSQLI_ASSOC);

$r = $_GET['r'];
$add = $_GET['add-listing'];

//add listing to cart
if (isset($add)) {
  $list_id = intval($add);
  $u_id = intval($_SESSION["currentUser"]);
  $insert_sql = "INSERT INTO albums (listing_id, u_id) VALUES ('$list_id', '$u_id')";
  $insert_result = mysqli_query($conn, $insert_sql);
  echo "<script> location.href='/shopaby/album.php'; </script>";
}

?>

<!DOCTYPE html>
<html>
<body>
  <div class="gen-body-div">
    <h4 class="page-center-title">
      <?php echo $listings[0]['listing_name']; ?>
    </h4>
    <!-- Display each listing as a card -->
    <div class="display-container">
      <div class="display">
        <div class="display-image"><img class="display-image-file"
            src="data:image/jpg;charset=utf8;base64,<?php echo stripcslashes(base64_encode($listings[0]['listing_image'])); ?>" />
        </div>
        <div class="display-content">
          <div class="display-seller">
            Price: $
            <?php echo htmlspecialchars($listings[0]['price']) ?>
          </div>
          <div class="display-seller">
            Seller:
            <?php echo htmlspecialchars($listings[0]['seller_name']) ?>
          </div>
          <div class="display-description">
            Description: <?php echo htmlspecialchars($listings[0]['listing_desc']) ?>
          </div>
          <form method="get">
          <input type="hidden" name="q" value="<?php echo $q ?>">
          <input type="hidden" name="add-listing" value="<?php echo htmlspecialchars($listings[0]['listing_id']) ?>">
          <input id="display-add-to-album-button" type="submit" name="submit" value="add to album" />
        </form>
        <br>
        </div>
      </div>
    </div>
</body>
</html>