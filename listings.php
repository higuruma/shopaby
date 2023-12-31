<?php include('templates/header.php');


$sql = "SELECT  
      listings.listing_id, 
      listings.listing_name, 
      listings.seller_name, 
      listings.user_id, 
      listings.price, 
      listings.listing_image,
      listings.created_at,
      users.id
  FROM 
    listings INNER JOIN users ON listings.user_id=users.id 
    WHERE users.id = $_SESSION[currentUser]
    ;"
;

// echo intval($_SESSION['currentUser']);
// make query and get result
// uses $conn variable ref to connect

$result = mysqli_query($conn, $sql);

// Have to get from result the array that want
// fetch resulting rows
// returns $result as associative array

$albums = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Redirect to edit listing page
$r = $_GET['r'];
$view = $_GET['view-listing'];
if (isset($view)) {
  // $listing_id = intval($listing['listing_id']);
  echo $view;
  $_SESSION["currentListing"] = intval($view);
  echo "<script> location.href='/shopaby/display_listing.php'; </script>";
}
$q = $_GET['q'];
$del = $_GET['delete-listing'];
// if (isset($_GET['submit'])) {
if (isset($del)) {
  // $listing_id = intval($listing['listing_id']);
  $listing_id = intval($del);
  $u_id = intval($_SESSION["currentUser"]);
  $sql = "DELETE FROM listings WHERE listing_id = '$listing_id'";
  if ($conn->query($sql) === TRUE) {
    header("Location: listings.php");
 } else {
     echo "Error deleting record: " . $conn->error;
 }
 $sql = "DELETE FROM albums WHERE listing_id = '$listing_id'";
  if ($conn->query($sql) === TRUE) {
    header("Location: listings.php");
 } else {
     echo "Error deleting record: " . $conn->error;
 }
}


?>

<!DOCTYPE html>
<html>

<head>

</head>

<body>
  <div class="gen-body-div">
    <h4 class="page-center-title">my listings</h4>
    <div class="scroll-container">
      <div class="card-scroll">
        <?php foreach ($albums as $album) { ?>
          <div class="card">
            <div class="card-image"><img class="card-image-file"
                src="data:image/jpg;charset=utf8;base64,<?php echo stripcslashes(base64_encode($album['listing_image'])); ?>" />
            </div>
            <div class="card-header">
              <div class="card-name">
                <?php echo htmlspecialchars($album['listing_name']) ?>
              </div>
              <div class="card-price">
                $
                <?php echo htmlspecialchars($album['price']) ?>
              </div>
            </div>
            <div class="card-list-seller">
              <?php echo htmlspecialchars($album['seller_name']) ?>
            </div>
            <div class="card-list-seller">
              added:
              <?php echo htmlspecialchars($album['created_at']) ?>
            </div>
            <form method="get">
              <input type="hidden" name="r" value="<?php echo $r ?>">
              <input type="hidden" name="view-listing" value="<?php echo htmlspecialchars($album['listing_id']) ?>">
              <input class="view-listing-button" type="submit" name="submit" value="view" />
            </form>
            <form method="get">
              <input type="hidden" name="q" value="<?php echo $q ?>">
              <input type="hidden" name="delete-listing" value="<?php echo htmlspecialchars($album['listing_id']) ?>">
              <input class="add-to-album-button" type="submit" name="submit" value="delete listing" />
            </form>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</body>

<?php include('templates/footer.php') ?>

</html>