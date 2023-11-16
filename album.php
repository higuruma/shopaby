<?php include('templates/header.php');

//query listing and albums from db
$sql = "SELECT DISTINCT
      listings.listing_id, 
      listings.listing_name, 
      listings.seller_name, 
      listings.user_id, 
      listings.price, 
      listings.listing_image,
      albums.u_id, 
      albums.listing_id,
      albums.added_at 
  FROM 
    listings INNER JOIN albums ON listings.listing_id=albums.listing_id 
    WHERE albums.u_id = $_SESSION[currentUser]
    ;"
;

$result = mysqli_query($conn, $sql);

//retrieve values from result
$albums = mysqli_fetch_all($result, MYSQLI_ASSOC);

//album deletion
$del = $_GET['delete-listing'];
if (isset($del)) {
  // $listing_id = intval($listing['listing_id']);
  $listing_id = intval($del);
  $u_id = intval($_SESSION["currentUser"]);
 $sql = "DELETE FROM albums WHERE listing_id = '$listing_id' AND u_id = '$u_id'";
  if ($conn->query($sql) === TRUE) {
    header("Location: album.php");
 } else {
     echo "Error deleting record: " . $conn->error;
 }
}

?>

<!DOCTYPE html>
<html>
<body>
  <div class="gen-body-div">
    <h4 class="page-center-title">my album</h4>
    <div class="scroll-container">
      <div class="card-scroll">
        <?php foreach ($albums as $album) { ?>
          <?php if (intval($_SESSION["currentUser"]) == intval($album['u_id'])) { ?>
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
                  added: <?php echo htmlspecialchars($album['added_at']) ?>
                </div>
                <form method="get">
              <input type="hidden" name="delete-listing" value="<?php echo htmlspecialchars($album['listing_id']) ?>">
              <input class="add-to-album-button" type="submit" name="submit" value="remove" />
            </form>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </div>
</body>

<?php include('templates/footer.php') ?>

</html>
