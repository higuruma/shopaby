<?php 
include 'config/db_connect.php';


    //checking if the image was uploaded
    if(isset($_FILES['image']) && $_FILES['image']["error"] == 0)
    {
        $name = $_FILES['image']['name'];
        $type = $_FILES['image']['type'];
        $data = file_get_contents($_FILES['image']['tmp_name']);

        // connecting to database
        $pdo = new PDO('mysql:host=localhost;dbname=shopaby', $db_username, $db_password);

        $conn = $pdo->prepare("INSERT INTO images ( id, name, data) VALUES (?, ?, ?)");
        $conn->bindParam(1, $name);
        $conn->bindParam(2, $type);
        $conn->bindParam(3, $data);
        $conn->execute();
    }

?>

<!DOCTYPE html>

<!-- makes the form where the user can upload the image
 -->

<html>
    <form method="post" action="/shopaby/uploadImage.php" enctype="multipart/form-data">
        <input type="file" name="image" />
        <input type="submit" name="submit" value="Upload" />
</form>

</html>