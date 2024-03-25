<?php include $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$sql = "SELECT * FROM users ORDER BY user_lastname ASC, user_firstname ASC";
$stmt = $db->prepare($sql);
$stmt->execute();
$recordset = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back-Office | Liste des users</title>
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
        <a class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded" href="./form.php">Créer Utilisateur</a>
        <h1 class="text-3xl font-bold mt-5 mb-3">Liste des users</h1>
        
        <table class="table-auto w-full text-left whitespace-no-wrap">
            <tr>
                <th class="px-4 py-2">Nom</th>
                <th class="px-4 py-2">Prénom</th>
                <th class="px-4 py-2">Mail</th>
                <th class="px-4 py-2">Supprimer</th>
                <th class="px-4 py-2">Modifier</th>
            </tr>
            <?php foreach ($recordset as $row) {?>
                <tr>
                    <td class="border px-4 py-2"><?= $row["user_lastname"];?></td>
                    <td class="border px-4 py-2"><?= $row["user_firstname"];?></td>
                    <td class="border px-4 py-2"><?= $row["user_mail"];?></td>
                    <td class="border px-4 py-2"><a class="no-underline" href="delete.php?id=<?= $row["user_id"];?>" title="Supprimer le user">🗑</a></td>
                    <td class="border px-4 py-2"><a class="no-underline" href="form.php?id=<?= $row["user_id"];?>" title="Modifier le user">📝</a></td>
                </tr>
            <?php }?>
        </table>
    </main>
    <footer>

    </footer>
</body>
</html>