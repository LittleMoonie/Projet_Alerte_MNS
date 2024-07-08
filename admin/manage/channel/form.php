<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/include/connect.php";

$channelId = 0;
$categoryId = 0;
$channelName = "";
$channelDesc = "";

if (isset($_GET['channel_id']) && $_GET['channel_id'] > 0) {
    $sql = "SELECT * FROM channel WHERE channel_id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([":id" => $_GET['channel_id']]);

    if ($row = $stmt->fetch()) {
        $channelId = htmlspecialchars($row['channel_id']);
        $channelName = htmlspecialchars($row['channel_name']);
        $channelDesc = htmlspecialchars($row['channel_description']);
    }
}

if (isset($_GET['cat_id']) && $_GET['cat_id'] > 0) {
    $categoryId = htmlspecialchars($_GET['cat_id']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back Office | Formulaire Salon</title>
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
        <a class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded" href="../category/index.php">Retour Accueil Catégorie</a>
        <h1 class="text-4xl font-bold text-primary mb-6 mt-5">Formulaire Salon</h1>
        <form action="process.php" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <input type="hidden" name="cat_id" value="<?= $categoryId ?>"/>
            <input type="hidden" name="channel_id" value="<?= $channelId ?>"/>
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="name" value="<?= $channelName ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"/>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <input type="text" name="description" value="<?= $channelDesc ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"/>
            </div>
            <div>
                <button type="submit" name="submit" class="bg-main_button hover:bg-primary text-white font-bold py-2 px-4 rounded">Enregistrer</button>
            </div>
        </form>
    </main>
</body>
</html>
