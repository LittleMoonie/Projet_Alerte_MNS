<?php include $_SERVER["DOCUMENT_ROOT"]."/public/src/chat/connection/protect.php"; 
require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";
if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
    $firstName = filter_var($_POST['firstName']);
    $lastName = filter_var($_POST['lastName']);

    $sql = "UPDATE users SET user_firstname = :firstName, user_lastname = :lastName WHERE user_id = :userId";
    $stmt = $db->prepare($sql);
    $stmt->execute([':firstName' => $firstName, ':lastName' => $lastName, ':userId' => $userId]);

    if ($stmt->rowCount()) {
        // Redirect back with success message
        header('Location: userProfile.php?update=success');
    } else {
        // Handle error
    }
}

if (isset($_POST['email']) && isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $sql = "UPDATE users SET user_mail = :email WHERE user_id = :userId";
    $stmt = $db->prepare($sql);
    $stmt->execute([':email' => $email, ':userId' => $userId]);

    if ($stmt->rowCount()) {
        // Redirect back with success message
        header('Location: userProfile.php?update=success');
    } else {
        // Handle error
    }
}

if (isset($_POST['currentPassword']) && isset($_POST['newPassword']) && isset($_POST['confirmNewPassword']) && isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
    $currentPassword = filter_var($_POST['currentPassword']);
    $newPassword = filter_var($_POST['newPassword']);
    $confirmNewPassword = filter_var($_POST['confirmNewPassword']);

    // Check if new password and confirm new password match
    if ($newPassword !== $confirmNewPassword) {
        // Handle error
    }
    // Check if new password is the same as the current password
    else{


        $sql = "SELECT user_password FROM users WHERE user_id = :userId";
        $stmt = $db->prepare($sql);
        $stmt->execute([':userId' => $userId]);
        $user = $stmt->fetch();

        // Verify current password is equal to the password in the database
        if (password_verify($currentPassword, $user['user_password'])) {
            echo "<script>alert('Correct password!');</script>";
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $sql = "UPDATE users SET user_password = :password WHERE user_id = :userId";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':userId' , $userId);
            $stmt->execute();

                // Redirect back with success message
                header('Location: userProfile.php?update=success');
        }
        // Check if the current password is incorrect
        else{
            echo "<script>alert('Incorrect password!');</script>";
        }
    }

}

$userId = $_SESSION['userId'];
$sql = "SELECT user_firstname, user_lastname, user_mail, user_password, user_picture FROM users WHERE user_id = :userId";
$stmt = $db->prepare($sql);
$stmt->execute([':userId' => $userId]);
$recordset = $stmt->fetch();

