<?php include $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$sql = "SELECT * FROM category ORDER BY category_name ASC";
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
</head>
<body>
    <header>
        
    </header>
    <main class="container">
        <a class="btn text-success" href="./form.php">Ajouter</a>
        <a class="btn" href="../../index.php">Retour Accueil Admin</a>
        <h1>Liste des catégories</h1>
        <table class="table table-striped">
            <caption>Liste des groupes</caption>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Supprimer</th>
                <th scope="col">Modifier</th>
                <th scope="col">Ajouter Groupe</th>
                <th scope="col">Supprimer Groupe</th>
                <th scope="col">Ajouter Salon</th>
                <th scope="col">Supprimer Salon</th>
            </tr>
            <?php foreach ($recordset as $row) {?>
                <tr>
                    <td><?= $row["category_name"];?></td>
                    <td><a style="text-decoration: none;" href="delete.php?id=<?= $row["category_id"];?>" title="Supprimer le groupe">🗑</a></td>
                    <td><a style="text-decoration: none;" href="form.php?id=<?= $row["category_id"];?>" title="Modifier le groupe">📝</a></td>
                    <td><a style="text-decoration: none;" href="../groupXcategory/add-index.php?id=<?= $row["category_id"];?>" title="Ajouter groupe">➕</a></td>
                    <td><a style="text-decoration: none;" href="../groupXcategory/delete-index.php?id=<?= $row["category_id"];?>" title="Supprimer groupe">➖</a></td>
                    <td><a style="text-decoration: none;" href="../channel/form.php?cat_id=<?= $row["category_id"];?>" title="Ajouter salon">➕</a></td>

                    <td><a style="text-decoration: none;" href="../channel/delete-index.php?id=<?= $row["category_id"];?>" title="Supprimer salon">➖</a></td>
                </tr>
            <?php }?>
        </table>
    </main>
    <footer>

    </footer>
</body>
<script src="https://cdn.tailwindcss.com%22%3E/"></script>
<script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              primary: '#151b35',
              secondary: '#C0480C',
              subtle_highlight: '#C9C9C9',
              background_color: '#E8E3DC',
              main_button: '#F05F16',
              light_surface_text: '#402A1A',
              dark_surface_text: '#F3F3F3'
            },
            fontFamily: {
              titles: ['Lexend', 'sans-serif'],
              paragraphs: ['Alata', 'sans-serif'],
              logo: ['MuseoModerno', 'sans-serif']
            },
            screens: {
              sm: '576px',
              md: '768px',
              lg: '992px',
              xl: '1200px'
            },
            borderRadius: {
              'header_button': '50px'
            },
            width: {
              '380': '380px'
            },
            height: {
              '80': '80px'
            }
          }
        }
      }
    </script>
</html>