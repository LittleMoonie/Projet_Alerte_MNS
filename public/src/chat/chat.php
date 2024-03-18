    <?php include $_SERVER["DOCUMENT_ROOT"]."/public/src/chat/connection/protect.php"; 
    require_once $_SERVER["DOCUMENT_ROOT"]."/public/src/chat/connection/connect.php";

    if (isset($_GET['channel'])) {
      $sql = "SELECT * FROM message WHERE message_channel_id = :channel_id";
      $stmt = $db->prepare($sql);
      $stmt->execute([":channel_id" => $_GET['channel']]);
      $messages = $stmt->fetchAll();
    }


    ?>
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
        <style>
          @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@400;700&family=Alata&display=swap');
          
        </style>
    </head>
    <body class="bg-background_color">
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <div class="w-1/5 bg-primary text-dark_surface_text p-4 space-y-4" id="sidebar">
                <div class="text-white text-lg font-bold mb-4">MNS</div>
                <div class="space-y-2">
                    <!-- Sidebar items -->
                    <?php 
                        // Fetch categories and channels the current user belongs to from the database
                        // $sql = "SELECT category_name, gxc_category_id, channel_name, channel_id, gxc_group_id
                        //         FROM category, channel, groupXcategory
                        //         WHERE category.category_id = groupXcategory.gxc_category_id
                        //         AND channel.channel_category_id = groupXcategory.gxc_category_id
                        //         AND group_id = (SELECT group_id FROM userXgroup WHERE uxg_user_id = (SELECT user_id FROM users WHERE user_mail = :userEmail))";

                        $sql = "SELECT category_name, channel_name, channel_id
                                FROM category
                                INNER JOIN groupxcategory ON category_id = gxc_category_id
                                INNER JOIN userxgroup ON gxc_group_id = uxg_group_id
                                INNER JOIN users ON uxg_user_id = user_id
                                INNER JOIN channel ON category_id = channel_category_id
                                WHERE user_mail = :userEmail ORDER BY category_name ASC, channel_name ASC";

                        $stmt = $db->prepare($sql);
                        $stmt->execute([":userEmail" => $_SESSION['user_mail']]);
                        $recordset = $stmt->fetchAll();

                        // Store categories and channels in an associative array
                        $categories = [];
                        foreach ($recordset as $row) {
                            $category = $row['category_name'];
                            $channel = $row['channel_name'];
                            $channelId = $row['channel_id'];
                            
                            // Create category array if it doesn't exist
                            if (!array_key_exists($category, $categories)) {
                                $categories[$category] = [];
                            }
                            
                            // Add channel to the category array
                            $categories[$category][$channelId] = $channel;
                        }

                        // Generate sidebar items dynamically for each category and channel
                        foreach ($categories as $category => $channels) {
                            echo "<div class='text-secondary text-lg font-bold block'>$category</div>";
                            foreach ($channels as $channelId => $channel) {
                                echo "<a href='?channel=$channelId' class='text-light_surface_text hover:text-white block ms-4'>$channel</a>";
                            }
                        }
                      ?>
                    <!-- Add more sidebar items -->
                </div>
            </div>

            <?php if (isset($_GET['channel'])) { ?>
            <!-- Chat section -->
            <div class="flex-1 flex flex-col bg-background_color">
                <!-- Chat header -->
                  <div class="p-4 border-b border-subtle_highlight flex justify-between items-center">
                      <div class="text-light_surface_text text-lg font-bold"># BSD 22/24 | Général</div>
                      <div class="space-x-2">
                          <!-- Header icons -->
                      </div>
                  </div>

                  <?php foreach ($messages as $message) {
                    if ($message['message_sender_id'] == $_SESSION['userId']) {
                    ?>
                      <div id="messagesArea" class="flex-1 overflow-y-auto p-4 space-y-4" style="max-height: calc(100vh - 4rem);">
                      <!-- Message -->
                      <div class="flex items-start space-x-2">
                          <img src="../assets/img/ugo_pfp.png" alt="Avatar" class="h-10 w-10 rounded-full mb-4">
                          <div class="text-left">
                              <div class="text-light_surface_text font-medium"><?= $message['message_sender_id']?></div>
                              <p class="bg-subtle_highlight text-light_surface_text text-lg font-medium rounded-message_button break-all p-2 max-w-md"><?= $message['message_content']?></p>
                              <p class="text-light_surface_text font-normal text-xs"><?= $message['message_timestamp']?></p>
                          </div>
                      </div>
                    <?php }
                    else { ?>
                      <div class="flex items-end space-x-2 justify-end">
                        <div class="text-left">
                                <div class="text-light_surface_text font-medium"><?= $message['message_sender_id']?></div>
                                <p class="bg-subtle_highlight text-light_surface_text text-lg font-medium rounded-message_button break-all p-2 max-w-md"><?= $message['message_content']?></p>
                                <p class="text-light_surface_text font-normal text-xs"><?= $message['message_timestamp']?></p>
                            </div>
                            <img src="../assets/img/lazaro_pfp.gif" alt="Avatar" class="h-10 w-10 rounded-full mb-4">
                        </div>
                      </div>
                    <?php }
                  }
                  ?>

                  <!-- Messages area -->
                  <!-- <div id="messagesArea" class="flex-1 overflow-y-auto p-4 space-y-4" style="max-height: calc(100vh - 4rem);">
                      Message
                      <div class="flex items-start space-x-2">
                          <img src="../assets/img/ugo_pfp.png" alt="Avatar" class="h-10 w-10 rounded-full mb-4">
                          <div class="text-left">
                              <div class="text-light_surface_text font-medium">Ugo Bretteil</div>
                              <p class="bg-subtle_highlight text-light_surface_text text-lg font-medium rounded-message_button break-all p-2 max-w-md">Hey <span class="mention">@Lazaro</span>! aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaa</p>
                              <p class="text-light_surface_text font-normal text-xs">11/11/1001 - 12:00am</p>
                          </div>
                      </div>
                      Response
                      <div class="flex items-end space-x-2 justify-end">
                      <div class="text-left">
                              <div class="text-light_surface_text font-medium">Lazaro</div>
                              <p class="bg-subtle_highlight text-light_surface_text text-lg font-medium rounded-message_button break-all p-2 max-w-md">Hey <span class="mention">@Ugo</span>!</p>
                              <p class="text-light_surface_text font-normal text-xs">11/11/1001 - 12:00am</p>
                          </div>
                          <img src="../assets/img/lazaro_pfp.gif" alt="Avatar" class="h-10 w-10 rounded-full mb-4">
                      </div>
                      Add more messages
                  </div> -->

                  <!-- Message input -->
                  <div class="border-t border-subtle_highlight p-4 flex items-center">
                      <textarea id="messageInput" placeholder="Message..." maxlength="2000" 
                          class="flex-1 p-2 rounded border border-subtle_highlight mr-2 resize-none overflow-hidden 
                          focus:outline-none focus:ring focus:border-blue-300 transition-all duration-300 ease-in-out"></textarea>
                      <div id="userList" class="absolute z-10 w-full bg-white border rounded shadow-lg hidden"></div>
                      <button id="sendButton" class="bg-main_button text-light_surface_text px-4 py-2 rounded">Send</button>
                  </div>
                  
            </div>

            <!-- Right sidebar -->
            <?php 
              // $sql = "SELECT u.user_name, g.group_name
              //         FROM users u
              //         INNER JOIN userxgroup uxg ON u.user_id = uxg.uxg_user_id
              //         INNER JOIN groupxcategory gxc ON uxg.uxg_group_id = gxc.gxc_group_id
              //         INNER JOIN category c ON gxc.gxc_category_id = c.category_id
              //         WHERE c.category_id = :cat_id
              //         ORDER BY g.group_name;";

              // $stmt = $db->prepare($sql);
              // $stmt->execute([":cat_id" => $$_GET['cat_id']]);
              // $recordset = $stmt->fetchAll();
            ?>
            
            <div class="w-1/5 bg-primary text-dark_surface_text p-4 space-y-4">
                <div class="text-secondary text-lg font-bold mb-4">Intervenants</div>
                <div class="right-sidebar space-y-2">
                    <!-- Users would go here but are imported via class / db -->
                </div>
            </div>
        </div>
        <?php } ?>

        <!-- Logout -->
        <a href="../chat/connection/logout.php" class="fixed bottom-4 right-4 bg-main_button text-light_surface_text px-4 py-2 rounded">Logout</a>
    </body>
    <script src="js/main.js"></script>
    <script src="js/websocket.js"></script>
    </html>
