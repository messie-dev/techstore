<?php
session_start();

if (!isset($_SESSION['user'])) {
    die("Utilisateur non connecté");
}

$user = $_SESSION['user'];

if (isset($_FILES['profile'])) {

    $file = $_FILES['profile'];
    $tmpName = $file['tmp_name'];

    // Vérifier type image
    $allowed = ['image/jpeg', 'image/png', 'image/jpg'];

    if (in_array($file['type'], $allowed)) {

        $destination = "uploads/" . $user . ".png";

        move_uploaded_file($tmpName, $destination);

        header("Location: profile.php");
    } else {
        echo "Format non supporté (jpg, png seulement)";
    }
}
?>