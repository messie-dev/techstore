<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    die("Accès refusé");
}

$response = ['success' => false, 'path' => '', 'error' => ''];

if (isset($_FILES['image'])) {

    $file = $_FILES['image'];
    $tmpName = $file['tmp_name'];
    $error = $file['error'];

    if ($error !== UPLOAD_ERR_OK) {
        $response['error'] = 'Erreur lors de l\'upload';
        echo json_encode($response);
        exit;
    }

    $allowed = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp', 'image/gif'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $tmpName);
    finfo_close($finfo);

    if (!in_array($mime, $allowed)) {
        $response['error'] = 'Format non supporté (jpg, png, webp seulement)';
        echo json_encode($response);
        exit;
    }

    $ext = match ($mime) {
        'image/jpeg', 'image/jpg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
        'image/gif' => 'gif',
        default => 'jpg',
    };

    $cheminUploads = __DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'produits';
    if (!is_dir($cheminUploads)) {
        mkdir($cheminUploads, 0777, true);
    }

    $nomFichier = uniqid('prod_') . '.' . $ext;
    $destination = $cheminUploads . DIRECTORY_SEPARATOR . $nomFichier;

    if (move_uploaded_file($tmpName, $destination)) {
        $response['success'] = true;
        $response['path'] = 'uploads/produits/' . $nomFichier;
    } else {
        $response['error'] = 'Échec de l\'enregistrement du fichier';
    }
} else {
    $response['error'] = 'Aucun fichier reçu';
}

header('Content-Type: application/json');
echo json_encode($response);
