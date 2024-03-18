<?php include $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

if(isset($_GET['cat_id']) && $_GET['cat_id'] > 0) {
    $sql = "SELECT * FROM channel WHERE channel_category_id=:cat_id ORDER BY channel_name ASC";
    $stmt = $db->prepare($sql);
    $stmt-> bindParam('cat_id', $_GET['cat_id']);
    $stmt->execute();
    $recordset = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back-Office | Liste des salons</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
</head>
<body>
    <header>
        
    </header>
    <main class="container mx-auto mt-4 px-4">
        <a class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded" href="../category/index.php">Retour Accueil Catégorie</a>
        <a class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded" href="./form.php">Créer Salon</a>
        <h1 class="text-3xl font-bold mt-5 mb-3">Liste des salons</h1>
        <table class="table-auto w-full text-left whitespace-no-wrap">
            <tr>
                <th class="px-4 py-2">Nom</th>
                <th class="px-4 py-2">Modifier</th>
                <th class="px-4 py-2">Supprimer</th>
            </tr>
            <?php foreach ($recordset as $row) {?>
                <tr>
                    <td class="border px-4 py-2"><?= $row["channel_name"];?></td>
                    <td class="border px-4 py-2"><a class="no-underline" href="form.php?channel_id=<?= $row["channel_id"];?>&cat_id=<?= $row["channel_category_id"];?>" title="Modifier le salon">📝</a></td>
                    <td class="border px-4 py-2"><a class="no-underline" href="delete.php?channel_id=<?= $row["channel_id"];?>" title="Supprimer de la categorie">➖</a></td>
                </tr>
            <?php }?>
        </table>
    </main>
    <footer>

    </footer>
</body>
</html>