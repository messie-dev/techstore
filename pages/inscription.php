<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - TechStore</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="auth-page">
    <header class="header">
        <div class="container">
            <nav class="navbar">
                <a href="../index.php" class="logo">⬡ TechStore</a>
                <ul class="nav-links">
                    <li><a href="../index.php">Accueil</a></li>
                    <li><a href="catalogue.php">Catalogue</a></li>
                    <li><a href="panier.php">Panier</a></li>
                </ul>
                <button class="btn-connexion active">Inscription</button>
            </nav>
        </div>
    </header>

    <section class="auth-section">
        <div class="container">
            <div class="auth-container">
                <div class="auth-form-container" id="register-form">
                    <div class="auth-header">
                        <h2>Créer un compte</h2>
                        <p>Inscrivez-vous pour profiter de tous nos avantages</p>
                    </div>

                    <form class="auth-form" action="../register.php" method="post">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="register-firstname">Prénom</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-user"></i>
                                    <input type="text" id="register-firstname" name="prenom" placeholder="Votre prénom" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="register-lastname">Nom</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-user"></i>
                                    <input type="text" id="register-lastname" name="nom" placeholder="Votre nom" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="register-email">Email</label>
                            <div class="input-with-icon">
                                <i class="fas fa-envelope"></i>
                                <input type="email" id="register-email" name="email" placeholder="votre@email.com" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="register-phone">Téléphone</label>
                            <div class="input-with-icon">
                                <i class="fas fa-phone"></i>
                                <input type="tel" id="register-phone" name="telephone" placeholder="+33 6 12 34 56 78">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="register-address">Adresse</label>
                            <div class="input-with-icon">
                                <i class="fas fa-map-marker-alt"></i>
                                <input type="text" id="register-address" name="adresse" placeholder="Votre adresse">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="register-password">Mot de passe</label>
                            <div class="input-with-icon">
                                <i class="fas fa-lock"></i>
                                <input type="password" id="register-password" name="mot_de_passe" placeholder="Créez un mot de passe" required>
                            </div>
                        </div>

                        <button type="submit" name="inscription" class="btn-auth">Créer mon compte</button>
                    </form>

                    <div class="auth-footer">
                        <p>Déjà un compte ? <a href="connexion.php">Se connecter</a></p>
                    </div>
                </div>

                <div class="auth-benefits">
                    <h3>Avantages de votre compte</h3>
                    <ul>
                        <li>
                            <i class="fas fa-shopping-bag"></i>
                            <div>
                                <strong>Suivi de commandes</strong>
                                <p>Suivez vos commandes en temps réel</p>
                            </div>
                        </li>
                        <li>
                            <i class="fas fa-heart"></i>
                            <div>
                                <strong>Liste de souhaits</strong>
                                <p>Enregistrez vos produits favoris</p>
                            </div>
                        </li>
                        <li>
                            <i class="fas fa-bell"></i>
                            <div>
                                <strong>Alertes prix</strong>
                                <p>Soyez informé des promotions</p>
                            </div>
                        </li>
                        <li>
                            <i class="fas fa-history"></i>
                            <div>
                                <strong>Historique d'achats</strong>
                                <p>Consultez vos achats précédents</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column">
                    <h4>Navigation Rapide</h4>
                    <ul>
                        <li><a href="../index.php">Accueil</a></li>
                        <li><a href="catalogue.php">Catalogue Produits</a></li>
                        <li><a href="panier.php">Mon Panier</a></li>
                        <li><a href="connexion.php">Espace Client</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Informations Légales</h4>
                    <ul>
                        <li><a href="#">Mentions Légales</a></li>
                        <li><a href="#">Politique de Confidentialité</a></li>
                        <li><a href="#">Conditions Générales de Vente</a></li>
                        <li><a href="#">Politique de Retour</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Service Client</h4>
                    <ul>
                        <li><a href="#">Service Client</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Suivi de Commande</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Contact & Réseaux</h4>
                    <ul class="contact-info">
                        <li><i class="fas fa-envelope"></i> Quentin@gmail.com</li>
                        <li><i class="fas fa-phone"></i> +228 92 13 26 35</li>
                        <li><i class="fas fa-map-marker-alt"></i> TOGO, Lomé</li>
                    </ul>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Matériel Informatique. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="../js/main.js"></script>
</body>
</html>