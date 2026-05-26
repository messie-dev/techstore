/* ============================================
   TECHSTORE - Main JavaScript
   ============================================ */

// Données des produits (peuvent venir de la BDD via productsFromDB)
let products = [];
if (typeof productsFromDB !== 'undefined' && productsFromDB.length > 0) {
    products = productsFromDB;
} else {
    products = [
        {
            id: 1,
            name: "PC Portable Gamer Titan GT77 - i9 12900HX - RTX 3080 Ti",
            category: "ordinateurs",
            brand: "msi",
            price: 3499.99,
            oldPrice: 4199.99,
            discount: 17,
            image: "https://images.unsplash.com/photo-1603302576837-37561b2e2302?w=400&h=300&fit=crop",
            rating: 4.8,
            reviews: 124,
            stock: true,
            description: "PC portable gaming haut de gamme avec Intel Core i9-12900HX et NVIDIA RTX 3080 Ti. Écran 17.3\" 4K 120Hz pour une expérience gaming immersive."
        },
        {
            id: 2,
            name: "ZenBook Pro Duo 15 OLED - Double Écran Tactile",
            category: "ordinateurs",
            brand: "asus",
            price: 2599.50,
            oldPrice: 3119.40,
            discount: 17,
            image: "https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&h=300&fit=crop",
            rating: 4.6,
            reviews: 89,
            stock: true,
            description: "Conçu pour les créateurs, ce PC portable dispose de deux écrans 4K OLED pour une productivité sans limite. Processeur Intel Core i9 et RTX 3070 Ti."
        },
        {
            id: 3,
            name: "Carte Graphique RTX 4090 OC Edition 24GB",
            category: "composants",
            brand: "nvidia",
            price: 1899.00,
            oldPrice: 2278.80,
            discount: 17,
            image: "https://images.unsplash.com/photo-1591488320449-011701bb6704?w=400&h=300&fit=crop",
            rating: 4.9,
            reviews: 256,
            stock: true,
            description: "La carte graphique la plus puissante du marché. 24 Go de mémoire GDDR6X pour le gaming 4K et la création de contenu professionnelle."
        },
        {
            id: 4,
            name: "Radeon RX 7900 XTX Gaming Trio",
            category: "composants",
            brand: "amd",
            price: 1150.00,
            oldPrice: 1380.00,
            discount: 17,
            image: "https://images.unsplash.com/photo-1624705002806-5d72df19c3ad?w=400&h=300&fit=crop",
            rating: 4.7,
            reviews: 178,
            stock: true,
            description: "Carte graphique AMD haut de gamme avec architecture RDNA 3. Performance exceptionnelle pour le gaming 4K et le ray tracing."
        },
        {
            id: 5,
            name: "Écran Incurvé 34\" WQHD 144Hz",
            category: "peripheriques",
            brand: "samsung",
            price: 450.00,
            oldPrice: 540.00,
            discount: 17,
            image: "https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=400&h=300&fit=crop",
            rating: 4.5,
            reviews: 312,
            stock: true,
            description: "Écran ultra-large incurvé 34 pouces avec résolution WQHD et taux de rafraîchissement de 144Hz. Parfait pour le gaming et le multitâche."
        },
        {
            id: 6,
            name: "Moniteur ProArt 27\" 4K IPS Calibré",
            category: "peripheriques",
            brand: "asus",
            price: 599.00,
            oldPrice: 718.80,
            discount: 17,
            image: "https://images.unsplash.com/photo-1547394765-185e1e68f34e?w=400&h=300&fit=crop",
            rating: 4.8,
            reviews: 145,
            stock: true,
            description: "Moniteur professionnel 4K avec calibration d'usine et couverture 100% sRGB. Idéal pour la retouche photo et la vidéo."
        },
        {
            id: 7,
            name: "Clavier Mécanique K95 RGB Platinum - Cherry MX Speed",
            category: "peripheriques",
            brand: "corsair",
            price: 199.99,
            oldPrice: 239.99,
            discount: 17,
            image: "https://images.unsplash.com/photo-1511467687858-23d96c32e4ae?w=400&h=300&fit=crop",
            rating: 4.7,
            reviews: 423,
            stock: true,
            description: "Clavier mécanique premium avec switches Cherry MX Speed ultra-rapides. Éclairage RGB dynamique et touches macro programmables."
        },
        {
            id: 8,
            name: "Souris Sans Fil MX Master 3S - Ergonomique",
            category: "peripheriques",
            brand: "logitech",
            price: 129.99,
            oldPrice: 155.99,
            discount: 17,
            image: "https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=400&h=300&fit=crop",
            rating: 4.9,
            reviews: 567,
            stock: true,
            description: "Souris ergonomique sans fil avec défilement électromagnétique et capteur 8000 DPI. Autonomie de 70 jours."
        },
        {
            id: 9,
            name: "Processeur Intel Core i9-13900K",
            category: "composants",
            brand: "intel",
            price: 649.99,
            oldPrice: 779.99,
            discount: 17,
            image: "https://images.unsplash.com/photo-1555664424-778a69022365?w=400&h=300&fit=crop",
            rating: 4.8,
            reviews: 234,
            stock: true,
            description: "Processeur haut de gamme avec 24 cœurs et 32 threads. Fréquence jusqu'à 5.8 GHz pour des performances exceptionnelles."
        },
        {
            id: 10,
            name: "AMD Ryzen 9 7950X",
            category: "composants",
            brand: "amd",
            price: 549.99,
            oldPrice: 659.99,
            discount: 17,
            image: "https://images.unsplash.com/photo-1563770557364-bdf2b1d6f206?w=400&h=300&fit=crop",
            rating: 4.7,
            reviews: 189,
            stock: true,
            description: "Processeur 16 cœurs avec architecture Zen 4. Performance exceptionnelle pour le gaming et la création de contenu."
        },
        {
            id: 11,
            name: "PC Fixe Gamer Predator Orion 5000",
            category: "ordinateurs",
            brand: "acer",
            price: 2499.99,
            oldPrice: 2999.99,
            discount: 17,
            image: "https://images.unsplash.com/photo-1587831990711-23ca6441447b?w=400&h=300&fit=crop",
            rating: 4.6,
            reviews: 98,
            stock: true,
            description: "PC gaming fixe avec RTX 4080 et Intel Core i7-13700K. Refroidissement liquide et design RGB personnalisable."
        },
        {
            id: 12,
            name: "Casque Gaming HyperX Cloud Alpha",
            category: "peripheriques",
            brand: "hyperx",
            price: 89.99,
            oldPrice: 109.99,
            discount: 18,
            image: "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=300&fit=crop",
            rating: 4.5,
            reviews: 678,
            stock: true,
            description: "Casque gaming avec drivers double chambre pour un son cristallin. Micro détachable et confort exceptionnel."
        }
    ];
}

