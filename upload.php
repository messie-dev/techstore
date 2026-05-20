<?php
session_start();

if (!isset($_SESSION['id'])) {
    die("Utilisateur non connecté");
}

$user = $_SESSION['email'];

if (isset($_FILES['profile'])) {

    $file = $_FILES['profile'];
    $tmpName = $file['tmp_name'];

    $allowed = ['image/jpeg', 'image/png', 'image/jpg'];

    if (in_array($file['type'], $allowed)) {

        $cheminUploads = __DIR__ . DIRECTORY_SEPARATOR . 'uploads';
        if (!is_dir($cheminUploads)) {
            mkdir($cheminUploads, 0777, true);
        }

        $destination = $cheminUploads . DIRECTORY_SEPARATOR . $user . ".png";

        move_uploaded_file($tmpName, $destination);

        header("Location: profile.php");
    } else {
        echo "Format non supporté (jpg, png seulement)";
    }
}
?>