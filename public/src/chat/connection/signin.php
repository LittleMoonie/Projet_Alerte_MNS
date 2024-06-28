<?php
if(isset($_POST["mail"]) && isset($_POST["password"]) && isset($_POST["token"])) {
    $sql = "SELECT user_lastname FROM users WHERE user_mail=:mail";
    $stmt = $db->prepare($sql);
    $stmt->execute([":mail"=>$_POST['mail']]);

    if($row = $stmt->fetch()) {
        echo("alert('error mail already set')");
    }
    else {
        $sql = "SELECT * FROM token WHERE token_content=:token";
        $stmt = $db->prepare($sql);
        $stmt->execute([":token"=>$_POST['token']]);
        $row = $stmt->fetch();

        if($row && $row['token_use']) {
        if(!isset($_POST['picture'])) {
            $_POST['picture'] = 'none';
        }

        $sql = "INSERT INTO users (user_lastname, user_firstname, user_mail, user_password, user_picture) VALUES (:lastname, :firstname, :mail, :password, :picture)";
        $stmt = $db->prepare($sql);
        $stmt->execute([":lastname"=>$row['token_lastname'], ":firstname"=>$row['token_firstname'], ":mail"=>$_POST['mail'], ":password"=>password_hash($_POST['password']), ":picture"=>$_POST['picture']]);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription des users</h1>
    <form action="signin.php" method="POST" enctype="multipart/form-data">
        <label for="mail">Mail</label>
        <input type="email" name="mail" id="mail">

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">

        <label for="token">Token d'inscription</label>
        <input type="text" name="token" id="token">

        <label for="picture">Photo de profil</label>
        <input type="file" accept="image/png, image/jpeg, image/jpg, image/gif">

        <button type="submit">Valider</button>
    </form>
</body>
</html>