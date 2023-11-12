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

         $stmt = $pdo->prepare("INSERT INTO images (name, type, data) VALUES (?, ?, ?)");
         $stmt->bindParam(1, $name);
         $stmt->bindParam(2, $type);
         $stmt->bindParam(3, $data);
         $stmt->execute();
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