// Panier (stocké dans localStorage)
let cart = JSON.parse(localStorage.getItem('techstore_cart')) || [];

// ============================================
// INITIALISATION
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    initCarousel();
    loadHomeProducts();
    updateCartCount();
    updateUserButton();
});

// ============================================
// CAROUSEL
// ============================================

function initCarousel() {
    const slides = document.querySelectorAll('.carousel-slide');
    const prevBtn = document.querySelector('.carousel-prev');
    const nextBtn = document.querySelector('.carousel-next');

    if (!slides.length || !prevBtn || !nextBtn) return;

    let currentSlide = 0;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    prevBtn.addEventListener('click', prevSlide);
    nextBtn.addEventListener('click', nextSlide);

    // Auto-play
    setInterval(nextSlide, 5000);
}

// ============================================
// PRODUITS SUR LA PAGE D'ACCUEIL
// ============================================

function loadHomeProducts() {
    // Load promotions on homepage
    const promotionsGrid = document.getElementById('promotions-grid');
    if (promotionsGrid) {
        const promotions = products.slice(0, 4);
        promotionsGrid.innerHTML = promotions.map(product => createHomeProductCard(product)).join('');
    }

    // Load suggestions on homepage
    const suggestionsGrid = document.getElementById('suggestions-grid');
    if (suggestionsGrid) {
        const suggestions = products.slice(4, 8);
        suggestionsGrid.innerHTML = suggestions.map(product => createHomeProductCard(product)).join('');
    }
}

