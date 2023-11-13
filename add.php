<?php

include('config/db_connect.php');

//$_GET is a global array in php
//checking if 'submit' has been initialized/pressed
$listing_name = $price = $quantity = $listing_desc = '';
$errors = array('listing_name' => '', 'price' => '', 'quantity' => '', 'listing_desc' => '', 'listing_image' => '');
$currentUser = intval($_SESSION["currentUser"]);
// var_dump($currentUser);
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

        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            echo "uploading file successfully " ;
        }
        else {
            echo "Error uploading file: " . $_FILES['image']['error'];
        }

        // $fileName = basename($_FILES["image"]["name"]);
        // echo "<script> location.href='/shopaby/home.php?test1=$fileName&test2=$fileType'; </script>";
        // exit;

        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            $image = $_FILES['image']['tmp_name'];
            // $image = file_get_contents(addslashes($image));
            // $image = file_get_contents(addslashes($fileTmpName));
            $image = file_get_contents($fileTmpName);

        } else {
            $errors['listing-image'] = 'Please select an image file to upload.';

        }
        // $fileSize = $_FILES["image"]["size"];
        // $img_length = strlen($image);
        // echo "<script> location.href='/shopaby/home.php?test1=$fileName&test2=$img_length'; </script>";
        // exit;
    }

    if (array_filter($errors)) {
        echo "errors in form";
        var_dump($errors);
    } else {

        $fileTmpName = $_FILES["image"]["tmp_name"];
        $image = file_get_contents($fileTmpName);

        $listing_name = mysqli_real_escape_string($conn, $_POST['listing_name']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $listing_desc = mysqli_real_escape_string($conn, $_POST['listing_desc']);
        $seller_name = mysqli_real_escape_string($conn, $seller[0]['username']);
        $user_id = mysqli_real_escape_string($conn, $seller[0]['id']);

        // Check if a file is uploaded
        // $fileTmpName = $_FILES['image']['tmp_name'];

        // Use prepared statements to avoid SQL injection
        $insert_sql = "INSERT INTO listings (listing_name, seller_name, user_id, price, quantity, listing_image, listing_desc) VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Create a prepared statement
        $stmt = $conn->prepare($insert_sql);

        // Bind parameters
        // $stmt->bind_param("sssssbs", $listing_name, $seller_name, $user_id, $price, $quantity, $image, $listing_desc);
        $stmt->bind_param("ssidibs", $listing_name, $seller_name, $user_id, $price, $quantity, $image, $listing_desc);

        // echo strlen($image);
        // echo $stmt;
        // echo "<script> location.href='/shopaby/home.php?test4=$stmt </script>";
        // exit;
        $stmt->send_long_data( 5, $image);
        // Execute the statement
        if ($stmt->execute()) {
            echo "Record inserted successfully.";
        } else {
            echo "Error inserting record: " . $stmt->error;
        }

        

        // Close the statement
        $stmt->close();

        // //username validation
        // // checkUsername($username);
        // $sql = "SELECT id, username FROM users WHERE id = '$currentUser'";
        // $result = mysqli_query($conn, $sql);

        // if ($result) {

        //     $seller = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //     // echo nl2br("\n  seller array ");
        //     // var_dump($seller);
        //     $seller_name = mysqli_real_escape_string($conn, $seller[0]['username']);
        //     $user_id = mysqli_real_escape_string($conn, $seller[0]['id']);
        //     // echo nl2br(" \n seller name: ");
        //     // var_dump($seller_name);
        //     // echo nl2br("\n  user id: ");
        //     // var_dump($user_id);

        //     // echo nl2br(" \n listing: ");
        //     // var_dump($listing_name);

        //     $insert_sql = "INSERT INTO 
        //                     listings ( listing_name, seller_name, user_id, price, quantity, listing_image, listing_desc ) 
        //                     VALUES 
        //                     ('$listing_name', '$seller_name', '$user_id', '$price', '$quantity', '$image', '$listing_desc' )";

        //     // echo nl2br(" \n sql: ");
        //     // var_dump($insert_sql);

        //     $insert_result = mysqli_query($conn, $insert_sql);
        //     // echo "<script> location.href='/shopaby/home.php'; </script>";
        //     echo "<script> location.href='/shopaby/home.php?test1=$fileName&test2=$img_length'; </script>";
        //     // echo "<script> location.href='/shopaby/home.php?test=$fileName'; </script>";
        //     // echo "<script> location.href='/shopaby/home.php?test=$fileName </script>";
        //     exit;

        // } else {
        //     echo "error";
        // }
        // //save to db
        // if (mysqli_query($conn, $sql)) {
        //     // header('Location: home.php');

        // } else {
        //     echo 'query error: ' . mysqli_error($conn);
        // }

       
    }
}
?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>
<h4 class="add-center-title">Add Listing</h4>
<form action="add.php" id="add-form" enctype="multipart/form-data" method="POST">
    <label class="input-label">Title</label></label>
    <p class="input-advice">What card are you putting up for trade/sale? Use keywords that will allow other users to
        find your item.</p>
    <input type="text" name="listing_name" placeholder="Title...">

    <div id="pq-row">
        <div class="pq-column">
            <label class="input-label">Price</label></label>
            <p class="input-advice">How much will one item cost per unit?</p>
            <input id="number-input" type="text" name="price" placeholder="0.00">
        </div>
        <div class="pq-column">
            <label class="input-label">Quantity</label></label>
            <p class="input-advice">How many units do you have available for sale?</p>
            <input id="number-input" type="text" name="quantity" pattern="[0-9]" placeholder="0">
        </div>
    </div>

    <label class="input-label">Description</label></label>
    <p class="input-advice">Provide a description that will give other users more information about what you're selling.
    </p>
    <textarea cols="30" rows="10" name="listing_desc" placeholder="Text here..."></textarea>

    <label class="input-label">Image</label></label>
    <p class="input-advice">Upload an image of your listing here. We recommend that the photo is taken against a white
        background and with good lighting. Remember, other users will see this photo. A poor photo may influence their
        decision to buy from you.
    </p>
    <label for="file-upload" class="custom-file-upload">
        Upload Photo
    </label>
    <input id="file-upload" type="file" name="image">

    <div class="submit-div">
        <p>All set? Click the button below to post your listing!</p>
        <input id="submit-listing" type="submit" name="submit" value="Post it!">
    </div>
</form>

</html>