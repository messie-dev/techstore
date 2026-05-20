<?php
session_start();
require 'bdd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    

    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = ?");
    $stmt->execute([$email]);
    $utilisateur = $stmt->fetch();

    if ($utilisateur) {

        if (password_verify($password, $utilisateur['password'])) {

            $_SESSION['utilisateur_id'] = $utilisateur['id'];
            $_SESSION['email'] = $utilisateur['email'];

            header("Location: ../public/index.php");
            exit;

        } else {
            echo "Mot de passe incorrect";
        }

    } else {
        echo "Email introuvable";
    }
}
?>