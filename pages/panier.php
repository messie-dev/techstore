<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier - TechStore</title>
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
                    <li><a href="panier.php" class="active">Panier</a></li>
                </ul>
                <a href="connexion.php" class="btn-connexion">Connexion</a>
            </nav>
        </div>
    </header>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <nav class="breadcrumb-nav" style="justify-content: center; margin-bottom: 15px; color: rgba(255,255,255,0.8);">
                <a href="../index.html"><i class="fas fa-home"></i></a>
                <span class="separator">></span>
                <span>Panier</span>
            </nav>
            <h1>Mon Panier</h1>
            <p>Consultez et gérez vos articles avant de passer commande</p>
        </div>
    </section>

    <!-- Cart Section -->
    <section class="cart-section">
        <div class="container">
            <!-- Empty Cart State -->
            <div class="empty-cart" id="empty-cart" style="display: none;">
                <div class="empty-cart-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <h2>Votre panier est vide</h2>
                <p>Il semble que vous n'ayez pas encore ajouté de produits.</p>
                <p>Découvrez notre catalogue de matériel informatique de pointe.</p>
                <a href="catalogue.php" class="btn-continue">Continuer mes achats</a>
            </div>

            <!-- Cart with Items -->
            <div class="cart-layout" id="cart-with-items">
                <!-- Cart Items -->
                <div class="cart-items">
                    <div class="cart-header">
                        <h3>Articles dans votre panier</h3>
                        <button class="btn-clear" onclick="clearCart()">
                            <i class="fas fa-trash"></i> Vider le panier
                        </button>
                    </div>

                    <div id="cart-items-container">
                        <!-- Cart items will be loaded by JavaScript -->
                    </div>
                </div>

                <!-- Cart Summary -->
                <div class="cart-summary">
                    <h3>Récapitulatif</h3>

                    <div class="summary-row">
                        <span>Sous-total</span>
                        <span id="subtotal">0,00 €</span>
                    </div>
                    <div class="summary-row">
                        <span>Livraison</span>
                        <span id="shipping">Gratuite</span>
                    </div>
                    <div class="summary-row">
                        <span>TVA (20%)</span>
                        <span id="tax">0,00 €</span>
                    </div>
                    <div class="summary-row promo-row" id="discount-row" style="display: none;">
                        <span>Remise</span>
                        <span id="discount">-0,00 €</span>
                    </div>

                    <div class="promo-code">
                        <input type="text" id="promo-input" placeholder="Code promo">
                        <button onclick="applyPromoCode()">Appliquer</button>
                    </div>

                    <div class="summary-total">
                        <span>Total</span>
                        <span id="total">0,00 €</span>
                    </div>

                    <button class="btn-checkout" onclick="checkout()">
                        <i class="fas fa-lock"></i> Passer la commande
                    </button>

                    <div class="payment-methods">
                        <p>Moyens de paiement acceptés:</p>
                        <div class="payment-icons">
                            <i class="fab fa-cc-visa"></i>
                            <i class="fab fa-cc-mastercard"></i>
                            <i class="fab fa-cc-paypal"></i>
                            <i class="fab fa-cc-apple-pay"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recommended Products -->
            <div class="related-products-section" id="recommended-section">
                <h2>Produits recommandés</h2>
                <div class="products-grid" id="recommended-grid">
                    <!-- Recommended products will be loaded by JavaScript -->
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

    <!-- Checkout Modal -->
    <div class="modal" id="checkout-modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <div class="modal-header">
                <i class="fas fa-check-circle"></i>
                <h2>Commande confirmée !</h2>
            </div>
            <p>Votre commande a été passée avec succès. Vous recevrez un email de confirmation sous peu.</p>
            <div class="modal-actions">
                <a href="../index.php" class="btn-primary">Retour à l'accueil</a>
                <a href="catalogue.php" class="btn-secondary">Continuer les achats</a>
            </div>
        </div>
    </div>

    <script src="../js/main.js"></script>
    <script src="../js/panier.js"></script>
</body>
</html>
