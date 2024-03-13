<?php require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";

$errorMsg = "";

if (isset($_POST['mail']) && isset($_POST['password'])) {
    $userMail = $_POST['mail'];
    $userPwd = $_POST['password'];

    $sql = "SELECT * FROM users 
        INNER JOIN userXgroup ON user_id = uxg_user_id 
        INNER JOIN user_group ON uxg_group_id = group_id
        WHERE user_mail = :mail AND group_name='admin'";
    
    $stmt = $db->prepare($sql);
    $stmt->execute([':mail'=>$userMail]);

    if($row=$stmt->fetch()) {
        if(password_verify($userPwd, $row['user_password'])) {
            session_start();
            $_SESSION['mySession'] = "042";
            $_SESSION['user_name'] = $row['user_mail'];

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
    <title>Alerte-MNS | login</title>
    <link rel="stylesheet" href="./css/all.css">
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