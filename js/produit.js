/* ============================================
   TECHSTORE - Page Produit JavaScript
   ============================================ */

let currentProduct = null;
let productQuantity = 1;

// ============================================
// INITIALISATION
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    // Récupérer l'ID du produit depuis l'URL
    const urlParams = new URLSearchParams(window.location.search);
    const productId = parseInt(urlParams.get('id'));

    if (productId) {
        loadProductDetail(productId);
    } else {
        // Rediriger vers le catalogue si pas d'ID
        window.location.href = 'catalogue.html';
    }
});

// ============================================
// CHARGEMENT DU PRODUIT
// ============================================

function loadProductDetail(productId) {
    currentProduct = products.find(p => p.id === productId);

    if (!currentProduct) {
        window.location.href = 'catalogue.html';
        return;
    }

    // Mettre à jour le titre de la page
    document.title = `${currentProduct.name} - TechStore`;

    // Mettre à jour le breadcrumb
    document.getElementById('breadcrumb-product-name').textContent = currentProduct.name.split(' ').slice(0, 3).join(' ');

    // Images
    document.getElementById('main-product-image').src = currentProduct.image;
    document.getElementById('main-product-image').alt = currentProduct.name;

    // Créer les thumbnails
    createThumbnails(currentProduct);

    // SKU
    document.getElementById('product-sku').textContent = `SKU: ${currentProduct.sku || generateSKU(currentProduct)}`;

    // Rating
    document.getElementById('product-stars').innerHTML = generateStars(currentProduct.rating);
    document.getElementById('product-rating').textContent = `${currentProduct.rating} (${currentProduct.reviews} avis)`;

    // Nom
    document.getElementById('product-name').textContent = currentProduct.name;

    // Prix
    document.getElementById('product-price').textContent = formatPrice(currentProduct.price);

    // Description
    const description = currentProduct.description || `Conçu pour les créateurs, ce ${currentProduct.category === 'ordinateurs' ? 'PC portable' : 'produit'} dispose de ${currentProduct.category === 'ordinateurs' ? 'deux écrans 4K OLED pour une productivité sans limite' : 'caractéristiques exceptionnelles pour une performance optimale'}.`;
    document.getElementById('product-description').textContent = description;
    document.getElementById('tab-desc-text').textContent = description;

    // Discount badge
    const discountBadge = document.getElementById('product-discount');
    if (currentProduct.discount > 0) {
        discountBadge.textContent = `-${currentProduct.discount}%`;
        discountBadge.style.display = 'block';
    } else {
        discountBadge.style.display = 'none';
    }

    // Spécifications
    loadSpecifications(currentProduct);

    // Produits similaires
    loadRelatedProducts(currentProduct);
}

function generateSKU(product) {
    const prefix = product.category.substring(0, 3).toUpperCase();
    const brand = product.brand.substring(0, 3).toUpperCase();
    const id = product.id.toString().padStart(3, '0');
    return `${prefix}-${brand}-${id}`;
}

function createThumbnails(product) {
    const container = document.getElementById('thumbnail-container');

    // Créer 3 thumbnails (image principale + 2 variantes)
    const thumbnails = [
        product.image,
        product.image.replace('w=400', 'w=400&sat=-100'), // Version grayscale pour simuler
        product.image.replace('w=400', 'w=400&blur=2')   // Version floue pour simuler
    ];

    container.innerHTML = thumbnails.map((thumb, index) => `
        <div class="thumbnail ${index === 0 ? 'active' : ''}" onclick="changeMainImage('${thumb}', this)">
            <img src="${thumb}" alt="Vue ${index + 1}">
        </div>
    `).join('');
}

function changeMainImage(src, thumbnailElement) {
    document.getElementById('main-product-image').src = src;

    // Mettre à jour la classe active
    document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
    thumbnailElement.classList.add('active');
}

