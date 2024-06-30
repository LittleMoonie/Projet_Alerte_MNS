<?php include $_SERVER['DOCUMENT_ROOT']."/admin/include/protect.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerte-MNS | Admin</title>
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
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body class="bg-primary text-dark_surface_text font-paragraphs">
    <main class="container mx-auto mt-4 px-4 flex flex-col items-center">
        <div class="text-center mb-12">
            <h1 class="text-5xl font-titles text-secondary">Administration Alerte MNS</h1>
            <p class="text-xl font-titles text-dark_surface_text mt-4">Gérez les utilisateurs, les groupes et les catégories avec facilité</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <a class="max-w-sm rounded-3xl overflow-hidden shadow-lg bg-secondary text-light_surface_text p-6 flex flex-col items-center" href="./manage/user/index.php">
                <i class="fas fa-users fa-3x mb-4"></i>
                <div class="font-bold text-2xl mb-2">User Management</div>
                <p class="text-center">Gérez les utilisateurs de la plateforme, leurs rôles et permissions.</p>
            </a>
            <a class="max-w-sm rounded-3xl overflow-hidden shadow-lg bg-secondary text-light_surface_text p-6 flex flex-col items-center" href="./manage/group/index.php">
                <i class="fas fa-layer-group fa-3x mb-4"></i>
                <div class="font-bold text-2xl mb-2">Group Management</div>
                <p class="text-center">Organisez les utilisateurs en groupes pour une meilleure collaboration.</p>
            </a>
            <a class="max-w-sm rounded-3xl overflow-hidden shadow-lg bg-secondary text-light_surface_text p-6 flex flex-col items-center" href="./manage/category/index.php">
                <i class="fas fa-tags fa-3x mb-4"></i>
                <div class="font-bold text-2xl mb-2">Category Management</div>
                <p class="text-center">Créez et gérez les catégories pour organiser le contenu.</p>
            </a>
        </div>
    </main>
    <footer class="bg-secondary text-light_surface_text p-6 mt-12">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-6 md:mb-0">
                <a href="https://www.metz-numeric-school.fr/fr" class="text-2xl font-titles font-bold text-light_surface_text">MNS Alerte</a>
            </div>
            <div class="grid grid-cols-4 gap-8">
                <div class="text-center">
                    <a href="https://www.metz-numeric-school.fr/fr" class="underline underline-offset-4">MNS Accueil</a>
                </div>
                <div class="text-center">
                    <a hef="https://www.metz-numeric-school.fr/fr/mentions-legales" class="underline underline-offset-4">Mentions légales</a>
                </div>
                <div class="text-center">
                    <a href="https://www.metz-numeric-school.fr/fr/politique-de-donnees" class="underline underline-offset-4">Politiques de protections des données</a>
                </div>
                <div class="text-center">
                    <a href="https://www.metz-numeric-school.fr/fr/contact" class="underline underline-offset-4">Contacter</a>
                </div>
            </div>
        </div>
        <div class="flex justify-center mt-6">
            <p class="text-sm">&copy; 2024 Copyright Metz Numeric School. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>
