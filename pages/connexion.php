<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - TechStore</title>
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
                <button class="btn-connexion active">Connexion</button>
            </nav>
        </div>
    </header>

    <section class="auth-section">
        <div class="container">
            <div class="auth-container">
                <div class="auth-form-container" id="login-form">
                    <div class="auth-header">
                        <h2>Connexion</h2>
                        <p>Connectez-vous pour accéder à votre compte</p>
                    </div>

                    <form class="auth-form" action="../login.php" method="post">
                        <div class="form-group">
                            <label for="login-email">Email</label>
                            <div class="input-with-icon">
                                <i class="fas fa-envelope"></i>
                                <input type="email" id="login-email" name="email" placeholder="votre@email.com" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="login-password">Mot de passe</label>
                            <div class="input-with-icon">
                                <i class="fas fa-lock"></i>
                                <input type="password" id="login-password" name="mot_de_passe" placeholder="Votre mot de passe" required>
                            </div>
                        </div>

                        <button type="submit" name="connexion" class="btn-auth">Se connecter</button>
                    </form>

                    <div class="auth-footer">
                        <p>Pas encore de compte ? <a href="inscription.php">Créer un compte</a></p>
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