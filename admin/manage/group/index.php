<?php include $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$sql = "SELECT * FROM user_group ORDER BY group_name ASC";
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
        <div class="flex justify-between items-center mb-6">
            <a class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded" href="../../index.php">Retour Accueil Admin</a>
            <a class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded" href="./form.php">Créer Un Groupe</a>
        </div>
        <h1 class="text-4xl font-bold text-primary mb-6">Groupes</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md">
                <thead>
                    <tr class="bg-primary text-white">
                        <th class="px-4 py-2">Nom</th>
                        <th class="px-4 py-2">Supprimer</th>
                        <th class="px-4 py-2">Modifier</th>
                        <th class="px-4 py-2">Ajouter Utilisateur</th>
                        <th class="px-4 py-2">Supprimer Utilisateur</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recordset as $row) {?>
                        <tr class="hover:bg-subtle_highlight">
                            <td class="border-t px-4 py-2"><?= $row["group_name"];?></td>
                            <td class="border-t px-4 py-2 text-center">
                                <a class="text-red-500 hover:text-red-700" href="delete.php?id=<?= $row["group_id"];?>" title="Supprimer le groupe">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                            <td class="border-t px-4 py-2 text-center">
                                <a class="text-blue-500 hover:text-blue-700" href="form.php?id=<?= $row["group_id"];?>" title="Modifier le groupe">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td class="border-t px-4 py-2 text-center">
                                <a class="text-green-500 hover:text-green-700" href="../userXgroup/add-index.php?id=<?= $row["group_id"];?>" title="Ajouter au groupe">
                                    <i class="fas fa-user-plus"></i>
                                </a>
                            </td>
                            <td class="border-t px-4 py-2 text-center">
                                <a class="text-yellow-500 hover:text-yellow-700" href="../userXgroup/delete-index.php?id=<?= $row["group_id"];?>" title="Supprimer du groupe">
                                    <i class="fas fa-user-minus"></i>
                                </a>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
