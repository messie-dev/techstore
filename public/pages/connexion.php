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
    <!-- Header / Navigation -->
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

    <!-- Auth Section -->
    <section class="auth-section">
        <form action="../admin/register.php" method="post" novalidate>
        <div class="container">
            <div class="auth-container">
                <!-- Login Form -->
                <div class="auth-form-container" id="login-form">
                    <div class="auth-header">
                        <h2>Connexion</h2>
                        <p>Connectez-vous pour accéder à votre compte</p>
                    </div>

                    <form class="auth-form" onsubmit="handleLogin(event)">
                        <div class="form-group">
                            <label for="login-email">Adresse email</label>
                            <div class="input-with-icon">
                                <i class="fas fa-envelope"></i>
                                <input type="email" id="login-email" placeholder="votre@email.com" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="login-password">Mot de passe</label>
                            <div class="input-with-icon">
                                <i class="fas fa-lock"></i>
                                <input type="password" id="login-password" placeholder="Votre mot de passe" required>
                                <button type="button" class="toggle-password" onclick="togglePassword('login-password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-options">
                            <label class="checkbox-label">
                                <input type="checkbox" id="remember-me">
                                <span>Se souvenir de moi</span>
                            </label>
                            <a href="#" class="forgot-password">Mot de passe oublié ?</a>
                        </div>

                        <button type="submit" class="btn-auth">Se connecter</button>
                    </form>

                    <div class="auth-divider">
                        <span>ou</span>
                    </div>

                    <div class="social-auth">
                        <button class="btn-social btn-google">
                            <i class="fab fa-google"></i> Continuer avec Google
                        </button>
                        <button class="btn-social btn-facebook">
                            <i class="fab fa-facebook-f"></i> Continuer avec Facebook
                        </button>
                    </div>

                    <div class="auth-footer">
                        <p>Pas encore de compte ? <a href="#" onclick="showRegister()">Créer un compte</a></p>
                    </div>
                </div>

                <!-- Register Form -->
                <div class="auth-form-container hidden" id="register-form">
                     <form action="../admin/login.php" method="post">
                    <div class="auth-header">
                        <h2>Créer un compte</h2>
                        <p>Inscrivez-vous pour profiter de tous nos avantages</p>
                    </div>

                    <form class="auth-form" onsubmit="handleRegister(event)">
                        
                        <div class="form-group">
                            <label for="register-email"> email</label>
                            <div class="input-with-icon">
                                <i class="fas fa-envelope"></i>
                                <input type="email" id="register-email" placeholder="votre@email.com" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="register-phone">telephone</label>
                            <div class="input-with-icon">
                                <i class="fas fa-phone"></i>
                                <input type="tel" id="register-phone" placeholder="+33 6 12 34 56 78">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="register-password">Mot de passe</label>
                            <div class="input-with-icon">
                                <i class="fas fa-lock"></i>
                                <input type="password" id="register-password" placeholder="Créez un mot de passe" required>
                                <button type="button" class="toggle-password" onclick="togglePassword('register-password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="register-password-confirm">Confirmer le mot de passe</label>
                            <div class="input-with-icon">
                                <i class="fas fa-lock"></i>
                                <input type="password" id="register-password-confirm" placeholder="Confirmez votre mot de passe" required>
                            </div>
                        </div>

                        <label class="checkbox-label terms">
                            <input type="checkbox" id="accept-terms" required>
                            <span>J'accepte les <a href="#">Conditions Générales d'Utilisation</a> et la <a href="#">Politique de Confidentialité</a></span>
                        </label>

                        <button type="submit" class="btn-auth">Créer mon compte</button>
                    </form>

                    <div class="auth-footer">
                        <p>Déjà un compte ? <a href="#" onclick="showLogin()">Se connecter</a></p>
                    </div>
                </div>

                <!-- Auth Benefits -->
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

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column">
                    <h4>Navigation Rapide</h4>
                    <ul>
                        <li><a href="../index.php">Accueil</a></li>
                        <li><a href="catalogue.php">Catalogue Produits</a></li>
                        <li><a href="panier.php">Mon Panier</a></li>
                        <li><a href="#">Espace Client</a></li>
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
    <script src="../js/connexion.js"></script>
</body>
</html>
