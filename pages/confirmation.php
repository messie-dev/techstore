<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Commande - TechStore</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .confirmation-container {
            max-width: 800px;
            margin: 3rem auto;
        }

        .confirmation-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: #d1fae5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 3rem;
            color: #059669;
            animation: scaleIn 0.5s ease-out;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
            }
            to {
                transform: scale(1);
            }
        }

        .confirmation-header h1 {
            font-size: 2rem;
            color: #111827;
            margin-bottom: 0.5rem;
        }

        .confirmation-header p {
            color: #6b7280;
            font-size: 1.025rem;
        }

        .order-details {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .detail-section {
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .detail-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .detail-section h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .detail-section h3 i {
            color: #3b82f6;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
        }

        .detail-label {
            font-size: 0.75rem;
            color: #9ca3af;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .detail-value {
            font-size: 1rem;
            color: #111827;
            font-weight: 500;
        }

        .order-number {
            background: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
        }

        .order-number .label {
            color: #6b7280;
            font-size: 0.875rem;
        }

        .order-number .number {
            font-size: 1.5rem;
            font-weight: 700;
            color: #3b82f6;
            margin-top: 0.5rem;
            font-family: 'Courier New', monospace;
        }

        .order-items {
            background: #f9fafb;
            border-radius: 8px;
            padding: 1rem;
        }

        .order-item {
            display: flex;
            gap: 1rem;
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 60px;
            height: 60px;
            border-radius: 6px;
            object-fit: cover;
            background: white;
            border: 1px solid #e5e7eb;
        }

        .item-info {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.25rem;
        }

        .item-qty {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .item-price {
            font-weight: 600;
            color: #3b82f6;
            font-size: 1rem;
        }

        .order-totals {
            background: #f9fafb;
            border-radius: 8px;
            padding: 1.5rem;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            color: #6b7280;
        }

        .total-row.final {
            font-size: 1.25rem;
            font-weight: 700;
            color: #111827;
            padding-top: 1rem;
            border-top: 2px solid #3b82f6;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            flex: 1;
            padding: 1rem;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-align: center;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #111827;
        }

        .btn-secondary:hover {
            background: #d1d5db;
        }

        .info-box {
            background: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 1rem;
            border-radius: 6px;
            margin-top: 2rem;
            color: #1e40af;
            font-size: 0.95rem;
        }

        .info-box i {
            margin-right: 0.5rem;
        }

        @media (max-width: 640px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }

            .cta-buttons {
                flex-direction: column;
            }

            .confirmation-header h1 {
                font-size: 1.5rem;
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
            <h1>Confirmation de Commande</h1>
            <p>Votre commande a été reçue avec succès</p>
        </div>
    </section>

    <!-- Confirmation Content -->
    <section class="confirmation-section">
        <div class="container">
            <div class="confirmation-container">
                <!-- Success Message -->
                <div class="confirmation-header">
                    <div class="success-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h1>Commande Confirmée!</h1>
                    <p>Merci d'avoir choisi TechStore. Votre commande a été enregistrée avec succès.</p>
                </div>

                <!-- Order Details -->
                <div class="order-details" id="orderDetails">
                    <!-- Les détails de la commande seront générés par JavaScript -->
                </div>

                <!-- Info Box -->
                <div class="info-box">
                    <i class="fas fa-info-circle"></i>
                    Un email de confirmation a été envoyé à votre adresse. Veuillez vérifier votre dossier spam en cas de réception.
                </div>

                <!-- CTA Buttons -->
                <div class="cta-buttons">
                    <a href="profil.php" class="btn btn-primary">
                        <i class="fas fa-history"></i>
                        Mes Commandes
                    </a>
                    <a href="../index.php" class="btn btn-secondary">
                        <i class="fas fa-home"></i>
                        Accueil
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
    <script src="../js/profil.js"></script>
    <script>
        // Récupérer l'ID de commande depuis l'URL
        const urlParams = new URLSearchParams(window.location.search);
        const orderId = urlParams.get('orderId');

        // Charger et afficher la commande
        document.addEventListener('DOMContentLoaded', function() {
            if (orderId) {
                displayOrderDetails(orderId);
            } else {
                document.getElementById('orderDetails').innerHTML = '<p style="color: #ef4444;">Commande non trouvée</p>';
            }
        });

        function displayOrderDetails(orderId) {
            const orders = JSON.parse(localStorage.getItem('techstore_orders')) || [];
            const order = orders.find(o => o.id === orderId);

            if (!order) {
                document.getElementById('orderDetails').innerHTML = '<p style="color: #ef4444;">Commande non trouvée</p>';
                return;
            }

            // Afficher les numéros de commande
            let detailsHTML = `
                <div class="order-number">
                    <div class="label">Numéro de Commande</div>
                    <div class="number">${order.id}</div>
                </div>
            `;

            // Informations client
            detailsHTML += `
                <div class="detail-section">
                    <h3><i class="fas fa-user"></i> Informations Personnelles</h3>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-label">Nom Complet</div>
                            <div class="detail-value">${order.customer.firstName} ${order.customer.lastName}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Email</div>
                            <div class="detail-value">${order.customer.email}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Téléphone</div>
                            <div class="detail-value">${order.customer.phone}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Date de Commande</div>
                            <div class="detail-value">${order.date}</div>
                        </div>
                    </div>
                </div>
            `;

            // Adresse de livraison
            detailsHTML += `
                <div class="detail-section">
                    <h3><i class="fas fa-map-marker-alt"></i> Adresse de Livraison</h3>
                    <div class="detail-item">
                        <div class="detail-label">Adresse</div>
                        <div class="detail-value">${order.customer.address}</div>
                    </div>
                    <div class="detail-grid" style="margin-top: 1rem;">
                        <div class="detail-item">
                            <div class="detail-label">Code Postal</div>
                            <div class="detail-value">${order.customer.zipcode}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Ville</div>
                            <div class="detail-value">${order.customer.city}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Pays</div>
                            <div class="detail-value">${order.customer.country}</div>
                        </div>
                    </div>
                </div>
            `;

            // Articles commandés
            detailsHTML += `
                <div class="detail-section">
                    <h3><i class="fas fa-box"></i> Produits Commandés</h3>
                    <div class="order-items">
            `;

            order.items.forEach(item => {
                detailsHTML += `
                    <div class="order-item">
                        <img src="${item.image}" alt="${item.name}" class="item-image">
                        <div class="item-info">
                            <div class="item-name">${item.name}</div>
                            <div class="item-qty">Quantité: ${item.quantity} × ${item.price.toFixed(2)} €</div>
                        </div>
                        <div class="item-price">${(item.price * item.quantity).toFixed(2)} €</div>
                    </div>
                `;
            });

            detailsHTML += `
                    </div>
                </div>
            `;

            // Résumé financier
            detailsHTML += `
                <div class="detail-section">
                    <h3><i class="fas fa-calculator"></i> Résumé Financier</h3>
                    <div class="order-totals">
                        <div class="total-row">
                            <span>Sous-total</span>
                            <span>${order.totals.subtotal.toFixed(2)} €</span>
                        </div>
                        ${order.totals.discount !== 0 ? `
                            <div class="total-row">
                                <span>Réduction</span>
                                <span style="color: #22c55e;">-${Math.abs(order.totals.discount).toFixed(2)} €</span>
                            </div>
                        ` : ''}
                        <div class="total-row">
                            <span>Livraison</span>
                            <span>${order.totals.shipping === 0 ? 'OFFERTE' : order.totals.shipping.toFixed(2) + ' €'}</span>
                        </div>
                        <div class="total-row final">
                            <span>Total à Payer</span>
                            <span>${order.totals.total.toFixed(2)} €</span>
                        </div>
                    </div>
                </div>
            `;

            // Mode de paiement
            detailsHTML += `
                <div class="detail-section">
                    <h3><i class="fas fa-credit-card"></i> Mode de Paiement</h3>
                    <div class="detail-item">
                        <div class="detail-label">Méthode</div>
                        <div class="detail-value">
                            ${order.payment.method === 'card' ? 'Carte Bancaire' : order.payment.method === 'paypal' ? 'PayPal' : 'Virement Bancaire'}
                            ${order.payment.cardLast4 ? ` (se terminant par ${order.payment.cardLast4})` : ''}
                        </div>
                    </div>
                </div>
            `;

            document.getElementById('orderDetails').innerHTML = detailsHTML;
        }
    </script>
</body>
</html>