function createHomeProductCard(product) {
    return `
        <div class="product-card" data-id="${product.id}" onclick="goToProduct(${product.id})">
            <div class="product-image">
                <img src="${product.image}" alt="${product.name}">
                ${product.discount > 0 ? `<span class="discount-badge">-${product.discount}%</span>` : ''}
                <span class="stock-badge">En Stock</span>
            </div>
            <div class="product-info">
                <h4>${product.name}</h4>
                <div class="product-price">
                    ${product.oldPrice ? `<span class="old-price">${formatPrice(product.oldPrice)}</span>` : ''}
                    <span class="new-price">${formatPrice(product.price)}</span>
                </div>
                <button class="btn-add-cart" onclick="event.stopPropagation(); addToCart(${product.id}); showToast();">
                    <i class="fas fa-shopping-cart"></i> Ajouter
                </button>
            </div>
        </div>
    `;
}

function goToProduct(productId) {
    window.location.href = `pages/produit.php?id=${productId}`;
}

// ============================================
// CART FUNCTIONS
// ============================================

function addToCart(productId) {
    const product = products.find(p => p.id === productId);
    if (!product) return;

    const existingItem = cart.find(item => item.id === productId);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id: product.id,
            name: product.name,
            price: product.price,
            image: product.image,
            quantity: 1
        });
    }

    saveCart();
    updateCartCount();
}

function saveCart() {
    localStorage.setItem('techstore_cart', JSON.stringify(cart));
}

function updateCartCount() {
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);

    // Mettre à jour le lien du panier dans la navigation
    const panierLink = document.querySelector('a[href*="panier"]');
    if (panierLink) {
        const baseText = 'Panier';
        panierLink.textContent = totalItems > 0 ? `${baseText} (${totalItems})` : baseText;
    }
}

// ============================================
// TOAST NOTIFICATION
// ============================================

function showToast() {
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
            <a href="pages/panier.php" class="toast-action">Voir le panier</a>
        `;
        document.body.appendChild(toast);
    }

    toast.classList.add('show');

    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}

// ============================================
// USER BUTTON
// ============================================

function updateUserButton() {
    const user = JSON.parse(localStorage.getItem('techstore_user') || sessionStorage.getItem('techstore_user'));
    const btnConnexion = document.querySelector('.btn-connexion');

    if (user && user.isLoggedIn && btnConnexion) {
        btnConnexion.textContent = user.firstName || user.name || 'Mon Compte';
        btnConnexion.href = 'pages/profil.php';
    }
}

// ============================================
// UTILITAIRES
// ============================================

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

// ============================================
// SEARCH & TAGS
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.querySelector('.search-box input');
    const searchBtn = document.querySelector('.btn-rechercher');

    if (searchInput && searchBtn) {
        searchBtn.addEventListener('click', function() {
            const query = searchInput.value.trim();
            if (query) {
                window.location.href = `pages/catalogue.php?search=${encodeURIComponent(query)}`;
            }
        });

        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchBtn.click();
            }
        });
    }

    // Popular tags
    const tags = document.querySelectorAll('.tag');
    tags.forEach(tag => {
        tag.addEventListener('click', function() {
            const query = this.textContent;
            window.location.href = `pages/catalogue.php?search=${encodeURIComponent(query)}`;
        });
    });
});
