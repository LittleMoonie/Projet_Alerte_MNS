<?php include $_SERVER['DOCUMENT_ROOT']."/admin/include/protect.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerte-MNS | Admin</title>
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
        <span class="text-4xl">Administration alerte MNS</span>
        <div class="m-4">
            <a class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded me-2" href="./manage/user/index.php">User Management</a>
            <a class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded me-2" href="./manage/group/index.php">Group Management</a>
            <a class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded me-2" href="./manage/category/index.php">Category Management</a>
        </div>
    </main>
</body>
</html>