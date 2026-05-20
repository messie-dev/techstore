<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte - TechStore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f8f9fa;
            color: #1a1a2e;
            line-height: 1.6;
        }

        /* Header */
        .header {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2563eb;
            text-decoration: none;
        }

        .nav-center {
            display: flex;
            gap: 2rem;
        }

        .nav-center a {
            text-decoration: none;
            color: #374151;
            font-weight: 500;
            transition: color 0.2s;
            position: relative;
        }

        .nav-center a:hover {
            color: #2563eb;
        }

        .cart-link {
            position: relative;
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -10px;
            background: #2563eb;
            color: white;
            font-size: 0.7rem;
            font-weight: 600;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .account-dropdown {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            color: #374151;
            font-weight: 500;
        }

        /* Main Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .page-title h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 0.5rem;
        }

        .page-title p {
            color: #6b7280;
            font-size: 1rem;
            max-width: 600px;
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            border: 1px solid #fca5a5;
            background: #fff;
            color: #dc2626;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-logout:hover {
            background: #fef2f2;
        }

        /* Main Layout */
        .main-layout {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 2rem;
        }

        /* Sidebar Card */
        .profile-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .profile-header {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            height: 100px;
            position: relative;
        }

        .profile-avatar {
            position: absolute;
            bottom: -40px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 100px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: #2563eb;
            border: 4px solid #fff;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .camera-icon {
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 28px;
            height: 28px;
            background: #f3f4f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            color: #6b7280;
            cursor: pointer;
            border: 2px solid #fff;
        }

        .profile-info {
            padding: 3rem 1.5rem 1.5rem;
            text-align: center;
        }

        .profile-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        .profile-status {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            background: #d1fae5;
            color: #059669;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .profile-details {
            padding: 1.5rem;
            border-top: 1px solid #f3f4f6;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            color: #6b7280;
            font-size: 0.9rem;
        }

        .detail-item i {
            color: #2563eb;
            width: 20px;
        }

        /* Sidebar Menu */
        .sidebar-menu {
            margin-top: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            border-radius: 10px;
            cursor: pointer;
            color: #4b5563;
            font-weight: 500;
            transition: all 0.2s;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
            font-size: 0.95rem;
        }

        .menu-item:hover {
            background: #f3f4f6;
            color: #2563eb;
        }

        .menu-item.active {
            background: #2563eb;
            color: #fff;
        }

        .menu-item i {
            width: 20px;
            text-align: center;
        }

        /* Content Cards */
        .content-card {
            background: #fff;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            display: none;
        }

        .content-card.active {
            display: block;
        }

        .card-header {
            margin-bottom: 1.5rem;
        }

        .card-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.25rem;
        }

        .card-header p {
            color: #6b7280;
            font-size: 0.9rem;
        }

        /* Forms */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-group input {
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 0.95rem;
            background: #f9fafb;
            transition: all 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #2563eb;
            background: #fff;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #2563eb;
            color: #fff;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 1.5rem;
            transition: background 0.2s;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        /* Orders Section */
        .orders-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .orders-header h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #111827;
        }

        .orders-count {
            background: #f3f4f6;
            color: #6b7280;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .order-item {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            margin-bottom: 1rem;
            overflow: hidden;
        }

        .order-summary {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto;
            align-items: center;
            padding: 1.25rem;
            cursor: pointer;
            transition: background 0.2s;
        }

        .order-summary:hover {
            background: #f9fafb;
        }

        .order-col label {
            font-size: 0.75rem;
            color: #9ca3af;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.05em;
            display: block;
            margin-bottom: 0.25rem;
        }

        .order-col .value {
            font-weight: 600;
            color: #111827;
        }

        .order-col .date {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .order-status {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: #fef3c7;
            color: #d97706;
            padding: 0.4rem 0.875rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .order-status i {
            font-size: 0.7rem;
        }

        .expand-icon {
            color: #9ca3af;
            transition: transform 0.3s;
        }

        .order-item.expanded .expand-icon {
            transform: rotate(180deg);
        }

        .order-details {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            background: #f9fafb;
        }

        .order-item.expanded .order-details {
            max-height: 500px;
        }

        .order-products {
            padding: 1.5rem;
        }

        .product-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-image {
            width: 80px;
            height: 80px;
            background: #fff;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #e5e7eb;
        }

        .product-info {
            flex: 1;
        }

        .product-name {
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.25rem;
        }

        .product-qty {
            color: #6b7280;
            font-size: 0.875rem;
        }

        .product-price {
            font-weight: 700;
            color: #111827;
            font-size: 1.1rem;
        }

        .product-actions {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            align-items: flex-end;
        }

        .btn-reorder {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border: 1px solid #e5e7eb;
            background: #fff;
            border-radius: 6px;
            font-size: 0.875rem;
            color: #374151;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-reorder:hover {
            border-color: #2563eb;
            color: #2563eb;
        }

        .invoice-link {
            color: #2563eb;
            font-size: 0.875rem;
            text-decoration: none;
            margin-top: 0.5rem;
        }

        .invoice-link:hover {
            text-decoration: underline;
        }

        /* Footer */
        .footer {
            background: #111827;
            color: #fff;
            padding: 3rem 2rem 1.5rem;
            margin-top: 4rem;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 3rem;
        }

        .footer-section h4 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1.25rem;
            color: #f9fafb;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section li {
            margin-bottom: 0.75rem;
        }

        .footer-section a {
            color: #9ca3af;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        .footer-section a:hover {
            color: #fff;
        }

        .footer-contact p {
            color: #9ca3af;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            width: 36px;
            height: 36px;
            background: #374151;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            transition: background 0.2s;
        }

        .social-links a:hover {
            background: #2563eb;
        }

        .footer-bottom {
            max-width: 1400px;
            margin: 2rem auto 0;
            padding-top: 1.5rem;
            border-top: 1px solid #374151;
            text-align: center;
            color: #6b7280;
            font-size: 0.875rem;
        }

        /* Notification */
        .notification {
            position: fixed;
            top: 80px;
            right: 2rem;
            background: #dbeafe;
            color: #1e40af;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            border-left: 4px solid #2563eb;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.3s;
            z-index: 1000;
        }

        .notification.show {
            opacity: 1;
            transform: translateX(0);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .main-layout {
                grid-template-columns: 1fr;
            }
            
            .footer-content {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .order-summary {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
            }
            
            .nav-center {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <a href="../index.php" class="logo">⬡ TechStore</a>
            
            <nav class="nav-center">
                <a href="../index.php">Accueil</a>
                <a href="catalogue.php">Catalogue</a>
                <a href="panier.php" class="cart-link">
                    Panier
                    <span class="cart-badge">2</span>
                </a>
            </nav>
            
            <div class="nav-right">
                <div class="account-dropdown" id="account-info">
                    <i class="fas fa-user"></i>
                    <span id="account-name">Mon Compte</span>
                    <i class="fas fa-chevron-down" style="font-size: 0.75rem;"></i>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title">
                <h1>Mon Compte</h1>
                <p>Gérez vos informations personnelles, vos préférences de sécurité et vos adresses de livraison pour une expérience d'achat fluide.</p>
            </div>
            <button class="btn-logout" id="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                Déconnexion
            </button>
        </div>

        <!-- Main Layout -->
        <div class="main-layout">
            <!-- Sidebar -->
            <aside class="sidebar">
                <div class="profile-card">
                    <div class="profile-header">
                        <div class="profile-avatar" id="profile-avatar">
                            QU
                            <div class="camera-icon">
                                <i class="fas fa-camera"></i>
                            </div>
                        </div>
                    </div>
                    <div class="profile-info">
                        <div class="profile-name" id="profile-username">@Username</div>
                        <span class="profile-status">
                            <i class="fas fa-check-circle"></i>
                            Compte Actif
                        </span>
                    </div>
                    <div class="profile-details">
                        <div class="detail-item">
                            <i class="fas fa-envelope"></i>
                            <span id="profile-email">email@example.com</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-phone"></i>
                            <span id="profile-phone">Non renseigné</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-shield-alt"></i>
                            <span>Membre depuis 2026</span>
                        </div>
                    </div>
                </div>

                <nav class="sidebar-menu">
                    <button class="menu-item active" onclick="showTab('profile')">
                        <i class="fas fa-user"></i>
                        Profil Public
                    </button>
                    <button class="menu-item" onclick="showTab('address')">
                        <i class="fas fa-map-marker-alt"></i>
                        Adresse de Livraison
                    </button>
                    <button class="menu-item" onclick="showTab('orders')">
                        <i class="fas fa-box"></i>
                        Mes Commandes
                    </button>
                </nav>
            </aside>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Profile Tab -->
                <div id="profile" class="content-card active">
                    <div class="card-header">
                        <h2>Informations Personnelles</h2>
                        <p>Mettez à jour vos informations personnelles et vos coordonnées.</p>
                    </div>
                    <form id="profileForm">
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Prénom</label>
                                <input type="text" id="input-firstname" placeholder="Votre prénom">
                            </div>
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text" id="input-lastname" placeholder="Votre nom">
                            </div>
                            <div class="form-group">
                                <label>Nom d'utilisateur</label>
                                <input type="text" id="input-username" placeholder="Votre nom d'utilisateur">
                            </div>
                            <div class="form-group">
                                <label>Adresse Email</label>
                                <input type="email" id="input-email" placeholder="votre@email.com">
                            </div>
                            <div class="form-group full-width">
                                <label>Téléphone</label>
                                <input type="tel" id="input-phone" placeholder="+33 6 12 34 56 78">
                            </div>
                        </div>
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-save"></i>
                            Enregistrer
                        </button>
                    </form>
                </div>

                <!-- Address Tab -->
                <div id="address" class="content-card">
                    <div class="card-header">
                        <h2>Adresse de Livraison</h2>
                        <p>Gérez votre adresse principale pour la livraison de vos commandes.</p>
                    </div>
                    <form id="addressForm">
                        <div class="form-grid">
                            <div class="form-group full-width">
                                <label>Adresse (Ligne 1)</label>
                                <input type="text" placeholder="Votre adresse">
                            </div>
                            <div class="form-group full-width">
                                <label>Complément d'adresse (Optionnel)</label>
                                <input type="text" placeholder="Bâtiment, étage...">
                            </div>
                            <div class="form-group">
                                <label>Code Postal</label>
                                <input type="text" placeholder="75001">
                            </div>
                            <div class="form-group">
                                <label>Ville</label>
                                <input type="text" placeholder="Paris">
                            </div>
                            <div class="form-group">
                                <label>Région / État</label>
                                <input type="text" placeholder="Île-de-France">
                            </div>
                            <div class="form-group">
                                <label>Pays</label>
                                <input type="text" placeholder="France">
                            </div>
                        </div>
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-save"></i>
                            Mettre à jour
                        </button>
                    </form>
                </div>

                <!-- Orders Tab -->
                <div id="orders" class="content-card">
                    <div class="orders-header">
                        <h2>Mes Commandes</h2>
                        <span class="orders-count">Total: 0</span>
                    </div>
                    
                    <div class="orders-list" id="orders-list">
                        <p style="text-align: center; color: #6b7280; padding: 2rem;">Aucune commande pour le moment</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>Navigation Rapide</h4>
                <ul>
                    <li><a href="../index.php">Accueil</a></li>
                    <li><a href="catalogue.php">Catalogue Produits</a></li>
                    <li><a href="panier.php">Mon Panier</a></li>
                    <li><a href="connexion.php">Espace Client</a></li>
                    <li><a href="profil.php">Mon Compte</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Informations Légales</h4>
                <ul>
                    <li><a href="#">Mentions Légales</a></li>
                    <li><a href="#">Politique de Confidentialité</a></li>
                    <li><a href="#">Conditions Générales de Vente</a></li>
                    <li><a href="#">Politique de Retour</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Service Client</h4>
                <ul>
                    <li><a href="#">Service Client</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Suivi de Commande</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section footer-contact">
                <h4>Contact & Réseaux</h4>
                <p><i class="fas fa-envelope"></i> contact@materiel-info.fr</p>
                <p><i class="fas fa-phone"></i> +33 1 23 45 67 89</p>
                <p><i class="fas fa-map-marker-alt"></i> Paris, France</p>
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
    </footer>

    <!-- Notification -->
    <div id="notification" class="notification">
        <i class="fas fa-info-circle"></i>
        <span id="notificationText">Notification</span>
    </div>

    <script src="../js/profil.js"></script>
    <script>
        // Initialiser le profil au chargement
        document.addEventListener('DOMContentLoaded', function() {
            loadUserData();
            setupEventListeners();
        });

        // Charger les données utilisateur
        function loadUserData() {
            const userDataStr = localStorage.getItem('techstore_user') || sessionStorage.getItem('techstore_user');
            
            if (!userDataStr) {
                window.location.href = 'connexion.php';
                return;
            }

            try {
                const userData = JSON.parse(userDataStr);
                
                // Afficher le nom d'utilisateur
                const name = userData.firstName && userData.lastName 
                    ? userData.firstName + ' ' + userData.lastName 
                    : userData.name || userData.email.split('@')[0];
                
                document.getElementById('account-name').textContent = name;
                document.getElementById('profile-username').textContent = '@' + (userData.email.split('@')[0]);
                document.getElementById('profile-email').textContent = userData.email;
                document.getElementById('profile-phone').textContent = userData.phone || 'Non renseigné';
                
                // Afficher avatar
                const avatarInitials = name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);
                const avatarEl = document.getElementById('profile-avatar');
                avatarEl.textContent = avatarInitials;
                
                // Remplir les formulaires
                document.getElementById('input-firstname').value = userData.firstName || '';
                document.getElementById('input-lastname').value = userData.lastName || '';
                document.getElementById('input-username').value = userData.email.split('@')[0];
                document.getElementById('input-email').value = userData.email;
                document.getElementById('input-phone').value = userData.phone || '';
                
            } catch (error) {
                console.error('Erreur chargement profil:', error);
                window.location.href = 'connexion.php';
            }
        }

        // Configurer les événements
        function setupEventListeners() {
            document.getElementById('profileForm').addEventListener('submit', function(e) {
                e.preventDefault();
                showNotification('Profil mis à jour avec succès');
            });

            document.getElementById('addressForm').addEventListener('submit', function(e) {
                e.preventDefault();
                showNotification('Adresse mise à jour avec succès');
            });

            document.getElementById('logout-btn').addEventListener('click', function() {
                handleLogout();
            });
        }

        // Tab Navigation
        function showTab(tabName) {
            document.querySelectorAll('.content-card').forEach(card => {
                card.classList.remove('active');
            });
            
            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('active');
            });
            
            document.getElementById(tabName).classList.add('active');
            event.target.closest('.menu-item').classList.add('active');
            
            if (tabName === 'orders') {
                showNotification('Historique des commandes bientôt disponible');
            }
        }

        // Toggle Order Details
        function toggleOrder(element) {
            const orderItem = element.closest('.order-item');
            orderItem.classList.toggle('expanded');
        }

        // Notification System
        function showNotification(message) {
            const notification = document.getElementById('notification');
            const notificationText = document.getElementById('notificationText');
            
            notificationText.textContent = message;
            notification.classList.add('show');
            
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        // Déconnexion
        function handleLogout() {
            if (confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
                localStorage.removeItem('techstore_user');
                sessionStorage.removeItem('techstore_user');
                showNotification('Déconnexion en cours...');
                setTimeout(() => {
                    window.location.href = '../index.php';
                }, 1000);
            }
        }
    </script>
</body>
</html>
