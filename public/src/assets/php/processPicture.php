<?php include $_SERVER["DOCUMENT_ROOT"]."/public/src/chat/connection/protect.php"; 
require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

$sql = "SELECT user_lastname, user_id FROM users WHERE user_id = :id";
$stmt = $db->prepare($sql);
$stmt->execute([":id" => $_SESSION['userId']]);
$recordset = $stmt->fetch();

function generateFileName($str, $ext, $uploadPath) {
    $result = $str;
    $result = strtolower($result);
    $pattern = array(' ', 'é', 'è', 'ë', 'ê', 'á', 'à', 'ä', 'â', 'å', 'ã', 'ó', 'ò', 'ö', 'ô', 'õ', 'í', 'ì', 'ï', 'ú', 'ù', 'ü', 'û', 'ý', 'ÿ', 'ø', 'œ', 'ç', 'ñ', 'ß', 'ț', 'ș', 'ř', 'ž', 'á', 'č', 'ď', 'é', 'ě', 'í', 'ň', 'ó', 'ř', 'š', 'ť', 'ú', 'ů', 'ý', 'ž');
    $replace = array('-', 'e', 'e', 'e', 'e', 'a', 'a', 'a', 'a', 'a', 'a', 'o', 'o', 'o', 'o', 'o', 'i', 'i', 'i', 'u', 'u', 'u', 'u', 'y', 'y', 'o', 'ae', 'c', 'n', 'ss', 't', 's', 'r', 'z', 'a', 'c', 'd', 'e', 'e', 'i', 'n', 'o', 'r', 's', 't', 'u', 'u', 'y', 'z');
    $result = str_replace($pattern, $replace, $result);

    $i = 1;
    while (file_exists($uploadPath . $result . ($i > 1 ? " (" . $i . ")" : "") . "." . $ext)) {
        $i++;
    }

    if ($i > 1) {
        $result .= " (" . $i . ")";
    }

    return $result;
}

if (isset($_FILES['file']) && $_FILES['file']['name'] != "") {
    $uploadPath = "../../../../upload/";
    
    $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $filename = generateFileName($recordset['user_lastname'].'_'.$recordset['user_id'], $extension, $uploadPath);

    move_uploaded_file(
        $_FILES['file']['tmp_name'],
        $uploadPath.$filename . "." . $extension
    );

    $tabTailles = [
        /*["prefix" => "xl", "largeur" => 1200, "hauteur" => 900],*/
        ["prefix" => "lg", "largeur" => 128, "hauteur" => 128],
        ["prefix" => "md", "largeur" => 96, "hauteur" => 96],
        ["prefix" => "sm", "largeur" => 40, "hauteur" => 40]
    ];

    $filename .= ".".$extension;

    $sql = "UPDATE users SET user_picture = :name WHERE user_id = :id";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(":name", $filename);
    $stmt->bindParam(":id", $recordset['user_id']);
    $stmt->execute();

    foreach ($tabTailles as $taille) {
        switch (strtolower($extension)) {
            case "gif":
                $imgSource = imagecreatefromgif($uploadPath . $filename);
                break;
            case "png":
                $imgSource = imagecreatefrompng($uploadPath . $filename);
                break;
            case "jpg":
            case "jpeg":
                $imgSource = imagecreatefromjpeg($uploadPath . $filename);
                break;
            default:
                unlink($uploadPath . $filename);
        }

        $sizes = getimagesize($uploadPath . $filename);
        $imgSourceLargeur = $sizes[0];
        $imgSourceHauteur = $sizes[1];

        $imgPrefix = $taille['prefix'];
        $imgDestLargeur = $taille['largeur'];
        $imgDestHauteur = $taille['hauteur'];
        $imageSourceZoneX = 0;
        $imageSourceZoneY = 0;
        $imgSourceZoneLargeur = $imgSourceLargeur;
        $imgSourceZoneHauteur = $imgSourceHauteur;

        if ($imgDestLargeur == $imgDestHauteur) {
            if ($imgSourceLargeur > $imgSourceHauteur) {
                $imageSourceZoneX = ($imgSourceLargeur - $imgSourceHauteur) / 2;
                $imgSourceZoneLargeur = $imgSourceHauteur;
            } else {
                $imageSourceZoneY = ($imgSourceHauteur - $imgSourceLargeur) / 2;
                $imgSourceZoneHauteur = $imgSourceLargeur;
            }
        } else {
            if ($imgSourceLargeur > $imgSourceHauteur) {
                $imgDestHauteur = ($imgSourceHauteur * $imgDestLargeur) / $imgSourceLargeur;
            } else {
                $imgDestLargeur = ($imgSourceLargeur * $imgDestHauteur) / $imgSourceHauteur;
            }
        }

        $imgDest = imagecreatetruecolor($imgDestLargeur, $imgDestHauteur);

        imagecopyresampled(
            $imgDest,
            $imgSource,
            0,
            0,
            $imageSourceZoneX,
            $imageSourceZoneY,
            $imgDestLargeur,
            $imgDestHauteur,
            $imgSourceZoneLargeur,
            $imgSourceZoneHauteur
        );

        switch (strtolower($extension)) {
            case "gif":
                imagegif($imgDest, $uploadPath . $imgPrefix . "_" . $filename);
                imagegif($imgDest, $uploadPath . $filename);
                break;
            case "png":
                imagepng($imgDest, $uploadPath . $imgPrefix . "_" . $filename, 5, PNG_ALL_FILTERS);
                imagepng($imgDest, $uploadPath . $filename);
                break;
            case "jpg":
            case "jpeg":
                imagejpeg($imgDest, $uploadPath . $imgPrefix . "_" . $filename, 97);
                imagejpeg($imgDest, $uploadPath . $filename);
                break;
        }
    }

    unlink($uploadPath . $filename);
}

?>