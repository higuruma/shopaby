<?php
    //$_GET is a global array in php
    //checking if 'submit' has been initialized/pressed
    if(isset($_POST['submit'])){
        echo $_POST['item'];
        echo $_POST['cost'];
        echo $_POST['desc'];
    }

?>

<!DOCTYPE html>
<html>
    <?php include('templates/header.php'); ?>
    <section class = "container grey-text">
        <h4 class = "center">Add Listing</h4>
        <form action = "add.php" class = "white" method = "POST">
            <label>Item</label></label>
            <input type = "text" name = "item">
            <label>Cost</label></label>
            <input type = "text" name = "cost">
            <label>Description</label></label>
            <input type = "text" name = "desc">
            <div class="center">
                <input type = "submit" name = "submit" value = "submit" class = "btn-brand z-depth-0">
            </div>
        </form>
    </section>
    <?php include('templates/footer.php'); ?>
</html>