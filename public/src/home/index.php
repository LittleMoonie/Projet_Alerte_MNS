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
    <!-- Custom CSS -->
    <link href="./css/style.css" rel="stylesheet">
    <link href="./css/output.css" rel="stylesheet">

    <style>
      @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@400;700&family=Alata&display=swap');
    </style>

<script src="https://cdn.tailwindcss.com"></script>


</head>
<body class="bg-primary text-dark_surface_text font-paragraphs">

        <!-- Section for full height hero image -->
        <section class="h-screen" style="background-image: url(../assets/images/MNS_Alerte_Hero3.png); background-size: cover; background-position: center; display: flex; flex-direction: column; justify-content: space-between;">
            <!-- Top content with added padding -->
            <div class="text-center pt-12">
                <h2 class="text-5xl font-bold font-titles text-dark_surface_text uppercase mb-4">Metz Numeric School</h2>
                <p class="text-2xl font-titles text-secondary uppercase mb-4">Connectez, Communiquez, Collaborez Ensemble vers la Réussite</p>
            </div>

            <!-- Middle content - Button with added padding for spacing -->
            <div class="text-center px-4 my-8">
                <a href="../chat/chat.php" class="bg-main_button text-dark_surface_text w-380 h-80 rounded-header_button font-bold text-3xl p-2">Ouvrir</a>
            </div>

            <!-- Bottom content with added padding -->
            <div class="text-center pb-20 px-4">
                <p class="text-5xl font-logo font-bold text-secondary mb-4">MNS Alerte</p>
                <p class="text-5xl font-paragraphs text-dark_surface_text">Votre Allié Éducatif!</p>
            </div>
        </section>

  <!-- LES ATOUTS MNS Section - Grid layout adjustment -->
  <section class="py-12 bg-subtle_highlight">
    <div class="text-center m-20">
      <h3 class="text-4xl font-bold font-titles text-secondary">LES ATOUTS MNS</h3>
    </div>
    <!-- ... LES ATOUTS MNS content ... -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 justify-items-center">
      <!-- Community Feature -->
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
      
      <!-- Teaching Feature -->
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
      
      <!-- Innovation Feature -->
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
</section>

<!-- How It Works Section - Grid layout adjustment -->
<section class="py-12 bg-primary">
  <!-- ... How It Works content ... -->
  <div class="text-center mb-8">
    <h3 class="text-4xl font-bold font-titles text-secondary">Comment ça Fonctionne</h3>
  </div>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 justify-items-center">
    <!-- Creating your account -->
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
    
    <!-- Conversate with your peers -->
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
    
    <!-- Share & Collaborate -->
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

<!-- Updates Section - Grid layout adjustment -->
<section class="py-12 bg-subtle_highlight">
  <!-- ... Updates content ... -->
  <div class="text-center mb-8">
    <h3 class="text-4xl font-bold font-titles text-secondary">Dernières Mises à Jours</h3>
  </div>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 justify-items-center">
    <!-- ... repeat for each update ... -->
    <!-- New Features -->
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
    
    <!-- Events -->
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
    
    <!-- Maintenance -->
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
    <div class="flex justify-center mt-6 md:mt-5">
            <p class="text-sm">&copy; 2024 Copyright Metz Numeric School. Tous droits réservés. </p>
    </div>
</footer>
</body>
</html>
