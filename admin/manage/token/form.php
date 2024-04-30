<?php require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$tokenId = 0;
$tokenFirstname = "";
$tokenLastname = "";

if(isset($_GET['id']) && $_GET['id'] > 0) {
    $sql = "SELECT * FROM token WHERE token_id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([":id"=>$_GET['id']]);

    if($row = $stmt->fetch()) {
        $tokenId = $row['token_id'];
        $tokenFirstname = $row['token_firstname'];
        $tokenLastname = $row['token_lastname'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back Office | Formulaire</title>
</head>
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
<body>
    <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?=$tokenId?>"/>
        <br/>Utilisateur relié<br/>
        <br/>Prénom<br/>
        <input type="text" name="firstname" class="border border-gray-300" placeholder="Prénom" value="<?=$tokenFirstname?>"/>
        <br/>Nom<br/>
        <input type="text" name="lastname" class="border border-gray-300" placeholder="Nom" value="<?=$tokenLastname?>"/>
        <br/>Groupes à ajouter<br/>
        <?php 
        $sql = "SELECT * FROM user_group ORDER BY group_id ASC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $recordset = $stmt->fetchAll();
        
        foreach ($recordset as $row) {?>
            <div>
                <input type="checkbox" id="<?= $row['group_id']?>" name="token_group[]" value="<?= $row['group_id']?>"/>
                <label for="<?= $row['group_id']?>"><?= $row['group_name']?></label>
            </div>
        <?php }?>
        <input type="submit" name="submit" class="my-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"/>
    </form>
</body>
</html>