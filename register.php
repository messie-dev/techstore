<?php

// Démarrage de la session
session_start();

// Inclusion de la connexion à la base de données
require_once 'bdd.php';

// Vérifie si le formulaire est soumis
if(isset($_POST['inscription'])) {

    // Récupération des données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérifie si l’email existe déjà
    $check = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $check->execute([$email]);

    // Si l’email existe déjà
    if($check->rowCount() > 0) {

        echo "Cet email existe déjà";

    } else {

        // Hashage du mot de passe pour la sécurité
        $passwordHash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        // Requête d’insertion
        $sql = "INSERT INTO utilisateurs(nom, prenom, email, telephone, mot_de_passe, role, adresse)
                VALUES(?, ?, ?, ?, ?, 'client', ?)";

        // Préparation de la requête
        $insert = $pdo->prepare($sql);

        // Exécution de la requête
        $insert->execute([
            $nom,
            $prenom,
            $email,
            $telephone,
            $passwordHash,
            $adresse
        ]);

       header('Location: pages/connexion.php');
       exit();
    }
}

?>