<?php

// Démarrage de la session
session_start();

// Inclusion de la connexion à la base de données
require_once 'bdd.php';

// Vérifie si le bouton connexion est cliqué
if(isset($_POST['connexion'])) {

    // Récupération de l’email
    $email = htmlspecialchars($_POST['email']);

    // Récupération du mot de passe
    $mot_de_passe = $_POST['mot_de_passe'];

    // Recherche de l’utilisateur dans la base de données
    $sql = "SELECT * FROM utilisateurs WHERE email = ?";

    // Préparation de la requête
    $requete = $pdo->prepare($sql);

    // Exécution de la requête
    $requete->execute([$email]);

    // Vérifie si l’utilisateur existe
    if($requete->rowCount() > 0) {

        // Récupère les informations de l’utilisateur
        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

        // Vérifie le mot de passe
        if(password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {

            // Création des variables de session
            $_SESSION['id'] = $utilisateur['id'];
            $_SESSION['nom'] = $utilisateur['nom'];
            $_SESSION['prenom'] = $utilisateur['prenom'];
            $_SESSION['email'] = $utilisateur['email'];
            $_SESSION['role'] = $utilisateur['role'];

            // Vérifie le rôle
            if($utilisateur['role'] == 'admin') {

                // Redirection vers le tableau de bord admin
                header('Location: dashboard.php');
                exit();

            } else {

                // Redirection vers l’espace utilisateur
                header('Location: index.php');
                exit();
            }

        } else {

            // Mot de passe incorrect
            echo "Mot de passe incorrect";
        }

    } else {

        // Utilisateur introuvable
        echo "Email incorrect";
    }
}

?>