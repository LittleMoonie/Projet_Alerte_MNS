<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metz Numeric School</title>
    <!-- link to fontawesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
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
      @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@400;700&family=Alata&display=swap');
      
    </style>
</head>
<body class="bg-primary text-dark_surface_text font-paragraphs">
    <div class="h-screen">
        <header class="flex justify-between items-center pl-6 pr-6 bg-primary text-dark_surface_text">
            <!-- Image logo -->
            <div>
                <img class="size-16" src="../assets/img/Alerte_MNS_Logo.png" alt="MNS Logo">
            </div>
            <div class="flex space-x-2">
                <p class="font-bold text-xl">MENU</p>
                <button class="text-dark_surface_text">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </header>
        <!-- Main content -->
        <main class="text-center py-20" style="background-image: url(../assets/img/lightbulbs-hero.webp); background-size: cover;">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-5xl font-bold font-titles text-dark_surface_text uppercase mb-6">Metz Numeric School</h2>
                <p class="text-2xl font-titles text-secondary uppercase mb-6">Connectez, Communiquez, Collaborez Ensemble vers la Réussite</p>
                <button class="bg-main_button text-dark_surface_text w-380 h-80 rounded-header_button font-bold text-3xl p-2 mb-10 mt-80">Ouvrir</button>
                <p class="text-5xl font-logo font-bold text-secondary mb-4">MNS Alerte</p>
                <p class="text-5xl font-paragraphs text-dark_surface_text">Votre Allié Éducatif!</p>
            </div>
        </main>
    </div>

<!-- LES ATOUTS MNS Section -->
<section class="py-12 h-screen bg-subtle_highlight">
    <div class="text-center m-20">
        <h3 class="text-4xl font-bold font-titles text-primary">LES ATOUTS MNS</h3>
    </div>
    <div class="flex h-4/6 justify-center space-x-4">
        <!-- Repeat this block for each feature -->
        <div class="max-w-sm rounded-3xl overflow-hidden shadow-lg bg-primary text-light_surface_text p-4">
            <div class="px-6 py-4">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-users fa-3x text-secondary"></i>
                </div>
                <div class="font-bold text-secondary font-titles flex justify-center text-xl mb-2">Communauté</div>
                <p class="text-dark_surface_text text-base text-center flex justify-center">
                    Aidez-vous les uns les autres, partagez vos connaissances et développez votre réseau au sein de notre communauté.
                </p>
            </div>
        </div>
        <!-- ... other features ... -->
        <div class="max-w-sm rounded-3xl overflow-hidden shadow-lg bg-primary text-light_surface_text p-4">
            <div class="px-6 py-4">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-chalkboard-teacher fa-3x text-secondary"></i>
                </div>
                <div class="font-bold text-secondary font-titles flex justify-center text-xl mb-2">Enseignants</div>
                <p class="text-dark_surface_text text-base text-center flex justify-center">
                    Accédez à une éducation de qualité avec des formateurs experts et un apprentissage pratique.
                </p>
            </div>
        </div>
        <div class="max-w-sm rounded-3xl overflow-hidden shadow-lg bg-primary text-light_surface_text p-4">
            <div class="px-6 py-4">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-rocket fa-3x text-secondary"></i>
                </div>
                <div class="font-bold text-secondary font-titles flex justify-center text-xl mb-2">Innovation</div>
                <p class="text-dark_surface_text text-base text-center flex justify-center">
                    Créez des solutions aux problèmes réels avec une approche centrée sur l'innovation et la créativité.
                </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Comment ça Fonctionne Section -->
