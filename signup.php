<?php

include('config/db_connect.php');

//$_GET is a global array in php
//checking if 'submit' has been initialized/pressed
$username = $first_name = $last_name = $email = $psw = '';
$errors = array('username' => '', 'first_name' => '', 'last_name' => '', 'email' => '', 'psw' => '');
$noInput = true;
$userExists = true;

// function checkUsername($username, $conn){
//     $userExists = false;
//         $sql = "SELECT * FROM users WHERE username = '$username'";
//         $result = mysqli_query($conn, $sql);

//         if($result){

//             $usernames = mysqli_fetch_all($result, MYSQLI_ASSOC);

//             foreach($usernames as $un){
//                 echo htmlspecialchars($un['username']);
//                 echo "|";
//                 echo htmlspecialchars($username);
//                 if(htmlspecialchars($un['username']) == htmlspecialchars($username)){
//                     echo "2";
//                     $userExists = true;
//                     break;
//                 }
//             }

//         }else{
//             echo "error";
//         }
// } doesnt work for some reason :skull:

if (isset($_POST['submit'])) {

    //check username
    if (empty($_POST['username'])) {
        $errors['username'] = 'username is required <br />';
    } else {
        $username = $_POST['username'];
        if (!ctype_alnum($username)) {
            $errors['username'] = 'username can only consist of letters and numbers';
        }
    }

    //check first name
    if (empty($_POST['first_name'])) {
        $errors['first_name'] = 'first_name is required <br />';
    } else {
        $first_name = $_POST['first_name'];
        if (!preg_match("/^[A-Za-z\\- \']+$/", $first_name)) {
            $errors['first_name'] = 'cost can only consist of numbers';
        }
    }

    //check last name
    if (empty($_POST['last_name'])) {
        $errors['last_name'] = 'last_name is required <br />';
    } else {
        $last_name = $_POST['last_name'];
        if (!preg_match("/^[A-Za-z\\- \']+$/", $last_name)) {
            $errors['last_name'] = 'invalid input for last name';
        }
    }

    //check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'email is required <br />';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'invalid email format';
        }
    }

    //check password
    if (empty($_POST['psw'])) {
        $errors['psw'] = 'password is required <br />';
    } else {
        $psw = $_POST['psw'];
    }

    if (array_filter($errors)) {
        echo "errors in form";
    } else {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $psw = mysqli_real_escape_string($conn, $_POST['psw']);

        //username validation
        // checkUsername($username);
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $userExists = false;

        if ($result) {

            $usernames = mysqli_fetch_all($result, MYSQLI_ASSOC);

            foreach ($usernames as $un) {
                if (htmlspecialchars($un['username']) == htmlspecialchars($username)) {
                    $userExists = true;
                    $noInput = false;
                    break;
                }
            }

        } else {
            echo "error";
        }
        //save to db
        if (mysqli_query($conn, $sql)) {
            //$current_user = $username;  should be moved to signin page
            // header('Location: home.php');

        } else {
            echo 'query error: ' . mysqli_error($conn);
        }
    }
}


?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>

<body>
    <div class="gen-body-div">
        <h4 class="page-center-title">sign up</h4>
        <p></p>
        <form class="input_form" action="/shopaby/signup.php" class="white" method="POST">
            <label>username</label></label>
            <input type="text" name="username">
            <label>first name</label></label>
            <input type="text" name="first_name">
            <label>last name</label></label>
            <input type="text" name="last_name">
            <label>email</label></label>
            <input type="email" name="email">
            <label>password</label></label>
            <input type="password" name="psw">
            <div class="center">
                <input type="submit" name="submit" value="Create Account!" class="btn-brand z-depth-0">
            </div>
        </form>

        <!-- Displaying error if username already exists-->

        <?php if ($userExists == false): ?>
            <?php
            $sql = "INSERT INTO users
            ( username, first_name, last_name, email,psw ) 
            VALUES
            ('$username', '$first_name', '$last_name', '$email', '$psw')";

            $result = mysqli_query($conn, $sql);
            $currentUser = $username;
            $noInput = false;
            echo "<script> location.href='/shopaby/home.php'; </script>";
            //exit;

            ?>
        <?php else: ?>
            <?php if ($noInput == true): ?>
                <!-- Do nothing if first time loading page -->
            <?php else: ?>
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <strong> Error! </strong> Username is taken.
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>

<?php include('templates/footer.php'); ?>

</html>