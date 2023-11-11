<!DOCTYPE html>
<html>
<script type="text/javascript">
  // onSubmit = search_bar() //
  function search_bar() {
    alert("how are you:" + $search_condition);
  }  
</script>

<!-- Include the Header Template -->
<?php include('templates/header.php'); ?>

<h4>Users!</h4>

<div class="container">
  <div class="row">
    <a href="/shopaby/signup.php">sign up for new user</a>
  </div>
  <div class="row">
    <a href="/shopaby/login.php">existing user login</a>
  </div>
  <div>
    <a href="home.php">home shortcut</a>
    <?php foreach ($users as $user) { ?>
      <div class="col s6 md3">
        <div class="card z-depth-0">
          <div class="content senter">
            <h6>
              <?php echo htmlspecialchars($user['first_name']) ?>
            </h6>
            <div>
              <?php echo htmlspecialchars($user['last_name']) ?>
            </div>
          </div>
          <div class="card-action right-align">
            <a href="" class="brand-text" href="#">more info</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<?php include('templates/footer.php') ?>

</html>