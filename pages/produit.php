<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail Produit - TechStore</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
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
                <button class="btn-connexion">Connexion</button>
            </nav>
        </div>
    </header>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <div class="container">
            <nav class="breadcrumb-nav">
                <a href="../index.php"><i class="fas fa-home"></i> Accueil</a>
                <span class="separator">></span>
                <a href="catalogue.php">Produits</a>
                <span class="separator">></span>
                <span id="breadcrumb-product-name">Produit</span>
            </nav>
        </div>
    </div>

    <!-- Product Detail Section -->
    <section class="product-detail">
        <div class="container">
            <div class="product-detail-grid">
                <!-- Product Images -->
                <div class="product-images">
                    <div class="main-image">
                        <img id="main-product-image" src="" alt="Produit">
                        <span class="discount-badge" id="product-discount">-17%</span>
                    </div>
                    <div class="thumbnail-images" id="thumbnail-container">
                        <!-- Thumbnails will be loaded by JS -->
                    </div>
                </div>

                <!-- Product Info -->
                <div class="product-info-detail">
                    <div class="product-header">
                        <span class="sku" id="product-sku">SKU: LAP-ZEN-002</span>
                        <div class="rating">
                            <div class="stars" id="product-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span id="product-rating">4.8 (0 avis)</span>
                        </div>
                    </div>

                    <h1 id="product-name">Nom du produit</h1>

                    <div class="product-price-detail">
                        <span class="current-price" id="product-price">0,00 €</span>
                    </div>

                    <p class="product-short-desc" id="product-description">
                        Description du produit...
                    </p>

                    <div class="product-features">
                        <div class="feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Garantie constructeur 2 ans</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-shield-alt"></i>
                            <span>Paiement 100% sécurisé</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-truck"></i>
                            <span>Livraison express disponible</span>
                        </div>
                    </div>

                    <div class="product-stock">
                        <span class="in-stock"><i class="fas fa-check-circle"></i> En stock</span>
                        <span class="shipping-time">Expédié sous 24h</span>
                    </div>

                    <div class="product-actions-detail">
                        <div class="quantity-selector">
                            <span class="label">Quantité</span>
                            <div class="quantity-control">
                                <button onclick="updateProductQuantity(-1)"><i class="fas fa-minus"></i></button>
                                <span id="product-quantity">1</span>
                                <button onclick="updateProductQuantity(1)"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>

                        <div class="action-buttons">
                            <button class="btn-add-cart-detail" onclick="addToCartFromDetail()">
                                <i class="fas fa-shopping-cart"></i> Ajouter au panier
                            </button>
                            <button class="btn-buy-now" onclick="buyNow()">
                                Acheter maintenant
                            </button>
                        </div>
                    </div>

                    <div class="product-help">
                        <a href="#"><i class="fas fa-question-circle"></i> Besoin d'aide ?</a>
                        <a href="#"><i class="fas fa-undo"></i> Politique de retour</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Tabs -->
    <section class="product-tabs-section">
        <div class="container">
            <div class="tabs">
                <button class="tab-btn active" onclick="switchTab('description')">
                    <i class="fas fa-file-alt"></i> Description
                </button>
                <button class="tab-btn" onclick="switchTab('specifications')">
                    <i class="fas fa-cog"></i> Spécifications
                </button>
            </div>

            <div class="tab-content">
                <div id="tab-description" class="tab-panel active">
                    <div class="description-content">
                        <div class="about-product">
                            <h3><i class="fas fa-info-circle"></i> À propos du produit</h3>
                            <p id="tab-desc-text">Description détaillée du produit...</p>
                        </div>
                        <div class="why-choose">
                            <h3>Pourquoi choisir ce produit ?</h3>
                            <div class="reasons">
                                <div class="reason">
                                    <span class="number">1</span>
                                    <p>Conçu pour des performances optimales dans sa catégorie.</p>
                                </div>
                                <div class="reason">
                                    <span class="number">2</span>
                                    <p>Matériaux de haute qualité garantissant une durabilité accrue.</p>
                                </div>
                                <div class="reason">
                                    <span class="number">3</span>
                                    <p>Support technique et garantie constructeur inclus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab-specifications" class="tab-panel">
                    <div class="specifications-content">
                        <h3>Spécifications techniques</h3>
                        <table class="specs-table" id="specs-table">
                            <!-- Specs will be loaded by JS -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    <section class="related-products-section">
        <div class="container">
            <h2>Produits similaires</h2>
            <div class="products-grid" id="related-products-grid">
                <!-- Related products will be loaded by JS -->
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

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <i class="fas fa-check-circle"></i>
        <div class="toast-content">
            <span class="toast-title">Produit ajouté au panier avec succès</span>
        </div>
        <a href="panier.php" class="toast-action">Voir le panier</a>
    </div>

    <script src="../js/main.js"></script>
    <script src="../js/produit.js"></script>
</body>
</html>
