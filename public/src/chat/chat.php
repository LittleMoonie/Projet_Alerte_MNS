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

    <!-- Custom css -->
    <link rel="stylesheet" href="scss/style.css">

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
              'message_button': '10px'
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
<body class="bg-background_color">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="w-1/5 bg-primary text-dark_surface_text p-4 space-y-4">
            <div class="text-white text-lg font-bold mb-4">MNS</div>
            <div class="space-y-2">
                <!-- Sidebar items -->
                <div class="bg-secondary text-light_surface_text p-2 rounded">BSD 22/24</div>
                <!-- Add more sidebar items -->
            </div>
        </div>

        <!-- Chat section -->
        <div class="flex-1 flex flex-col bg-background_color">
            <!-- Chat header -->
            <div class="p-4 border-b border-subtle_highlight flex justify-between items-center">
                <div class="font-bold text-dark_surface_text"># BSD 22/24 | Général</div>
                <div class="space-x-2">
                    <!-- Header icons -->
                </div>
            </div>

            <!-- Messages area -->
            <div class="flex-1 overflow-y-auto p-4 space-y-4" style="max-height: calc(100vh - 4rem);">
                <!-- Message -->
                <div class="flex items-start space-x-2">
                    <img src="../assets/img/ugo_pfp.png" alt="Avatar" class="h-10 w-10 rounded-full mb-4">
                    <div>
                        <div class="text-dark_surface_text font-bold">Ugo Bretteil</div>
                        <p class="message bg-subtle_highlight text-light_surface_text rounded-message_button break-all p-2 max-w-96">Hey <span class="mention">@Lazaro</span>! aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaa</p>
                        <p class="text-subtle_highlight">11/11/1001 - 12:00</p>
                    </div>
                </div>
                <!-- Add more messages -->
                <div class="flex items-end space-x-2 justify-end">
                    <div>
                        <div class="text-dark_surface_text font-bold">Lazaro</div>
                        <p class="message bg-subtle_highlight text-light_surface_text rounded-message_button break-all p-2 max-w-96">Hey <span class="mention">@Ugo</span>!</p>
                        <p class="text-subtle_highlight">11/11/1001 - 12:00</p>
                    </div>
                    <img src="../assets/img/lazaro_pfp.gif" alt="Avatar" class="h-10 w-10 rounded-full mb-4">
                </div>
            </div>

            <!-- Message input -->
            <div class="border-t border-subtle_highlight p-4 flex items-center">
                <input type="text" placeholder="Write a message..." id="messageInput" class="flex-1 p-2 rounded border border-subtle_highlight mr-2">
                <div id="userList"></div>
                <button id="sendButton" class="bg-main_button text-light_surface_text px-4 py-2 rounded">Send</button>
            </div>
        </div>

        <!-- Right sidebar -->
        <div class="w-1/5 bg-primary text-dark_surface_text p-4 space-y-4">
            <div class="text-white text-lg font-bold mb-4">Intervenants</div>
            <div class="space-y-2">
                <!-- Right sidebar items -->
                <div class="text-light_surface_text p-2">User</div>
                <!-- Add more items -->
            </div>
        </div>
    </div>
</body>
<script src="js/main.js"></script>
</html>
