<?php

    include('config/db_connect.php');

    //$_GET is a global array in php
    //checking if 'submit' has been initialized/pressed
    $listing_name = $price = $quantity = $description = '';
    $errors = array('listing_name' => '', 'price'=>'', 'description'=>'');

    if(isset($_POST['submit'])){

        //check listing_name
        if(empty($_POST['listing_name'])){
            $errors['listing_name'] = 'listing name is required <br />';
        }else{
            $listing_name = $_POST['listing_name'];
            if(!ctype_alnum($listing_name)){
                $errors['listing_name'] = 'listing name can only consist of letters and numbers';
            }
        }

        //check price
        if(empty($_POST['price'])){
            $errors['price'] = 'price is required <br />';
        }else{
            $price = $_POST['price'];
            if(!preg_match('/^[0-9]*$/',$price)){
                $errors['price'] = 'cost can only consist of numbers';
            }
        }

        if(empty($_POST['quantity'])){
            $errors['quantity'] = 'quantity is required <br />';
        }else{
            $quantity = $_POST['quantity'];
            if(!preg_match('/^[0-9]*$/',$quantity)){
                $errors['quantity'] = 'you must enter a numerical quantity';
            }
        }

        //check description
        if(empty($_POST['description'])){
            $errors['description'] = 'descriptionription is required <br />';
        }else{
            $description = $_POST['description'];
            if(!ctype_alnum($description)){
                $errors['description'] = 'description can only consist of numbers and letters';
            }
        }

        if(array_filter($errors)){
            echo "errors in form";
        }else{
            header('Location: index.php');
        }
    }

?>

<!DOCTYPE html>
<html>
    <?php include('templates/header.php'); ?>
    <section class = "container grey-text">
        <h4 class = "center">Add Listing</h4>
        <form action = "add.php" class = "white" method = "POST">
            <label>listing name</label></label>
            <input type = "text" name = "listing_name">
            <label>price</label></label>
            <input type = "number" name = "price">
            <label>quantity</label></label>
            <input type = "number" name = "quantity">
            <label>description</label></label>
            <input type = "text" name = "description">
            <div class="center">
                <input type = "form_submit" name = "submit" value = "submit" class = "btn-brand z-depth-0">
            </div>
        </form>
    </section>
    <?php include('templates/footer.php'); ?>
</html>