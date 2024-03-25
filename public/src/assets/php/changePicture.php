<?php include $_SERVER["DOCUMENT_ROOT"]."/public/src/chat/connection/protect.php"; 
require_once $_SERVER["DOCUMENT_ROOT"]."/public/src/chat/connection/connect.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changer photo de profil</title>
</head>
<body>
    <form action="processPicture.php" method="post" enctype="multipart/form-data">
        <label for="file">Fichier :</label>
        <input type="file" name="file" id="file" accept="image/png, image/jpeg, image/jpg, image/gif">

        <input type="submit" value="submit">
    </form>
</body>
</html>