<?php
require_once __DIR__ . '/../bdd.php';

$stmt = $pdo->query("SELECT p.*, c.nom as categorie_nom FROM produits p LEFT JOIN categories c ON p.categorie_id = c.id WHERE p.stock > 0 ORDER BY p.date_creation DESC");
$dbProduits = $stmt->fetchAll(PDO::FETCH_ASSOC);

$jsProduits = array_map(function ($p) {
    $image = $p['image'] ?? '';
    if ($image && strpos($image, 'http') !== 0) {
        $image = '../' . $image;
    }
    if (!$image) {
        $image = 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?w=400&h=300&fit=crop';
    }
    return [
        'id' => (int)$p['id'],
        'name' => $p['nom'],
        'category' => strtolower($p['categorie_nom'] ?? ''),
        'brand' => strtolower($p['marque'] ?? ''),
        'price' => (float)$p['prix'],
        'oldPrice' => null,
        'discount' => 0,
        'image' => $image,
        'rating' => 4.5,
        'reviews' => 0,
        'stock' => (int)$p['stock'] > 0,
        'description' => $p['description'] ?? '',
    ];
}, $dbProduits);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue - TechStore</title>
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
                    <li><a href="catalogue.php" class="active">Catalogue</a></li>
                    <li><a href="panier.php">Panier</a></li>
                </ul>
                <a href="connexion.php" class="btn-connexion">Connexion</a>
            </nav>
        </div>
    </header>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <nav class="breadcrumb-nav" style="justify-content: center; margin-bottom: 15px; color: rgba(255,255,255,0.8);">
                <a href="../index.php"><i class="fas fa-home"></i></a>
                <span class="separator">></span>
                <span>Catalogue</span>
            </nav>
            <h1>Catalogue Produits</h1>
            <p>Explorez notre large gamme de matériel informatique professionnel, composants et accessoires de haute performance.</p>
        </div>
    </section>

    <!-- Catalogue Section -->
    <section class="catalogue-page">
        <div class="container">
            <div class="catalogue-layout">
                <!-- Sidebar Filters -->
                <aside class="catalogue-sidebar">
                    <div class="sidebar-search">
                        <input type="text" id="sidebar-search" placeholder="Rechercher un produit, une marque, une catégorie...">
                    </div>

                    <!-- Categories Filter -->
                    <div class="filter-section">
                        <h4>Catégories</h4>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="checkbox" value="ordinateurs" onchange="filterProducts()">
                                <span>Ordinateurs</span>
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="composants" onchange="filterProducts()">
                                <span>Composants</span>
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="peripheriques" onchange="filterProducts()">
                                <span>Périphériques</span>
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="pc-portables" onchange="filterProducts()">
                                <span>PC Portables</span>
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="cartes-graphiques" onchange="filterProducts()">
                                <span>Cartes Graphiques</span>
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="ecrans" onchange="filterProducts()">
                                <span>Écrans</span>
                            </label>
                        </div>
                    </div>

                    <!-- Price Filter -->
                    <div class="filter-section">
                        <h4>Prix (FCFA)</h4>
                        <div class="price-slider">
                            <input type="range" id="price-range" min="0" max="2000000" value="2000000" onchange="filterProducts()">
                            <div class="price-values">
                                <span>0 F</span>
                                <span id="price-max">2 000 000 F+</span>
                            </div>
                        </div>
                    </div>

                    <!-- Brands Filter -->
                    <div class="filter-section">
                        <h4>Marques</h4>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="checkbox" value="asus" onchange="filterProducts()">
                                <span>Asus</span>
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="msi" onchange="filterProducts()">
                                <span>MSI</span>
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="nvidia" onchange="filterProducts()">
                                <span>NVIDIA</span>
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="amd" onchange="filterProducts()">
                                <span>AMD</span>
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="intel" onchange="filterProducts()">
                                <span>Intel</span>
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="logitech" onchange="filterProducts()">
                                <span>Logitech</span>
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="corsair" onchange="filterProducts()">
                                <span>Corsair</span>
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="samsung" onchange="filterProducts()">
                                <span>Samsung</span>
                            </label>
                        </div>
                    </div>

                    <!-- Other Filters -->
                    <div class="filter-section">
                        <h4>Autres filtres</h4>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="checkbox" id="in-stock-only" onchange="filterProducts()">
                                <span>En stock uniquement</span>
                            </label>
                        </div>
                    </div>
                </aside>

                <!-- Products Grid -->
                <div class="catalogue-content">
                    <div class="catalogue-header">
                        <p id="results-count">12 résultats trouvés</p>
                        <div class="view-sort">
                            <div class="view-options">
                                <button class="view-btn active" onclick="setView('grid')">
                                    <i class="fas fa-th"></i>
                                </button>
                                <button class="view-btn" onclick="setView('list')">
                                    <i class="fas fa-list"></i>
                                </button>
                            </div>
                            <select class="sort-select" id="sort-select" onchange="sortProducts()">
                                <option value="popular">Par popularité</option>
                                <option value="price-asc">Prix croissant</option>
                                <option value="price-desc">Prix décroissant</option>
                                <option value="newest">Nouveautés</option>
                            </select>
                        </div>
                    </div>

                    <div class="products-grid" id="catalogue-grid">
                        <!-- Products will be loaded by JavaScript -->
                    </div>
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

    <script>
        const productsFromDB = <?= json_encode($jsProduits) ?>;
    </script>
    <script src="../js/main.js"></script>
    <script src="../js/catalogue.js"></script>
</body>
</html>
