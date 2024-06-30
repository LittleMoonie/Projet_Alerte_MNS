<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/include/connect.php";

$userLastname = "";
$userFirstname = "";
$userId = 0;

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $sql = "SELECT * FROM users u
            WHERE NOT EXISTS (
            SELECT 1
            FROM userxgroup uxg
            WHERE uxg.uxg_user_id = u.user_id
            AND uxg.uxg_group_id = :id)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $recordset = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back Office | Ajouter au groupe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;700&family=Alata&display=swap" rel="stylesheet">
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
<body class="bg-background_color text-dark_surface_text font-paragraphs">
    <main class="container mx-auto mt-4 px-4">
        <a class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded" href="../group/index.php">Retour Accueil Groupe</a>
        <h1 class="text-4xl font-bold text-primary mb-6 mt-5">Ajouter au groupe</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md">
                <thead>
                    <tr class="bg-primary text-white">
                        <th class="px-4 py-2">Nom</th>
                        <th class="px-4 py-2">Prénom</th>
                        <th class="px-4 py-2">Ajouter Utilisateur</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recordset as $row) { ?>
                        <tr class="hover:bg-subtle_highlight">
                            <td class="border-t px-4 py-2"><?= htmlspecialchars($row["user_lastname"]); ?></td>
                            <td class="border-t px-4 py-2"><?= htmlspecialchars($row["user_firstname"]); ?></td>
                            <td class="border-t px-4 py-2 text-center">
                                <a class="text-green-500 hover:text-green-700" href="add-process.php?group_id=<?= htmlspecialchars($_GET["id"]); ?>&user_id=<?= htmlspecialchars($row['user_id']) ?>" title="Ajouter au groupe">
                                    <i class="fas fa-user-plus"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
