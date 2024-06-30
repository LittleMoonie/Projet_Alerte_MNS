<?php
include $_SERVER["DOCUMENT_ROOT"] . "/public/src/chat/connection/protect.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/include/connect.php";

// Fetch messages if a channel is selected
$messages = [];
if (isset($_GET['channel'])) {
    $sql = "SELECT * FROM message 
            INNER JOIN users ON user_id = message_sender_id 
            WHERE message_channel_id = :channel_id 
            ORDER BY message_timestamp ASC";
    $stmt = $db->prepare($sql);
    $stmt->execute([":channel_id" => $_GET['channel']]);
    $messages = $stmt->fetchAll();
}

// Fetch categories and channels the user belongs to
$sql = "SELECT category_name, channel_name, channel_id
        FROM category
        INNER JOIN groupxcategory ON category_id = gxc_category_id
        INNER JOIN userxgroup ON gxc_group_id = uxg_group_id
        INNER JOIN users ON uxg_user_id = user_id
        INNER JOIN channel ON category_id = channel_category_id
        WHERE user_mail = :userEmail 
        ORDER BY category_name ASC, channel_name ASC";
$stmt = $db->prepare($sql);
$stmt->execute([":userEmail" => $_SESSION['user_mail']]);
$recordset = $stmt->fetchAll();

$categories = [];
foreach ($recordset as $row) {
    $category = htmlspecialchars($row['category_name']);
    $channel = htmlspecialchars($row['channel_name']);
    $channelId = htmlspecialchars($row['channel_id']);
    
    if (!array_key_exists($category, $categories)) {
        $categories[$category] = [];
    }
    
    $categories[$category][$channelId] = $channel;
}

