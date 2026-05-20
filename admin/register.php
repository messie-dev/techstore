<?php
require 'bdd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $adress = $_POST['adress'];
    $telephone= $_POST['telephone'];

    // Hash du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    try {
        $stmt = $pdo->prepare("INSERT INTO utilisateur (email, password, adress, telephone) VALUES (?, ?, ?, ?)");
        $stmt->execute([$email, $hashedPassword, $adress, $telephone]);

        header("Location: ../public/connexion.php");
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>