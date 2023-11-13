<?php include('templates/header.php');


$sql = "SELECT DISTINCT 
      listings.listing_id, 
      listings.listing_name, 
      listings.seller_name, 
      listings.user_id, 
      listings.price, 
      listings.listing_image;
      albums.u_id, 
      albums.listing_id 
  FROM 
    listings INNER JOIN albums ON listings.listing_id=albums.listing_id 
    WHERE albums.u_id = $_SESSION[currentUser]
    ;"
;

// make query and get result
// uses $conn variable ref to connect

$result = mysqli_query($conn, $sql);

// Have to get from result the array that want
// fetch resulting rows
// returns $result as associative array

$albums = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>

<!DOCTYPE html>
<html>

<head>

</head>

<body>
  <div class="gen-body-div">
    <h4 class="page-center-title">my album</h4>
    <div class="scroll-container">
      <div class="card-scroll">
        <?php foreach ($albums as $album) { ?>
          <?php if (intval($_SESSION["currentUser"]) == intval($album['u_id'])) { ?>
            <div class="card">
              <div class="card-image">
              <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($listing['listing_image']); ?>" /> 
              </div>
              <div class="card-header">
                <div class="card-name">
                  <?php echo htmlspecialchars($album['listing_name']) ?>
                </div>
                <div class="card-price">
                  <?php echo htmlspecialchars($album['price']) ?>
                </div>
              </div>
              <div class="card-list-seller">
                <?php echo htmlspecialchars($album['seller_name']) ?>
              </div>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </div>
</body>

<?php include('templates/footer.php') ?>

</html>