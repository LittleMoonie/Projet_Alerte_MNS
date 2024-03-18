<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$userLastname = "";
$userFirstname = "";
$userId = 0;

if(isset($_GET['id']) && $_GET['id'] > 0) {
    // $sql = "SELECT * FROM users LEFT JOIN userXgroup ON user_id = uxg_user_id WHERE (SELECT * FROM userxgroup WHERE uxg_group_id != :id) IS NULL GROUP BY user_id";
    // $sql = "SELECT * FROM users RIGHT JOIN userxgroup ON user_id = uxg_user_id WHERE user_id NOT IN  AND uxg_group_id != :id";
    // $sql = "SELECT * FROM users WHERE user_id NOT IN (SELECT uxg_user_id FROM userxgroup INNER JOIN user_group ON group_id = uxg_group_id WHERE uxg_group_id IS NOT NULL OR group_id=:id)";
    // $sql = "SELECT * FROM users LEFT JOIN userxgroup ON user_id = uxg_user_id LEFT JOIN user_group ON uxg_group_id = group_id WHERE uxg_group_id IS NULL OR group_id != :id";
    // $sql = "SELECT * FROM users INNER JOIN userxgroup WHERE uxg_group_id != :id GROUP BY user_id";
    $sql = "SELECT * FROM user_group";
    $stmt = $db->prepare($sql);

    // $stmt->bindParam(':id',$_GET['id']);

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
    <main class="container mx-auto mt-4 px-4">
        <a class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded" href="../category/index.php">Retour Accueil Catégorie</a>
        <h1 class="text-3xl font-bold mt-5 mb-3">Ajouter à la catégorie</h1>
        <table class="table-auto w-full text-left whitespace-no-wrap">
            <caption>Liste des groupes</caption>
            <tr>
                <th class="px-4 py-2">Nom</th>
                <th class="px-4 py-2">Ajouter Groupe</th>
            </tr>
            <?php foreach ($recordset as $row) {?>
                <tr>
                    <td class="border px-4 py-2"><?= $row["group_name"];?></td>
                    <td class="border px-4 py-2"><a class="no-underline" href="add-process.php?category_id=<?= $_GET["id"];?>&group_id=<?= $row['group_id']?>" title="Ajouter à la catégorie">➕</a></td>
                </tr>
            <?php }?>
        </table>
    </main>
</body>
</html>