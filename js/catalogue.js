/* ============================================
   TECHSTORE - Catalogue JavaScript
   ============================================ */

let filteredProducts = [...products];
let currentView = 'grid';

// ============================================
// INITIALISATION
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    // Récupérer les paramètres de l'URL
    const urlParams = new URLSearchParams(window.location.search);
    const searchQuery = urlParams.get('search');

    if (searchQuery) {
        document.getElementById('sidebar-search').value = searchQuery;
    }

    // Charger les produits
    loadCatalogueProducts();

    // Mettre à jour le prix max
    document.getElementById('price-range').addEventListener('input', function() {
        const val = parseInt(this.value);
        document.getElementById('price-max').textContent = val >= 2000000 ? '2 000 000 F+' : val.toLocaleString('fr-FR') + ' F';
    });
});

// ============================================
// CHARGEMENT DES PRODUITS
// ============================================

function loadCatalogueProducts() {
    const grid = document.getElementById('catalogue-grid');
    const countElement = document.getElementById('results-count');

    if (!grid) return;

    // Appliquer les filtres
    applyFilters();

    // Mettre à jour le compteur
    if (countElement) {
        countElement.textContent = `${filteredProducts.length} résultat${filteredProducts.length > 1 ? 's' : ''} trouvé${filteredProducts.length > 1 ? 's' : ''}`;
    }

    // Afficher les produits
    if (filteredProducts.length === 0) {
        grid.innerHTML = `
            <div class="no-results" style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                <i class="fas fa-search" style="font-size: 3rem; color: #e5e7eb; margin-bottom: 20px;"></i>
                <h3>Aucun produit trouvé</h3>
                <p style="color: #6b7280;">Essayez de modifier vos critères de recherche</p>
            </div>
        `;
    } else {
        grid.innerHTML = filteredProducts.map(product => createProductCard(product)).join('');
    }
}

function createProductCard(product) {
    return `
        <div class="product-card" data-id="${product.id}" onclick="goToProduct(${product.id})">
            <div class="product-image">
                <img src="${product.image}" alt="${product.name}">
                ${product.discount > 0 ? `<span class="discount-badge">-${product.discount}%</span>` : ''}
            </div>
            <div class="product-info">
                <div class="product-sku">${generateSKU(product)}</div>
                <h4>${product.name}</h4>
                <div class="product-rating">
                    ${generateStars(product.rating)}
                    <span>(${product.reviews})</span>
                </div>
                <div class="product-price">
                    <span class="new-price">${formatPrice(product.price)}</span>
                </div>
                <button class="btn-add-cart" onclick="event.stopPropagation(); addToCart(${product.id}); showToast();">
                    <i class="fas fa-shopping-cart"></i>
                </button>
            </div>
        </div>
    `;
}

function generateSKU(product) {
    const prefix = product.category.substring(0, 3).toUpperCase();
    const brand = product.brand.substring(0, 3).toUpperCase();
    const id = product.id.toString().padStart(3, '0');
    return `${prefix}-${brand}-${id}`;
}

function generateStars(rating) {
    let stars = '';
    for (let i = 1; i <= 5; i++) {
        if (i <= Math.floor(rating)) {
            stars += '<i class="fas fa-star"></i>';
        } else if (i === Math.ceil(rating) && rating % 1 !== 0) {
            stars += '<i class="fas fa-star-half-alt"></i>';
        } else {
            stars += '<i class="far fa-star"></i>';
        }
    }
    return stars;
}

function formatPrice(price) {
    if (price > 10000) {
        return new Intl.NumberFormat('fr-FR', {
            style: 'currency',
            currency: 'XOF',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(price);
    }
    return new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'EUR'
    }).format(price);
}

// ============================================
// FILTRES
// ============================================

function filterProducts() {
    loadCatalogueProducts();
}

function applyFilters() {
    // Récupérer les valeurs des filtres
    const searchQuery = document.getElementById('sidebar-search')?.value.toLowerCase() || '';
    const maxPrice = parseInt(document.getElementById('price-range')?.value || 2000000);
    const inStockOnly = document.getElementById('in-stock-only')?.checked || false;

    // Récupérer les catégories sélectionnées
    const selectedCategories = Array.from(document.querySelectorAll('.filter-section:nth-child(2) input:checked')).map(cb => cb.value);

    // Récupérer les marques sélectionnées
    const selectedBrands = Array.from(document.querySelectorAll('.filter-section:nth-child(4) input:checked')).map(cb => cb.value);

    // Filtrer les produits
    filteredProducts = products.filter(product => {
        // Filtre par recherche
        if (searchQuery && !product.name.toLowerCase().includes(searchQuery)) {
            return false;
        }

        // Filtre par prix
        if (product.price > maxPrice) {
            return false;
        }

        // Filtre par stock
        if (inStockOnly && !product.stock) {
            return false;
        }

        // Filtre par catégorie
        if (selectedCategories.length > 0) {
            const categoryMatch = selectedCategories.some(cat =>
                product.category === cat ||
                (cat === 'pc-portables' && product.category === 'ordinateurs') ||
                (cat === 'cartes-graphiques' && product.name.toLowerCase().includes('carte graphique')) ||
                (cat === 'ecrans' && (product.name.toLowerCase().includes('écran') || product.name.toLowerCase().includes('moniteur')))
            );
            if (!categoryMatch) return false;
        }

        // Filtre par marque
        if (selectedBrands.length > 0 && !selectedBrands.includes(product.brand)) {
            return false;
        }

        return true;
    });

    // Appliquer le tri
    sortProducts(false);
}

// ============================================
// TRI
// ============================================

function sortProducts(reload = true) {
    const sortValue = document.getElementById('sort-select')?.value || 'popular';

    switch (sortValue) {
        case 'price-asc':
            filteredProducts.sort((a, b) => a.price - b.price);
            break;
        case 'price-desc':
            filteredProducts.sort((a, b) => b.price - a.price);
            break;
        case 'newest':
            filteredProducts.sort((a, b) => b.id - a.id);
            break;
        default:
            filteredProducts.sort((a, b) => b.reviews - a.reviews);
    }

    if (reload) {
        loadCatalogueProducts();
    }
}

// ============================================
// VUE
// ============================================

function setView(view) {
    currentView = view;

    // Mettre à jour les boutons
    document.querySelectorAll('.view-btn').forEach(btn => btn.classList.remove('active'));
    event.currentTarget.classList.add('active');

    // Recharger les produits
    loadCatalogueProducts();
}

// ============================================
// NAVIGATION PRODUIT
// ============================================

function goToProduct(productId) {
    window.location.href = `produit.php?id=${productId}`;
}

// ============================================
// TOAST NOTIFICATION
// ============================================

function showToast() {
    // Créer le toast s'il n'existe pas
    let toast = document.getElementById('toast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'toast';
        toast.className = 'toast';
        toast.innerHTML = `
            <i class="fas fa-check-circle"></i>
            <div class="toast-content">
                <span class="toast-title">Produit ajouté au panier avec succès</span>
            </div>
            <a href="panier.php" class="toast-action">Voir le panier</a>
        `;
        document.body.appendChild(toast);
    }

    toast.classList.add('show');

    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}
