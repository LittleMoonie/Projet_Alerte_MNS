<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";

$errorMsg = "";

if (isset($_POST['mail']) && isset($_POST['password'])) {
    $userMail = $_POST['mail'];
    $userPwd = $_POST['password'];

    $sql = "SELECT * FROM users WHERE user_mail = :mail";
    
    $stmt = $db->prepare($sql);
    $stmt->execute([':mail'=>$userMail]);

    if($row=$stmt->fetch()) {
        if(password_verify($userPwd, $row['user_password'])) {
            session_start();
            $_SESSION['mySession'] = "042";
            $_SESSION['user_mail'] = $userMail;
            $_SESSION['userId'] = $row['user_id'];

            header("Location:index.php");
            exit();
        }
        else {
            $errorMsg = "Password is incorrect!";
        }
    }
    else {
        $errorMsg = "Identifiant introuvable";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerte-MNS | Login</title>

    <link href="../public/src/home/css/output.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@400;700&family=Alata&display=swap');
    </style>
</head>
<body class="flex flex-col items-center justify-center h-screen bg-primary">
    <!-- Title above the form -->
    <div class="mb-8">
        <h1 class="text-5xl font-logo font-bold text-secondary">MNS Alerte Login</h1>
    </div>

    <!-- Login form -->
    <form action="login.php" method="POST" class="p-10 bg-white rounded-lg shadow-xl">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Login</h2>
        <div class="mb-4">
            <label for="mail" class="block text-gray-700">Email</label>
            <input type="email" name="mail" id="mail" placeholder="Ton mail" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-indigo-300">
        </div>
        <div class="mb-6">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="password" placeholder="Ton mot de passe" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-indigo-300">
        </div>
        <div class="mb-6">
            <input type="submit" value="Login" class="w-full px-3 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 cursor-pointer">
        </div>
        <?php if($errorMsg != ""): ?>
            <div class="danger p-3 rounded-lg bg-red-100 border border-red-400 text-red-700">
                /!\ <?= htmlspecialchars($errorMsg); ?>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>
