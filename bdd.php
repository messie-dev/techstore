<?php

// Informations de connexion à la base de données
$host = "localhost";
$dbname = "TechStore";
$username = "root";
$password = "";

try {

    // Connexion à MySQL avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Active les erreurs PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {

    // Affiche l’erreur si la connexion échoue
    die("Erreur de connexion : " . $e->getMessage());
}

?>