<?php
require "bdd.php";

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechStore - Expert en matériel informatique</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Header / Navigation -->
    <header class="header">
        <div class="container">
            <nav class="navbar">
                <a href="index.php" class="logo">⬡ TechStore</a>
                <ul class="nav-links">
                    <li><a href="index.php" class="active">Accueil</a></li>
                    <li><a href="pages/catalogue.php">Catalogue</a></li>
                    <li><a href="pages/panier.php">Panier</a></li>
                </ul>
                <a href="pages/connexion.php" class="btn-connexion">Connexion</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <span class="badge-expert">Expert en matériel informatique</span>
                    <h1>Trouvez l'équipement <span class="highlight">parfait</span> pour vos projets.</h1>
                    <p>Une large gamme de composants, périphériques et ordinateurs pour professionnels et passionnés.</p>

                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Rechercher un produit (ex: RTX 4090)">
                        <button class="btn-rechercher">Rechercher</button>
                    </div>

                    <div class="popular-tags">
                        <span>Populaire :</span>
                        <button class="tag">Cartes Graphiques</button>
                        <button class="tag">Processeurs</button>
                        <button class="tag">Écrans</button>
                    </div>
                </div>

                <div class="hero-carousel">
                    <div class="carousel-container">
                        <div class="carousel-slide active">
                            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&h=400&fit=crop" alt="Rentrée Scolaire">
                            <div class="slide-content">
                                <span class="promo-badge">-15% PROMO</span>
                                <h3>Rentrée Scolaire - Tech</h3>
                                <p>Équipez-vous pour la réussite</p>
                                <a href="pages/catalogue.php" class="slide-link">Voir l'offre <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="carousel-slide">
                            <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?w=600&h=400&fit=crop" alt="Gaming Week">
                            <div class="slide-content">
                                <span class="promo-badge">-10% PROMO</span>
                                <h3>Gaming Week</h3>
                                <p>Le niveau supérieur</p>
                                <a href="pages/catalogue.php" class="slide-link">Voir l'offre <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-prev"><i class="fas fa-chevron-left"></i></button>
                    <button class="carousel-next"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories">
        <div class="container">
            <div class="section-header">
                <div>
                    <h2>Explorez par Matériel</h2>
                    <p>Trouvez les composants exacts dont vous avez besoin pour construire ou améliorer votre configuration informatique.</p>
                </div>
                <a href="pages/catalogue.php" class="btn-voir-tout">Tout voir <i class="fas fa-arrow-right"></i></a>
            </div>

            <div class="categories-grid">
                <div class="category-card" onclick="window.location.href='pages/catalogue.php?category=ordinateurs'">
                    <img src="https://images.unsplash.com/photo-1593640408182-31c70c8268f5?w=400&h=300&fit=crop" alt="Ordinateurs">
                    <div class="category-overlay">
                        <h3>Ordinateurs</h3>
                        <p>PC Portables et Fixes</p>
                    </div>
                </div>
                <div class="category-card" onclick="window.location.href='pages/catalogue.php?category=composants'">
                    <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=400&h=300&fit=crop" alt="Composants">
                    <div class="category-overlay">
                        <h3>Composants</h3>
                        <p>Pièces détachées informatiques</p>
                    </div>
                </div>
                <div class="category-card" onclick="window.location.href='pages/catalogue.php?category=peripheriques'">
                    <img src="https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=400&h=300&fit=crop" alt="Périphériques">
                    <div class="category-overlay">
                        <h3>Périphériques</h3>
                        <p>Claviers, souris, écrans</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Promotions Section -->
    <section class="promotions">
        <div class="container">
            <div class="section-header">
                <div>
                    <h2>Offres Flash & Promotions</h2>
                    <p>Équipez-vous au meilleur prix. Découvrez notre sélection de matériel informatique en promotion limitée.</p>
                </div>
                <a href="pages/catalogue.php" class="btn-voir-tout">Voir tout <i class="fas fa-arrow-right"></i></a>
            </div>

            <div class="products-grid" id="promotions-grid">
                <!-- Products will be loaded by JavaScript -->
            </div>
        </div>
    </section>

    <!-- Suggestions Section -->
    <section class="suggestions">
        <div class="container">
            <div class="section-header">
                <div>
                    <span class="section-badge"><i class="fas fa-compass"></i> SUGGESTIONS POUR VOUS</span>
                    <h2>Recommandations personnalisées</h2>
                    <p>Basé sur les tendances actuelles et les meilleures ventes, voici une sélection de matériel informatique qui pourrait vous intéresser.</p>
                </div>
                <a href="pages/catalogue.php" class="btn-voir-tout">Voir tout le catalogue <i class="fas fa-arrow-right"></i></a>
            </div>

            <div class="products-grid" id="suggestions-grid">
                <!-- Products will be loaded by JavaScript -->
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
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="pages/catalogue.php">Catalogue Produits</a></li>
                        <li><a href="pages/panier.php">Mon Panier</a></li>
                        <li><a href="pages/connexion.php">Espace Client</a></li>
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
                        <li><i class="fas fa-envelope"></i> contact@materiel-info.fr</li>
                        <li><i class="fas fa-phone"></i> +33 1 23 45 67 89</li>
                        <li><i class="fas fa-map-marker-alt"></i> Paris, France</li>
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

    <script src="js/main.js"></script>
</body>
</html>
