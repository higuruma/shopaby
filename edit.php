<?php

include('config/db_connect.php');

$listing_id = $_SESSION["currentListing"];
$q = $_GET['q'];

//query listings from db
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
var_dump($result);

// ID of listing being edited is stored in index 0
$listings = mysqli_fetch_all($result, MYSQLI_ASSOC);


//$_GET is a global array in php
//checking if 'submit' has been initialized/pressed
$listing_name = $price = $quantity = $listing_desc = '';
$errors = array('listing_name' => '', 'price' => '', 'quantity' => '', 'listing_desc' => '', 'listing_image' => '');
$currentUser = intval($_SESSION["currentUser"]);
$noInput = true;

if (isset($_POST['submit'])) {

    //check listing_name
    if (empty($_POST['listing_name'])) {
        $errors['listing_name'] = 'listing name is required <br />';
    } else {
        $listing_name = $_POST['listing_name'];
        if (!ctype_alnum($listing_name)) {
            $errors['listing_name'] = 'listing name can only consist of letters and numbers';
        }
    }

    //check price
    if (empty($_POST['price'])) {
        $errors['price'] = 'price is required <br />';
    } else {
        $price = $_POST['price'];
        // if (!preg_match('/^([1-9][0-9]*|0)(\.[0-9]{2})?$/', $price)) {
        //     $errors['price'] = 'cost can only consist of numbers';
        // }
    }

    if (empty($_POST['quantity'])) {
        $errors['quantity'] = 'quantity is required <br />';
    } else {
        $quantity = $_POST['quantity'];
        if (!preg_match('/^[0-9]*$/', $quantity)) {
            $errors['quantity'] = 'you must enter a numerical quantity';
        }
    }

    //check description
    if (empty($_POST['listing_desc'])) {
        $errors['listing_desc'] = 'listing description is required <br />';
    } else {
        $listing_desc = $_POST['listing_desc'];
    }

    if (!empty($_FILES["image"]["name"])) {
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]);
        $fileTmpName = $_FILES["image"]["tmp_name"];
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        
        //check if file uploaded successfully
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            echo "uploading file successfully ";
        } else {
            echo "Error uploading file: " . $_FILES['image']['error'];
        }

        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            $image = $_FILES['image']['tmp_name'];
            $image = file_get_contents($fileTmpName);

        } else {
            $errors['listing-image'] = 'Please select an image file to upload.';

        }
    }

    if (array_filter($errors)) {
        //echo errors, for now
        echo "errors in form";
        var_dump($errors);
    } else {

        //username validation
        $sql = "SELECT id, username FROM users WHERE id = '$currentUser'";
        $result = mysqli_query($conn, $sql);

        //obtain seller username and id
        if ($result) {

            $seller = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $seller_name = mysqli_real_escape_string($conn, $seller[0]['username']);
            $user_id = mysqli_real_escape_string($conn, $seller[0]['id']);
        }

        //change type to sql insertable string

        $fileTmpName = $_FILES["image"]["tmp_name"];
        $image = file_get_contents($fileTmpName);

        $listing_name = mysqli_real_escape_string($conn, $_POST['listing_name']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $listing_desc = mysqli_real_escape_string($conn, $_POST['listing_desc']);
        $seller_name = mysqli_real_escape_string($conn, $seller[0]['username']);
        $user_id = mysqli_real_escape_string($conn, $seller[0]['id']);

        // Check if a file is uploaded

        // Use prepared statements to avoid SQL injection
        $insert_sql = "INSERT INTO listings (listing_name, seller_name, user_id, price, quantity, listing_image, listing_desc) VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Create a prepared statement
        $stmt = $conn->prepare($insert_sql);

        // Bind parameters
        $stmt->bind_param("ssidibs", $listing_name, $seller_name, $user_id, $price, $quantity, $image, $listing_desc);

        $stmt->send_long_data(5, $image);
        // Execute the statement
        if ($stmt->execute()) {
            echo '<div class="alert">';
            echo '<span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>';
            echo 'Listing added!';
            echo '</div>';
            echo "<script> location.href='/shopaby/home.php'; </script>";


        } else {
            echo "Error inserting record: " . $stmt->error;
        }
        
        // Close the statement
        $stmt->close();

    }
}
?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>
<h4 class="add-center-title">Edit Listing</h4>
<form action="add.php" id="add-form" enctype="multipart/form-data" method="POST">
    <label class="input-label">Title</label></label>
    <p class="input-advice">What card are you putting up for trade/sale? Use keywords that will allow other users to
        find your item.</p>
    <input type="text" name="listing_name" placeholder="<?php echo htmlspecialchars($listings[0]['listing_name']) ?>">

    <div id="pq-row">
        <div class="pq-column">
            <label class="input-label">Price</label></label>
            <p class="input-advice">How much will one item cost per unit?</p>
            <input id="number-input" type="text" name="price" placeholder="<?php echo htmlspecialchars($listings[0]['price']) ?>">
        </div>
        <div class="pq-column">
            <label class="input-label">Quantity</label></label>
            <p class="input-advice">How many units do you have available for sale?</p>
            <input id="number-input" type="text" name="quantity" pattern="[0-99]" placeholder="<?php echo htmlspecialchars($listings[0]['quantity']) ?>">
        </div>
    </div>

    <label class="input-label">Description</label></label>
    <p class="input-advice">Provide a description that will give other users more information about what you're selling.
    </p>
    <textarea cols="30" rows="10" name="listing_desc" placeholder="<?php echo htmlspecialchars($listings[0]['listing_desc']) ?>"></textarea>

    <label class="input-label">Image</label></label>
    <p class="input-advice">Upload an image of your listing here. We recommend that the photo is taken against a white
        background and with good lighting. Remember, other users will see this photo. A poor photo may influence their
        decision to buy from you.
    </p>
    <div class="card-image"><img class="card-image-file"
                  src="data:image/jpg;charset=utf8;base64,<?php echo stripcslashes(base64_encode($listing['listing_image'])); ?>" />
              </div>
    <input id="file-upload" type="file" name="image">

    <div class="submit-div">
        <p>All set? Click the button below to post your listing!</p>
        <input id="submit-listing" type="submit" name="submit" value="Post it!">
    </div>
</form>

</html>