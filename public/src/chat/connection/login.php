<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";

// Check if the user is already logged in
if (isset($_SESSION['mySession']) && $_SESSION['mySession'] == "042") {
    // Redirect the user to the chat page
    header("Location: /public/src/chat/chat.php");
    exit();
}

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

            header("Location:../chat.php");
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
    <title>Alerte-MNS | login</title>
</head>
<body>
    <form action="login.php" method="POST">
        <input type="mail" name="mail">
        <input type="password" name="password">
        <input type="submit" name="OK">
        <?php if($errorMsg != "") {?>
            <div class="danger">
                /!\ <?= $errorMsg;?>
            </div>
        <?php } ?>
    </form>
</body>
</html>