function loadSpecifications(product) {
    const specsTable = document.getElementById('specs-table');

    const specs = {
        'Marque': product.brand.toUpperCase(),
        'Catégorie': product.category.charAt(0).toUpperCase() + product.category.slice(1),
        'Référence': generateSKU(product),
        'Garantie': '2 ans constructeur',
        'Disponibilité': product.stock ? 'En stock' : 'Rupture de stock'
    };

    // Ajouter des specs spécifiques selon la catégorie
    if (product.category === 'ordinateurs') {
        specs['Processeur'] = 'Intel Core i9-12900HX';
        specs['Carte graphique'] = 'NVIDIA RTX 3080 Ti';
        specs['RAM'] = '32 Go DDR5';
        specs['Stockage'] = '1 To SSD NVMe';
    } else if (product.category === 'composants') {
        specs['Type'] = product.name.includes('RTX') ? 'Carte Graphique' : 'Processeur';
        specs['Mémoire'] = product.name.includes('24GB') ? '24 Go GDDR6X' : 'N/A';
    } else if (product.category === 'peripheriques') {
        specs['Type'] = product.name.includes('Écran') || product.name.includes('Moniteur') ? 'Écran' :
                        product.name.includes('Clavier') ? 'Clavier' :
                        product.name.includes('Souris') ? 'Souris' : 'Périphérique';
        specs['Connectivité'] = product.name.includes('Sans Fil') ? 'Sans fil' : 'Filaire';
    }

    specsTable.innerHTML = Object.entries(specs).map(([key, value]) => `
        <tr>
            <td class="spec-label">${key}</td>
            <td class="spec-value">${value}</td>
        </tr>
    `).join('');
}

function loadRelatedProducts(currentProduct) {
    const grid = document.getElementById('related-products-grid');

    // Sélectionner des produits de la même catégorie
    const related = products
        .filter(p => p.category === currentProduct.category && p.id !== currentProduct.id)
        .slice(0, 4);

    if (related.length === 0) {
        // Si pas assez de produits dans la même catégorie, prendre d'autres produits
        related.push(...products.filter(p => p.id !== currentProduct.id).slice(0, 4 - related.length));
    }

    grid.innerHTML = related.map(product => `
        <div class="product-card" data-id="${product.id}">
            <div class="product-image">
                <img src="${product.image}" alt="${product.name}">
                ${product.discount > 0 ? `<span class="discount-badge">-${product.discount}%</span>` : ''}
            </div>
            <div class="product-info">
                <h4>${product.name}</h4>
                <div class="product-price">
                    ${product.oldPrice ? `<span class="old-price">${formatPrice(product.oldPrice)}</span>` : ''}
                    <span class="new-price">${formatPrice(product.price)}</span>
                </div>
                <button class="btn-add-cart" onclick="addToCart(${product.id}); showToast();">
                    <i class="fas fa-shopping-cart"></i> Ajouter
                </button>
            </div>
        </div>
    `).join('');
}

// ============================================
// QUANTITÉ
// ============================================

function updateProductQuantity(change) {
    productQuantity += change;

    if (productQuantity < 1) {
        productQuantity = 1;
    }

    document.getElementById('product-quantity').textContent = productQuantity;
}

// ============================================
// AJOUT AU PANIER
// ============================================

function addToCartFromDetail() {
    if (!currentProduct) return;

    // Ajouter le produit avec la quantité sélectionnée
    const existingItem = cart.find(item => item.id === currentProduct.id);

    if (existingItem) {
        existingItem.quantity += productQuantity;
    } else {
        cart.push({
            id: currentProduct.id,
            name: currentProduct.name,
            price: currentProduct.price,
            image: currentProduct.image,
            quantity: productQuantity
        });
    }

    saveCart();
    updateCartCount();
    showToast();
}

function buyNow() {
    addToCartFromDetail();
    window.location.href = 'panier.html';
}

// ============================================
// TOAST NOTIFICATION
// ============================================

function showToast() {
    const toast = document.getElementById('toast');
    toast.classList.add('show');

    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}

// ============================================
// TABS
// ============================================

function switchTab(tabName) {
    // Mettre à jour les boutons
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');

    // Mettre à jour le contenu
    document.querySelectorAll('.tab-panel').forEach(panel => {
        panel.classList.remove('active');
    });
    document.getElementById(`tab-${tabName}`).classList.add('active');
}

// ============================================
// UTILITAIRES
// ============================================

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
    return new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'EUR'
    }).format(price);
}