$displayName = $recordset['user_firstname'] . ' ' . $recordset['user_lastname'];
$userEmail = $recordset['user_mail'];
$maskedPassword = str_repeat('*', 12);
$userPicture = $recordset['user_picture'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link href="../home/css/output.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@400;700&family=Alata&display=swap');
    </style>
</head>

<body class="bg-background_color text-light_surface_text font-paragraphs">
    <div class="flex h-screen overflow-hidden">
        <!-- Left Sidebar -->
        <div class="w-1/5 bg-primary p-4 flex flex-col justify-between h-full">
            <div>
                <div class="mb-6">
                    <!-- Get image path from db -->
                    <?php
            $sql = "SELECT user_firstname, user_lastname, user_mail, user_id FROM users WHERE user_id = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute([":id" => $_SESSION['userId']]);
            $recordset = $stmt->fetch();
            ?>
                    <img src="<?= htmlspecialchars("../../../upload/lg_".$userPicture) ?>" alt="User Profile" class="w-24 h-24 mx-auto rounded-full">
                </div>
                <div class="flex flex-col space-y-4">
                    <a href="#" data-target="profileSection" class="sidebar-link text-secondary hover:text-white p-2 rounded transition duration-300 ease-in-out">Mon Compte</a>
                    <a href="#" data-target="notificationsSettingsSection" class="sidebar-link text-secondary hover:text-white p-2 rounded transition duration-300 ease-in-out">Notifications</a>
                    <a href="#" data-target="whatsNewSection" class="sidebar-link text-secondary hover:text-white p-2 rounded transition duration-300 ease-in-out">Nouveautés</a>
                </div>
            </div>
            <!-- Space for separation, ensuring items are at the bottom -->
            <div>
                <hr class="my-4 border-2 border-orange-500">
                <div class="grid grid-cols-2 gap-2">
                    <a href="../chat/chat.php" class="sidebar-link text-secondary hover:text-white p-2 rounded transition duration-300 ease-in-out flex justify-center items-center">Retour au Chat</a>
                    <a href="#" class="logout-link text-secondary hover:text-white p-2 rounded transition duration-300 ease-in-out flex justify-center items-center">Déconnexion</a>
                </div>
            </div>
        </div>



        <!-- Logout Confirmation Modal -->
        <div id="logoutModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="mb-4 text-lg font-bold">Are you sure you want to log out?</h3>
                <div class="flex justify-center">
                    <button id="confirmLogout" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 mr-2">Log Out</button>
                    <button id="cancelLogout" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">Cancel</button>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="bg-subtle_highlight flex-1 p-4" id="mainContent">
            <!-- Profile Section (Initially Visible) -->
            <div id="profileSection" class="content-section">
                <div class="bg-white shadow rounded-lg p-6 flex">
                    <!-- Profile Content -->
                    <div class="flex-none">
                        <!-- User image from the database -->
                        <div class="profile-picture-container mx-auto">
                            <img src="<?= htmlspecialchars("../../../upload/md_".$userPicture) ?>" alt="User Profile" class="profile-picture">
                            <!-- Form for image upload -->
                            <form action="../assets/php/processPicture.php" method="post" enctype="multipart/form-data">
                                <input type="file" name="file" id="fileInput" onchange="this.form.submit();" accept="image/png, image/jpeg, image/jpg, image/gif" class="hidden">
                                <label for="fileInput" class="overlay  text-secondary">Changer</label>
                            </form>
                        </div>

                    </div>
                    <!-- User Information Section -->
                    <div class="ml-4 flex-grow border-l-2 border-solid pl-4">
                        <h1 class="text-2xl font-bold mb-4">Profil Utilisateur</h1>

                        <!-- Display Name -->
                        <div class="mb-4">
                            <label class="font-semibold">Nom d'affichage:</label>
                            <div class="flex justify-between items-center">
                                <p><?= htmlspecialchars($displayName)?></p>
                                <button id="updateDisplayNameBtn" class="edit-btn text-secondary hover:underline" data-target="editDisplayNameModal">Modifier</button>
                            </div>
                        </div>
                        <!-- Edit Display Name Modal -->
                        <div id="editDisplayNameModal" class="modal hidden <?= (isset($_GET['edit']) && $_GET['edit'] == 'displayName') ? '' : 'hidden'; ?> absolute inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center p-4">
                            <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-8">
                                <form action="userProfile.php" method="POST" class="space-y-4">
                                    <div>
                                        <label for="firstName" class="block text-sm font-medium text-gray-700">First Name</label>
                                        <input type="text" name="firstName" id="firstName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="First Name" value="<?= htmlspecialchars($recordset['user_firstname']); ?>" required>
                                    </div>
                                    <div>
                                        <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name</label>
                                        <input type="text" name="lastName" id="lastName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Last Name" value="<?= htmlspecialchars($recordset['user_lastname']); ?>" required>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="submit" class="px-6 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <hr />
                        <br />

                        <!-- Email -->
                        <div class="mb-4">
                            <label class="font-semibold">Email:</label>
                            <div class="flex justify-between items-center">
                                <p><?= $userEmail ?></p>
                                <button id="updateEmailBtn" class="edit-btn text-secondary hover:underline" data-target="editEmailModal">Modifier</button>
                            </div>
                        </div>
                        <!-- Edit Email Modal -->
                        <div id="editEmailModal" class="modal hidden <?= (isset($_GET['edit']) && $_GET['edit'] == 'email') ? '' : 'hidden'; ?> absolute inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center p-4">
                            <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-8">
                                <form action="userProfile.php" method="POST" class="space-y-4">
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?= htmlspecialchars($recordset['user_mail']); ?>" required>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="submit" class="px-6 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <hr />
                        <br />

                        <!-- Password -->
                        <div class="mb-4">
                            <label class="font-semibold">Mot de passe:</label>
                            <div class="flex justify-between items-center">
                                <p><?= htmlspecialchars($maskedPassword); ?></p>
                                <button id="updatePasswordBtn" class="edit-btn text-secondary hover:underline" data-target="editPasswordModal">Modifier</button>
                            </div>
                        </div>
                        <!-- Edit Password Modal -->
                        <div id="editPasswordModal" class="modal hidden <?= (isset($_GET['edit']) && $_GET['edit'] == 'password') ? '' : 'hidden'; ?> absolute inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center p-4">
                            <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-8">
                                <form action="userProfile.php" method="POST" class="space-y-4">
                                    <div>
                                        <label for="currentPassword" class="block text-sm font-medium text-gray-700">Current Password</label>
                                        <input type="password" name="currentPassword" id="currentPassword" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Current Password" required>
                                    </div>
                                    <div>
                                        <label for="newPassword" class="block text-sm font-medium text-gray-700">New Password</label>
                                        <input type="password" name="newPassword" id="newPassword" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                    </div>
                                    <div>
                                        <label for="confirmNewPassword" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                                        <input type="password" name="confirmNewPassword" id="confirmNewPassword" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Confirm New Password" required>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="submit" class="px-6 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr />
                        <br />
                    </div>
                </div>
            </div>

            <!-- Notifications Settings Section -->
            <div id="notificationsSettingsSection" class="content-section hidden bg-white shadow rounded-lg p-6 flex flex-col">
                <h2 class="text-2xl font-bold mb-4">Notification Settings</h2>

                <!-- DM Toggle -->
                <div class="mb-4">
                    <label class="flex justify-between items-center font-semibold">
                        <span>Direct Messages</span>
                        <div class="relative">
                            <input type="checkbox" class="toggle-checkbox">
                        </div>
                    </label>
                </div>

                <!-- Channel Messages Toggle -->
                <div class="mb-4">
                    <label class="flex justify-between items-center font-semibold">
                        <span>Channel Messages</span>
                        <div class="relative">
                            <input type="checkbox" class="toggle-checkbox">
                        </div>
                    </label>
                </div>

                <!-- Announcements Toggle -->
                <div class="mb-4">
                    <label class="flex justify-between items-center font-semibold">
                        <span>Announcements</span>
                        <div class="relative">
                            <input type="checkbox" class="toggle-checkbox">
                        </div>
                    </label>
                </div>
            </div>


            <!-- What's New Section -->
            <div id="whatsNewSection" class="content-section hidden bg-white shadow rounded-lg p-6 flex flex-col">
                <h2 class="text-2xl font-bold mb-4">What's New</h2>
                <div>
                    <h3 class="text-xl font-semibold mb-2">Enhanced User Profile</h3>
                    <p>As part of our latest updates, we've introduced an enhanced user profile section. Here's what you can look forward to:</p>
                    <ul class="list-disc pl-5 mt-2">
                        <li>Improved layout and design for easier navigation.</li>
                        <li>Additional customization options for your personal profile.</li>
                        <li>Increased security settings, giving you more control over your account.</li>
                        <li><strong>Easter Egg:</strong> This whole user profile section is what's new – explore and enjoy the enhancements!</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="./js/format.js"></script>

</html>