<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation de Commande - TechStore</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .checkout-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin: 2rem 0;
        }

        .checkout-form {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .checkout-summary {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            height: fit-content;
            position: sticky;
            top: 100px;
        }

        .form-section {
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .form-section:last-child {
            border-bottom: none;
        }

        .form-section h3 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #111827;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-section h3 i {
            color: #3b82f6;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-row.full {
            grid-template-columns: 1fr;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group select {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.95rem;
            background: #f9fafb;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-group input.error {
            border-color: #ef4444;
            background: #fef2f2;
        }

        .form-group .error-message {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        /* Summary Styles */
        .summary-header {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #111827;
        }

        .summary-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: #f9fafb;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .summary-item-image {
            width: 60px;
            height: 60px;
            border-radius: 6px;
            object-fit: cover;
            background: white;
            border: 1px solid #e5e7eb;
        }

        .summary-item-info {
            flex: 1;
        }

        .summary-item-name {
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.25rem;
        }

        .summary-item-qty {
            color: #6b7280;
            font-size: 0.875rem;
        }

        .summary-item-price {
            font-weight: 600;
            color: #3b82f6;
            font-size: 0.95rem;
        }

        .summary-divider {
            height: 1px;
            background: #e5e7eb;
            margin: 1rem 0;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            color: #6b7280;
        }

        .summary-row.total {
            font-size: 1.25rem;
            font-weight: 700;
            color: #111827;
            padding-top: 1rem;
            border-top: 2px solid #3b82f6;
        }

        .btn-validate {
            width: 100%;
            background: #3b82f6;
            color: white;
            padding: 1rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 1.5rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-size: 1rem;
        }

        .btn-validate:hover {
            background: #2563eb;
        }

        .btn-validate:disabled {
            background: #d1d5db;
            cursor: not-allowed;
        }

        .payment-methods {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .payment-option {
            padding: 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment-option:hover {
            border-color: #3b82f6;
        }

        .payment-option.active {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .payment-option i {
            font-size: 2rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        .payment-option.active i {
            color: #3b82f6;
        }

        .payment-option label {
            font-weight: 600;
            color: #111827;
            display: block;
            margin-bottom: 0.25rem;
        }

        .coupon-input {
            display: flex;
            gap: 0.5rem;
        }

        .coupon-input input {
            flex: 1;
        }

        .coupon-input button {
            padding: 0.75rem 1rem;
            background: #6b7280;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .coupon-input button:hover {
            background: #4b5563;
        }

        @media (max-width: 768px) {
            .checkout-container {
                grid-template-columns: 1fr;
            }

            .checkout-summary {
                position: relative;
                top: auto;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .payment-methods {
                grid-template-columns: 1fr;
            }
        }
    </style>
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
                <!-- Profil utilisateur -->
                <div class="user-section" id="user-section">
                    <a href="connexion.php" class="btn-connexion" id="btn-connexion">Connexion</a>
                    <div class="user-profile-container" id="user-profile-container" style="display: none;">
                        <button class="user-profile-btn" id="user-profile-btn">
                            <img src="" alt="Profil" class="user-avatar" id="user-avatar">
                            <span class="user-name" id="user-name"></span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="user-dropdown" id="user-dropdown">
                            <a href="profil.php" class="dropdown-item">
                                <i class="fas fa-user"></i> Mon profil
                            </a>
                            <a href="#" class="dropdown-item" id="logout-link">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <nav class="breadcrumb-nav">
                <a href="../index.php"><i class="fas fa-home"></i> Accueil</a>
                <span class="separator">></span>
                <a href="panier.php">Panier</a>
                <span class="separator">></span>
                <span>Validation de Commande</span>
            </nav>
            <h1>Validation de Commande</h1>
            <p>Complétez vos informations de livraison et de paiement pour finaliser votre commande</p>
        </div>
    </section>

    <!-- Checkout Section -->
    <section class="checkout-section">
        <div class="container">
            <div class="checkout-container">
                <!-- Checkout Form -->
                <div class="checkout-form">
                    <form id="checkoutForm">
                        <!-- Information Client -->
                        <div class="form-section">
                            <h3><i class="fas fa-user"></i> Informations Personnelles</h3>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="firstName">Prénom *</label>
                                    <input type="text" id="firstName" name="firstName" required>
                                    <span class="error-message"></span>
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Nom *</label>
                                    <input type="text" id="lastName" name="lastName" required>
                                    <span class="error-message"></span>
                                </div>
                            </div>
                            <div class="form-row full">
                                <div class="form-group">
                                    <label for="email">Adresse Email *</label>
                                    <input type="email" id="email" name="email" required>
                                    <span class="error-message"></span>
                                </div>
                            </div>
                            <div class="form-row full">
                                <div class="form-group">
                                    <label for="phone">Téléphone *</label>
                                    <input type="tel" id="phone" name="phone" required>
                                    <span class="error-message"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Adresse de Livraison -->
                        <div class="form-section">
                            <h3><i class="fas fa-map-marker-alt"></i> Adresse de Livraison</h3>
                            <div class="form-row full">
                                <div class="form-group">
                                    <label for="address">Adresse *</label>
                                    <input type="text" id="address" name="address" required>
                                    <span class="error-message"></span>
                                </div>
                            </div>
                            <div class="form-row full">
                                <div class="form-group">
                                    <label for="addressComplement">Complément d'adresse (Optionnel)</label>
                                    <input type="text" id="addressComplement" name="addressComplement">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="zipcode">Code Postal *</label>
                                    <input type="text" id="zipcode" name="zipcode" required>
                                    <span class="error-message"></span>
                                </div>
                                <div class="form-group">
                                    <label for="city">Ville *</label>
                                    <input type="text" id="city" name="city" required>
                                    <span class="error-message"></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="region">Région / État</label>
                                    <input type="text" id="region" name="region">
                                </div>
                                <div class="form-group">
                                    <label for="country">Pays *</label>
                                    <select id="country" name="country" required>
                                        <option value="">Sélectionnez un pays</option>
                                        <option value="France">France</option>
                                        <option value="Belgique">Belgique</option>
                                        <option value="Suisse">Suisse</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Allemagne">Allemagne</option>
                                        <option value="Autres">Autres</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Mode de Paiement -->
                        <div class="form-section">
                            <h3><i class="fas fa-credit-card"></i> Mode de Paiement</h3>
                            <div class="payment-methods">
                                <div class="payment-option active" onclick="selectPayment('card')">
                                    <i class="fas fa-credit-card"></i>
                                    <label>Carte Bancaire</label>
                                </div>
                                <div class="payment-option" onclick="selectPayment('paypal')">
                                    <i class="fab fa-paypal"></i>
                                    <label>PayPal</label>
                                </div>
                                <div class="payment-option" onclick="selectPayment('transfer')">
                                    <i class="fas fa-university"></i>
                                    <label>Virement</label>
                                </div>
                            </div>
                            <input type="hidden" id="paymentMethod" name="paymentMethod" value="card">

                            <!-- Détails Carte Bancaire -->
                            <div id="cardDetails" style="display: block;">
                                <div class="form-row full">
                                    <div class="form-group">
                                        <label for="cardName">Nom sur la carte *</label>
                                        <input type="text" id="cardName" name="cardName" required>
                                        <span class="error-message"></span>
                                    </div>
                                </div>
                                <div class="form-row full">
                                    <div class="form-group">
                                        <label for="cardNumber">Numéro de carte *</label>
                                        <input type="text" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" required>
                                        <span class="error-message"></span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="cardExpiry">Date d'expiration *</label>
                                        <input type="text" id="cardExpiry" name="cardExpiry" placeholder="MM/YY" required>
                                        <span class="error-message"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="cardCvc">CVV *</label>
                                        <input type="text" id="cardCvc" name="cardCvc" placeholder="123" required>
                                        <span class="error-message"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Code Promo -->
                        <div class="form-section">
                            <h3><i class="fas fa-tag"></i> Code Promo</h3>
                            <div class="coupon-input">
                                <input type="text" id="promoCode" placeholder="Entrez votre code promo (ex: TECH10)">
                                <button type="button" onclick="applyPromo()">Appliquer</button>
                            </div>
                            <div id="promoMessage" style="margin-top: 0.5rem; font-size: 0.875rem;"></div>
                        </div>
                    </form>
                </div>

                <!-- Checkout Summary -->
                <div class="checkout-summary">
                    <div class="summary-header">Résumé de Commande</div>
                    
                    <div id="cartItems">
                        <!-- Les articles seront générés par JavaScript -->
                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-row">
                        <span>Sous-total</span>
                        <span id="subtotal">0,00 €</span>
                    </div>

                    <div class="summary-row">
                        <span>Réduction</span>
                        <span id="discount" style="color: #22c55e;">0,00 €</span>
                    </div>

                    <div class="summary-row">
                        <span>Livraison</span>
                        <span id="shipping">Calculée</span>
                    </div>

                    <div class="summary-row total">
                        <span>Total à payer</span>
                        <span id="totalPrice">0,00 €</span>
                    </div>

                    <button class="btn-validate" onclick="validateCheckout()">
                        <i class="fas fa-lock"></i>
                        Confirmer la Commande
                    </button>

                    <a href="panier.php" style="display: flex; align-items: center; justify-content: center; margin-top: 1rem; color: #3b82f6; text-decoration: none; font-weight: 500;">
                        <i class="fas fa-arrow-left" style="margin-right: 0.5rem;"></i>
                        Retour au panier
                    </a>
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
                        <li><i class="fas fa-envelope"></i> contact@materiel-info.fr</li>
                        <li><i class="fas fa-phone"></i> +33 1 23 45 67 89</li>
                        <li><i class="fas fa-map-marker-alt"></i> Paris, France</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="../js/main.js"></script>
    <script src="../js/checkout.js"></script>
    <script src="../js/profil.js"></script>
</body>
</html>
