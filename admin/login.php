<?php require_once $_SERVER['DOCUMENT_ROOT']."/admin/include/connect.php";

$errorMsg = "";

if (isset($_POST['login']) && isset($_POST['password'])) {
    $userLogin = $_POST['login'];
    $userPwd = $_POST['password'];

    $sql = "SELECT * FROM table_admin WHERE admin_login = :login";
    $stmt = $db->prepare($sql);
    $stmt->execute([':login'=>$userLogin]);

    if($row=$stmt->fetch()) {
        if(password_verify($userPwd, $row['admin_password'])) {
            session_start();
            $_SESSION['mySession'] = "042";
            $_SESSION['user_name'] = $row['admin_login'];

            header("Location:index.php");
            exit();
        }
        else {
            $errorMsg = "mot de passe inccorect";
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
    <title>bdshop | login</title>
    <link rel="stylesheet" href="./css/all.css">
</head>
<body>
    <form action="login.php" method="POST">
        <input type="text" name="login">
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