// Fetch users for right sidebar if a channel is selected
$userList = [];
if (isset($_GET['channel'])) {
    $sql = "SELECT user_lastname, user_firstname, user_id, user_picture, group_name
            FROM users
            INNER JOIN userxgroup ON user_id = uxg_user_id
            INNER JOIN user_group ON uxg_group_id = group_id
            INNER JOIN groupxcategory ON uxg_group_id = gxc_group_id
            INNER JOIN category ON gxc_category_id = category_id
            WHERE category_id = (SELECT channel_category_id FROM channel WHERE channel_id = :channel_id)
            ORDER BY group_name;";
    $stmt = $db->prepare($sql);
    $stmt->execute([":channel_id" => $_GET['channel']]);
    $userList = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metz Numeric School</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@400;700&family=Lexend:wght@400;700&family=Alata&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="../home/css/output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@emoji-mart/react/dist/emoji-mart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/giphy-api/1.2.2/giphy.min.js"></script>
</head>
<body class="bg-background_color flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <div class="w-1/5 bg-primary text-dark_surface_text p-4 flex flex-col justify-between" id="sidebar">
        <div>
            <div class="text-white text-lg font-bold mb-4">MNS</div>
            <div class="space-y-2">
                <!-- Sidebar items -->
                <?php 
                foreach ($categories as $category => $channels) {
                    echo "<div class='text-secondary text-lg font-bold block'>$category</div>";
                    foreach ($channels as $channelId => $channel) {
                        echo "<a href='?channel=$channelId' class='text-dark_surface_text hover:text-white block ml-4'>$channel</a>";
                    }
                }
                ?>
            </div>
        </div>
        <div>
            <a href="../setting/userProfile.php" class="text-dark_surface_text hover:text-white block mb-4">User Profile</a>
            <a href="../chat/connection/logout.php" class="bg-main_button text-light_surface_text px-4 py-2 rounded">Logout</a>
        </div>
    </div>

    <?php if (isset($_GET['channel'])) { ?>
    <!-- Chat section -->
    <div class="flex-1 flex flex-col bg-background_color">
        <!-- Chat header -->
        <div class="p-4 border-b border-subtle_highlight flex justify-between items-center">
            <div class="text-light_surface_text text-lg font-bold">
                <?php
                $sql = "SELECT channel_name, category_name 
                        FROM channel 
                        INNER JOIN category ON category_id = channel_category_id 
                        WHERE channel_id = :channel_id";
                $stmt = $db->prepare($sql);
                $stmt->execute([":channel_id" => $_GET['channel']]);
                $channelInfo = $stmt->fetch();
                echo "#" . htmlspecialchars($channelInfo['channel_name']) . " | " . htmlspecialchars($channelInfo['category_name']);
                ?>
            </div>
            <div class="space-x-2">
                <!-- Header icons (optional) -->
                <button id="toggleUserList" class="bg-main_button text-light_surface_text px-4 py-2 rounded">Toggle Users</button>
            </div>
        </div>

        <!-- Messages area -->
        <div id="messagesArea" class="flex-1 overflow-y-auto p-4 space-y-4" style="max-height: calc(100vh - 8rem);">
            <?php foreach ($messages as $message) {
                $timestamp = date("d/m/Y - H:i", strtotime($message['message_timestamp']));
                if ($message['message_sender_id'] == $_SESSION['userId']) { ?>
                    <div class="flex items-end space-x-2 justify-end">
                        <div class="text-left">
                            <div class="text-light_surface_text font-medium"><?= htmlspecialchars($message['user_firstname']) . " " . htmlspecialchars($message['user_lastname']) ?></div>
                            <p class="bg-subtle_highlight text-light_surface_text text-lg font-medium rounded-message_button break-all p-2 max-w-md"><?= htmlspecialchars($message['message_content']) ?></p>
                            <p class="text-light_surface_text font-normal text-xs"><?= $timestamp ?></p>
                        </div>
                        <img src="<?= '../../../upload/sm_' . htmlspecialchars($message['user_picture']) ?>" alt="Avatar" class="h-10 w-10 rounded-full mb-4">
                    </div>
                <?php } else { ?>
                    <div class="flex items-start space-x-2">
                        <img src="<?= '../../../upload/sm_' . htmlspecialchars($message['user_picture']) ?>" alt="Avatar" class="h-10 w-10 rounded-full mb-4">
                        <div class="text-left">
                            <div class="text-light_surface_text font-medium"><?= htmlspecialchars($message['user_firstname']) . " " . htmlspecialchars($message['user_lastname']) ?></div>
                            <p class="bg-subtle_highlight text-light_surface_text text-lg font-medium rounded-message_button break-all p-2 max-w-md"><?= htmlspecialchars($message['message_content']) ?></p>
                            <p class="text-light_surface_text font-normal text-xs"><?= $timestamp ?></p>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>

        <!-- Message input -->
        <div class="border-t border-subtle_highlight p-4 flex items-center space-x-2">
            <textarea id="messageInput" placeholder="Write a message..." maxlength="2000" 
                class="flex-1 p-2 rounded border border-subtle_highlight resize-none overflow-hidden 
                focus:outline-none focus:ring focus:border-blue-300 transition-all duration-300 ease-in-out"></textarea>
            <button id="emojiButton" class="bg-main_button text-light_surface_text px-4 py-2 rounded">😊</button>
            <button id="gifButton" class="bg-main_button text-light_surface_text px-4 py-2 rounded">GIF</button>
            <input type="file" id="fileInput" class="hidden">
            <button id="fileButton" class="bg-main_button text-light_surface_text px-4 py-2 rounded">📁</button>
            <button id="sendButton" class="bg-main_button text-light_surface_text px-4 py-2 rounded">Send</button>
        </div>
    </div>

    <!-- Right sidebar -->
    <div class="w-1/5 bg-primary text-dark_surface_text p-4 space-y-4" id="rightSidebar">
        <?php 
        $currentGroup = "";
        foreach ($userList as $user) {
            if ($currentGroup != htmlspecialchars($user['group_name'])) {
                echo "<div class='text-secondary text-lg font-bold capitalize mb-4'>" . htmlspecialchars($user['group_name']) . "</div>";
                $currentGroup = htmlspecialchars($user['group_name']);
            }
            echo "<div class='right-sidebar space-y-2 hover:cursor-pointer' data-userid='" . htmlspecialchars($user['user_id']) . "'>
                    <div class='flex items-center space-x-2'>
                        <img src='../../../upload/sm_" . htmlspecialchars($user['user_picture']) . "' alt='Avatar' class='h-8 w-8 rounded-full'>
                        <span>" . htmlspecialchars($user['user_firstname']) . " " . htmlspecialchars($user['user_lastname']) . "</span>
                    </div>
                  </div>";
        } ?>
    </div>

    <!-- User info popup -->
    <div id="userInfoPopup" class="fixed z-50 hidden p-4 bg-white shadow-lg rounded border border-subtle_highlight">
        <div id="popupContent"></div>
        <button id="closePopup" class="mt-2 px-4 py-2 bg-primary text-white rounded">Close</button>
    </div>
    <?php } ?>

    <!-- External JS file -->
    <script src="js/main.js"></script>
</body>
</html>
