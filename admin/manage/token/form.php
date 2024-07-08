<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/include/connect.php";

$tokenId = 0;
$tokenFirstname = "";
$tokenLastname = "";

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $sql = "SELECT * FROM token WHERE token_id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute([":id" => htmlspecialchars($_GET['id'])]);

    if ($row = $stmt->fetch()) {
        $tokenId = htmlspecialchars($row['token_id']);
        $tokenFirstname = htmlspecialchars($row['token_firstname']);
        $tokenLastname = htmlspecialchars($row['token_lastname']);
    }
}

$sql = "SELECT * FROM user_group ORDER BY group_id ASC";
$stmt = $db->prepare($sql);
$stmt->execute();
$groupRecordset = $stmt->fetchAll();
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
                        message_button: "10px"
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
<body class="bg-background_color text-dark_surface_text">
    <div class="container mx-auto mt-4 px-4">
        <a class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded" href="../../index.php">Retour Accueil Admin</a>
        <h1 class="text-3xl font-bold mt-5 mb-3">Formulaire Token</h1>
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?= $tokenId ?>"/>
            <div class="mb-4">
                <label for="firstname" class="block text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" name="firstname" id="firstname" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="Prénom" value="<?= $tokenFirstname ?>" required/>
            </div>
            <div class="mb-4">
                <label for="lastname" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="lastname" id="lastname" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="Nom" value="<?= $tokenLastname ?>" required/>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Groupes à ajouter</label>
                <div class="border border-gray-300 max-h-32 overflow-y-scroll rounded-md p-2">
                    <?php foreach ($groupRecordset as $row) { ?>
                        <div class="flex items-center">
                            <input type="checkbox" id="<?= htmlspecialchars($row['group_id']) ?>" name="token_group[]" value="<?= htmlspecialchars($row['group_id']) ?>" class="mr-2"/>
                            <label for="<?= htmlspecialchars($row['group_id']) ?>"><?= htmlspecialchars($row['group_name']) ?></label>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <button type="submit" name="submit" class="w-full sm:w-auto px-5 py-2.5 text-center text-sm font-medium text-white bg-primary hover:bg-secondary rounded-lg focus:outline-none focus:ring-4 focus:ring-primary focus:ring-opacity-50">Submit</button>
        </form>
    </div>
</body>
</html>
