<?php include $_SERVER['DOCUMENT_ROOT']."/admin/include/protect.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Alerte-MNS | Admin</title>
</head>
<body>
    <h1>Bienvenue <?= $_SESSION['user_name'];?></h1>
    <!-- <?php
    if (isset($_SESSION['mySession'])) {
        echo $_SESSION['mySession']; 
    }
    ?> -->
    <a class="btn btn-primary active" href="./manage/user/index.php">User Management</a>
    <a class="btn btn-primary active" href="./manage/group/index.php">Group Management</a>
</body>
</html>