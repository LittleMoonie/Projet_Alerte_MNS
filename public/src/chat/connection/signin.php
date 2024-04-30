<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription des users</h1>
    <form action="process-signin.php" enctype="multipart/form-data">
        <label for="mail">Mail</label>
        <input type="email" name="mail" id="mail">

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">

        <label for="picture">Photo de profil</label>
        <input type="file" accept="image/png, image/jpeg, image/jpg, image/gif">
    </form>
</body>
</html>