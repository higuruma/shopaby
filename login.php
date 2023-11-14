<?php

include('config/db_connect.php');

//$_GET is a global array in php
//checking if 'submit' has been initialized/pressed
$username = $psw = '';
$id;
$errors = array('username' => '', 'psw'=>'');
$noInput = true;

if(isset($_POST['submit'])){
    $userFound = false;
    $pswCorrect = false;
    
    //check username
    if(empty($_POST['username'])){
        $errors['username'] = 'username is required <br />';
    }else{
        $username = $_POST['username'];
        if(!ctype_alnum($username)){
            $errors['username'] = 'user name can only consist of letters and numbers';
        }
    }
    
    //check password
    if(empty($_POST['psw'])){
        $errors['psw'] = 'password is required <br />';
    }else{
        $psw = $_POST['psw'];
    }
    
    if(array_filter($errors)){
        echo "errors in form";
        // echo $errors;
    }else{
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $psw = mysqli_real_escape_string($conn, $_POST['psw']);
        
        //username validation
        // checkUsername($username);
        
        $sql = "SELECT id, username, psw FROM users WHERE username = '$username'";

        $result = mysqli_query($conn, $sql);
        // var_dump($result);
        
        //if $result has no rows, that means no users with matching username found
        if(mysqli_num_rows($result) == 0){
            //userfound, noInput = false, since not the first time user on page anymore
            $noInput = false;
            $userFound = false;
            
        }else{
            $userFound = true;
            $found_user = mysqli_fetch_all($result, MYSQLI_ASSOC);

            //echo "found user";
            //var_dump($found_user);
            foreach($found_user as $fu){
                if(htmlspecialchars($fu['psw']) == htmlspecialchars($psw)){
                    $pswCorrect = true;
                    $_SESSION["currentUser"] = intval($fu['id']);
                    $_SESSION["userLoggedIn"] = true;
                }else{
                    // echo "pw is wrong";
                    // var_dump($fu['psw']);
                    $pswCorrect = false;
                }
            }
        }
        //save to db
        if(mysqli_query($conn, $sql)){
            //successful
        } else {
            // echo 'query error: ' . mysqli_error($conn);
        }
        echo "<script> location.href='/shopaby/home.php'; </script>";
        exit();
    }
}


?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
<!-- <h4 class = "center">Login</h4>
<form action = "login.php" class = "white" method = "POST">
<label>Username</label></label>
<input type = "text" name = "username">
<label>Password</label></label>
<input type = "password" name = "psw">
<div class="center">
<input type = "submit" name = "submit" value = "Login!" class = "btn-brand z-depth-0">
</div>
</form> -->
<form class="input-form" action="/shopaby/login.php" method="POST">
    <label>Username</label></label>
    <input type="text" name="username" placeholder="Your username..">
    <label>Password</label></label>
    <input type="password" name="psw" placeholder="Your password..">
    <div class="center">
        <input type="submit" name="submit" value="Login!">
    </div>
</form>
<?php if($userFound == true): ?>
<?php if($pswCorrect == true): ?>
<?php 
        $_SESSION["userLoggedIn"] = true;
        // echo "<script> location.href='/shopaby/home.php'; </script>";
        // exit;
        ?>
<?php elseif($pswCorrect == false):?>
<!-- Otherwise, if user found but password not true, show wrong password dialog -->
<div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <strong> Error! </strong> Incorrect Password.
</div>
<?php endif;?>
<?php else:?>
<?php if($noInput == true): 
    $_SESSION["userLoggedIn"] = false;
    ?>
<!-- Do nothing if first time loading page -->
<?php else:?>
<div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <strong> Error! </strong> User Not Found.
</div>
<?php endif;?>
<?php endif;?>

<!-- Displaying error if username already exists-->

<?php include('templates/footer.php'); ?>

</html>