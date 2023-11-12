<?php include('templates/header.php'); ?>

<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <div class="gen-body-div">
      <h4 class="page-center-title">explore listings</h4>
      <div class="scroll-container">
      <div class="card-scroll">
        <?php foreach ($users as $user) { 
            if($currentUser == htmlspecialchars($user['username'])){
            ?>
          <div class="card">
            <div class="card-image"></div>
            <div class="card-header">
              <div class="card-name">
                <?php echo htmlspecialchars($user['first_name']) ?>
              </div>
              <div class="card-price">
                <?php echo htmlspecialchars($user['user-id']) ?>
              </div>
            </div>
            <div class="card-list-date">
              <?php echo htmlspecialchars($user['first_name']) ?>
            </div>
            <button class="add">add to album</button>
          </div>
        <?php }} ?>

      </div>
    </div>
  </div>
</body>

<?php include('templates/footer.php') ?>

</html>