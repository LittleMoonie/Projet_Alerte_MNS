<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$userLastname = "";
$userFirstname = "";
$userId = 0;

if(isset($_GET['id']) && $_GET['id'] > 0) {
    $sql = "SELECT * FROM table_user";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $recordset = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back Office | Formulaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <a class="btn" href="../group/index.php">Retour Accueil Groupe</a>
    <h1>Ajouter au groupe</h1>
    <table class="table table-striped">
        <caption>Liste des utilisateurs</caption>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Ajouter Utilisateur</th>
        </tr>
        <?php foreach ($recordset as $row) {?>
            <tr>
                <td><?= $row["user_lastname"];?></td>
                <td><?= $row["user_firstname"];?></td>
                <td><a style="text-decoration: none;" href="add-process.php" title="Ajouter au groupe">➕</a></td>
            </tr>
        <?php }?>
    </table>
</body>
</html>