<section class="py-12 h-screen bg-primary">
    <div class="text-center mb-8">
        <h3 class="text-4xl font-bold font-titles text-primary">Comment ça Fonctionne</h3>
    </div>
    <div class="flex justify-center space-x-4">
        <!-- Repeat this block for each step -->
        <div class="max-w-sm rounded-3xl overflow-hidden shadow-lg bg-subtle_highlight text-light_surface_text p-4">
            <div class="px-6 py-4">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-user-plus fa-3x text-secondary"></i>
                </div>
                <div class="font-bold text-secondary font-titles flex justify-center text-xl mb-2">Créer Son Compte</div>
                <p class="text-light_surface_text text-base text-center flex justify-center">
                    Créez des solutions aux problèmes réels avec une approche centrée sur l'innovation et la créativité.
                </p>
                </div>
            </div>
        <!-- ... other steps ... -->
        <div class="max-w-sm rounded-3xl overflow-hidden shadow-lg bg-subtle_highlight text-light_surface_text p-4">
            <div class="px-6 py-4">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-comments fa-3x text-secondary"></i>
                </div>
                <div class="font-bold text-secondary font-titles flex justify-center text-xl mb-2">Conversationner</div>
                <p class="text-light_surface_text text-base text-center flex justify-center">
                Rejoigner des conversations avec vos camarades de classes n’a jaimais été plus facile.
                Que ce soit en groupe de classe ou en message privé.
                </p>
                </div>
            </div>

        <div class="max-w-sm rounded-3xl overflow-hidden shadow-lg bg-subtle_highlight text-light_surface_text p-4">
            <div class="px-6 py-4">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-share-alt fa-3x text-secondary"></i>
                </div>
                <div class="font-bold text-secondary font-titles flex justify-center text-xl mb-2">Partager & Collaborer</div>
                <p class="text-light_surface_text text-base text-center flex justify-center">
                    Partager des fichiers, collaborer sur des projets, et échanger des idées pour favoriser une culture d’apprentissage et d’innovation.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="py-12 h-2/6 bg-subtle_highlight">
    <div class="text-center mb-8">
        <h3 class="text-4xl font-bold font-titles text-primary">Dernières Mises à Jours</h3>
    </div>
    <div class="flex justify-center space-x-4">
        <!-- Repeat this block for each update -->
        <div class="max-w-sm rounded-3xl overflow-hidden shadow-lg bg-primary text-light_surface_text p-4">
            <div class="px-6 py-4">
                <div class="font-bold text-secondary text-xl mb-2">Nouvelle Fonctionnalité</div>
                <p class="text-base text-dark_surface_text">
                Nous avons déployé de nouveaux outils interactifs pour améliorer votre expérience d'apprentissage et d'enseignement.
                </p>
            </div>
            <div class="px-6 pt-4 pb-2">
                <span class="inline-block bg-secondary rounded-full px-3 py-1 text-sm font-semibold text-dark_surface_text mr-2 mb-2">En Savoir Plus</span>
            </div>
        </div>
        <!-- ... other updates ... -->
        <div class="max-w-sm rounded-3xl overflow-hidden shadow-lg bg-primary text-light_surface_text p-4">
            <div class="px-6 py-4">
                <div class="font-bold text-secondary text-xl mb-2">Évènements</div>
                <p class="text-base text-dark_surface_text pb-6">
                Rejoignez-nous pour le prochain hackathon virtuel et courez la chance de gagner des prix passionnants !
                </p>
            </div>
            <div class="px-6 pt-4 pb-2">
                <span class="inline-block bg-secondary rounded-full px-3 py-1 text-sm font-semibold text-dark_surface_text mr-2 mb-2">En Savoir Plus</span>
            </div>
        </div>
        <div class="max-w-sm rounded-3xl overflow-hidden shadow-lg bg-primary text-light_surface_text p-4">
            <div class="px-6 py-4">
                <div class="font-bold text-secondary text-xl mb-2">Maintenance</div>
                <p class="text-base text-dark_surface_text pb-6">
                Vous n’arrivez pas à vous connecter?
                Regarder ici pour voir si nous effectuons une maintenance.
                </p>
            </div>
            <div class="px-6 pt-4 pb-2">
                <span class="inline-block bg-secondary rounded-full px-3 py-1 text-sm font-semibold text-dark_surface_text mr-2 mb-2">En Savoir Plus</span>
            </div>
        </div>
    </div>
</section>

<!-- Footer Section -->
<footer class="bg-secondary text-light_surface_text p-6">
    <div class="flex flex-col md:flex-row justify-between items-center">
        <div class="mb-6 md:mb-0">
            <a href="#" class="text-2xl font-titles font-bold text-light_surface_text">MNS Alerte</a>
        </div>
        <div class="grid grid-cols-5 gap-8">
            <div class="text-center">
                <h5 class="underline underline-offset-4">MNS Accueil</h5>
            </div>
            <div class="text-center">
                <h5 class="underline underline-offset-4">Mentions légales</h5>
            </div>
            <div class="text-center">
                <h5 class="underline underline-offset-4">Politiques de protections des données</h5>
            </div>
            <div class="text-center">
                <h5 class="underline underline-offset-4">Contacter</h5>
            </div>
        </div>
    </div>
    <div class="flex justify-center mt-6 md:mt-5">
            <p class="text-sm">&copy; 2024 Copyright Metz Numeric School. Tous droits réservés. </p>
    </div>
</footer>

</body>
</html>
