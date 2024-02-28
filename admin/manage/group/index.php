<?php include $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$sql = "SELECT * FROM table_user_group ORDER BY group_name ASC";
$stmt = $db->prepare($sql);
$stmt->execute();
$recordset = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back-Office | Liste des groupes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <header>
        
    </header>
    <main class="container">
        <a class="btn text-success" href="./form.php">Ajouter</a>
        <a class="btn" href="../../index.php">Retour Accueil Admin</a>
        <h1>Liste des groupes</h1>
        <table class="table table-striped">
            <caption>Liste des groupes</caption>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Supprimer</th>
                <th scope="col">Modifier</th>
                <th scope="col">Ajouter Utilisateur</th>
            </tr>
            <?php foreach ($recordset as $row) {?>
                <tr>
                    <td><?= $row["group_name"];?></td>
                    <td><a style="text-decoration: none;" href="delete.php?id=<?= $row["group_id"];?>" title="Supprimer le groupe">🗑</a></td>
                    <td><a style="text-decoration: none;" href="form.php?id=<?= $row["group_id"];?>" title="Modifier le groupe">📝</a></td>
                    <td><a style="text-decoration: none;" href="../userXgroup/index.php?id=<?= $row["group_id"];?>" title="Ajouter au groupe">➕</a></td>
                </tr>
            <?php }?>
        </table>
    </main>
    <footer>

    </footer>
</body>
</html>