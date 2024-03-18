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
        <a class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded" href="../../index.php">Retour Accueil Admin</a>
        <a class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded" href="./form.php">Créer Catégorie</a>
        <h1 class="text-3xl font-bold mt-5 mb-3">Catégories</h1>
        <table class="table-auto w-full text-left whitespace-no-wrap">
            <thead>
                <tr>
                    <th class="px-4 py-2">Nom</th>
                    <th class="px-4 py-2">Supprimer</th>
                    <th class="px-4 py-2">Modifier</th>
                    <th class="px-4 py-2">Ajouter Groupe</th>
                    <th class="px-4 py-2">Supprimer Groupe</th>
                    <th class="px-4 py-2">Ajouter Salon</th>
                    <th class="px-4 py-2">Supprimer Salon</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recordset as $row) {?>
                    <tr>
                        <td class="border px-4 py-2"><?= $row["category_name"];?></td>
                        <td class="border px-4 py-2"><a class="no-underline" href="delete.php?id=<?= $row["category_id"];?>" title="Supprimer le groupe">🗑</a></td>
                        <td class="border px-4 py-2"><a class="no-underline" href="form.php?id=<?= $row["category_id"];?>" title="Modifier le groupe">📝</a></td>
                        <td class="border px-4 py-2"><a class="no-underline" href="../groupXcategory/add-index.php?id=<?= $row["category_id"];?>" title="Ajouter groupe">➕</a></td>
                        <td class="border px-4 py-2"><a class="no-underline" href="../groupXcategory/delete-index.php?id=<?= $row["category_id"];?>" title="Supprimer groupe">➖</a></td>
                        <td class="border px-4 py-2"><a class="no-underline" href="../channel/form.php?cat_id=<?= $row["category_id"];?>" title="Ajouter salon">➕</a></td>
                        <td class="border px-4 py-2"><a class="no-underline" href="../channel/delete-index.php?cat_id=<?= $row["category_id"];?>" title="Supprimer salon">➖</a></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </main>
    <footer>

    </footer>
</body>

</html>