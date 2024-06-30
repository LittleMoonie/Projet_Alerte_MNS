<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];

        $fileName = basename($file['name']);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        $allowedTypes = ['jpg', 'png', 'gif', 'pdf', 'doc', 'docx', 'ppt', 'pptx'];
        if (in_array($fileType, $allowedTypes)) {
            $imgurClientId = 'YOUR_IMGUR_CLIENT_ID';
            $handle = fopen($file['tmp_name'], "r");
            $data = fread($handle, filesize($file['tmp_name']));
            $pvars = array('image' => base64_encode($data));
            $timeout = 30;

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
            curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $imgurClientId));
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);

            $out = curl_exec($curl);
            curl_close($curl);

            $pms = json_decode($out, true);
            $url = $pms['data']['link'];

            echo json_encode(['file_url' => $url]);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Type de fichier non autorisé']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Aucun fichier envoyé']);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Mauvaise méthode']);
}
?>
