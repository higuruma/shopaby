<?php include('templates/header.php');



// $sql_albums = "SELECT listing_id, u_id FROM albums ORDER BY u_id";
// $result_albums = mysqli_query($albums_conn, $sql_albums);
// $albums = mysqli_fetch_all($result_albums, MYSQLI_ASSOC);
// make query and get result
// uses $conn variable ref to connect

$q = $_GET['q'];
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
// if (isset($_GET['submit'])) {
if (isset($add)) {
  // $listing_id = intval($listing['listing_id']);
  $listing_id = intval($add);
  $u_id = intval($_SESSION["currentUser"]);
  $insert_sql = "INSERT INTO albums (listing_id, u_id) VALUES ('$listing_id', '$u_id')";
  $insert_result = mysqli_query($conn, $insert_sql);
}
?>

<!DOCTYPE html>
<html>

<head>

</head>

<body>
  <div class="gen-body-div">
    <h4 class="page-center-title">explore listings</h4>
    <div class="scroll-container">
      <div class="card-scroll">
        <?php foreach ($listings as $listing) { ?>
          <div class="card">
            <div class="card-image"><img class= "card-image-file" src="data:image/jpg;charset=utf8;base64,<?php echo stripcslashes(base64_encode($listing['listing_image'])); ?>" /> </div>
            <div class="card-header">
              <div class="card-name">
                <?php echo htmlspecialchars($listing['listing_name']) ?>
              </div>
              <div class="card-price">
                <?php echo htmlspecialchars($listing['price']) ?>
              </div>
            </div>
            <div class="card-list-seller">
              <?php echo htmlspecialchars($listing['seller_name']) ?>
            </div>
            <!-- <form method="post" id= "id-<?php echo htmlspecialchars($listing['listing_id']) ?>"> -->
            <!-- <?php echo htmlspecialchars($listing['listing_id']) ?> -->
            <form method="get">
              <input type="hidden" name="q" value="<?php echo $q ?>">
              <input type="hidden" name="add-listing" value="<?php echo htmlspecialchars($listing['listing_id']) ?>">
              <input class="add-to-album-button" type="submit" name="submit" value="add to album" />
            </form>

          </div>
        <?php } ?>
      </div>
    </div>
  </div>

</body>

<?php include('templates/footer.php') ?>

</html>