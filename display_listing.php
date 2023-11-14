<?php include('templates/header.php');

$listing_id = $_SESSION["currentListing"];
$q = $_GET['q'];

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


?>

<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <div class="gen-body-div">
        <h4 class="page-center-title">
            <?php echo intval($_SESSION["currentListing"]) ?>
        </h4>
        <div class="scroll-container">
      <div class="card-scroll">
      <?php foreach ($listings as $listing) { ?>
            <div class="card">
              <div class="card-image"><img class="card-image-file"
                  src="data:image/jpg;charset=utf8;base64,<?php echo stripcslashes(base64_encode($listing['listing_image'])); ?>" />
              </div>
              <div class="card-header">
                <div class="card-name">
                  <?php echo htmlspecialchars($listings['listing_name']) ?>
                </div>
                <div class="card-price">
                  $
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
              <form method="get">
                <input type="hidden" name="r" value="<?php echo $r ?>">
                <input type="hidden" name="view-listing" value="<?php echo htmlspecialchars($listing['listing_id']) ?>">
                <input class="view-listing-button" type="submit" name="submit" value="view" />
              </form>
        </div>
      <?php } ?>
    </div>
    </div>
</body>

<?php include('templates/footer.php') ?>

</html>