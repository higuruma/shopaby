<?php
    include 'db_connect.php'
    // connecting to db

    $pdo = new PDO('mysql:host=localhost;dbname=shopaby', $db_username, $db_password);

    // getting image form db
    $stmt = $pdo->prepare("SELECT naem, type data FROM images WHERE id=?");
    $stmt->bindParam(1, $id);
    $stmt->execure();

    header("Content-Type: image/jpeg");
    // output image
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $row['data'];
?>

<DOCTYPE html>
    <html>
    <img src="display.php?id=1" />


    </html>