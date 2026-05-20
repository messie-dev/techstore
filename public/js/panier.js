/* ============================================
   TECHSTORE - Panier JavaScript
   ============================================ */

// Variables
let discount = 0;
let promoCodeApplied = false;

// ============================================
// INITIALISATION
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    loadCartItems();
    loadRecommendedProducts();
});

// ============================================
// CHARGEMENT DU PANIER
// ============================================

function loadCartItems() {
    const emptyCart = document.getElementById('empty-cart');
    const cartWithItems = document.getElementById('cart-with-items');
    const recommendedSection = document.getElementById('recommended-section');

    if (cart.length === 0) {
        // Afficher le panier vide
        if (emptyCart) emptyCart.style.display = 'block';
        if (cartWithItems) cartWithItems.style.display = 'none';
        if (recommendedSection) recommendedSection.style.display = 'none';
        return;
    }

    // Afficher le panier avec articles
    if (emptyCart) emptyCart.style.display = 'none';
    if (cartWithItems) cartWithItems.style.display = 'grid';
    if (recommendedSection) recommendedSection.style.display = 'block';

    const container = document.getElementById('cart-items-container');
    if (container) {
        container.innerHTML = cart.map(item => createCartItemHTML(item)).join('');
    }

    updateSummary();
}

function createCartItemHTML(item) {
    const itemTotal = item.price * item.quantity;

    return `
        <div class="cart-item" data-id="${item.id}">
            <div class="cart-item-image">
                <img src="${item.image}" alt="${item.name}">
            </div>
            <div class="cart-item-info">
                <h4>${item.name}</h4>
                <p>En stock</p>
            </div>
            <div class="quantity-control">
                <button onclick="updateQuantity(${item.id}, -1)">
                    <i class="fas fa-minus"></i>
                </button>
                <span>${item.quantity}</span>
                <button onclick="updateQuantity(${item.id}, 1)">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <div class="cart-item-price">${formatPrice(itemTotal)}</div>
            <button class="btn-remove" onclick="removeFromCart(${item.id})">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `;
}

// ============================================
// MISE À JOUR DU RÉCAPITULATIF
// ============================================

function updateSummary() {
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const tax = subtotal * 0.20;
    const total = subtotal + tax - discount;

    const subtotalElement = document.getElementById('subtotal');
    const taxElement = document.getElementById('tax');
    const discountElement = document.getElementById('discount');
    const discountRow = document.getElementById('discount-row');
    const totalElement = document.getElementById('total');

    if (subtotalElement) subtotalElement.textContent = formatPrice(subtotal);
    if (taxElement) taxElement.textContent = formatPrice(tax);

    if (discount > 0) {
        if (discountElement) discountElement.textContent = `-${formatPrice(discount)}`;
        if (discountRow) discountRow.style.display = 'flex';
    } else {
        if (discountRow) discountRow.style.display = 'none';
    }

    if (totalElement) totalElement.textContent = formatPrice(total);
}

// ============================================
// QUANTITÉ
// ============================================

function updateQuantity(productId, change) {
    const item = cart.find(item => item.id === productId);
    if (!item) return;

    item.quantity += change;

    if (item.quantity <= 0) {
        removeFromCart(productId);
        return;
    }

    saveCart();
    updateCartCount();
    loadCartItems();
}

// ============================================
// SUPPRESSION
// ============================================

function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    saveCart();
    updateCartCount();
    loadCartItems();
}

// ============================================
// VIDER LE PANIER
// ============================================

function clearCart() {
    if (confirm('Êtes-vous sûr de vouloir vider votre panier ?')) {
        cart = [];
        saveCart();
        updateCartCount();
        loadCartItems();
    }
}

// ============================================
// CODE PROMO
// ============================================

function applyPromoCode() {
    const input = document.getElementById('promo-input');
    const code = input.value.trim().toUpperCase();

    if (!code) {
        showNotification('Veuillez entrer un code promo');
        return;
    }

    if (promoCodeApplied) {
        showNotification('Un code promo a déjà été appliqué');
        return;
    }

    // Codes promo valides
    const validCodes = {
        'TECH10': 0.10,
        'WELCOME15': 0.15,
        'FLASH20': 0.20
    };

    if (validCodes[code]) {
        const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        discount = subtotal * validCodes[code];
        promoCodeApplied = true;

        updateSummary();
        showNotification(`Code promo ${code} appliqué ! -${(validCodes[code] * 100).toFixed(0)}%`);

        // Désactiver l'input
        input.disabled = true;
        input.value = `${code} ✓`;
    } else {
        showNotification('Code promo invalide');
    }
}

// ============================================
// COMMANDE
// ============================================

function checkout() {
    if (cart.length === 0) {
        showNotification('Votre panier est vide');
        return;
    }

    // Afficher le modal de confirmation
    const modal = document.getElementById('checkout-modal');
    if (modal) {
        modal.classList.add('active');
    }

    // Vider le panier après la commande
    cart = [];
    saveCart();
    updateCartCount();
}

function closeModal() {
    const modal = document.getElementById('checkout-modal');
    if (modal) {
        modal.classList.remove('active');
    }

    // Recharger la page du panier
    loadCartItems();
}

// ============================================
// PRODUITS RECOMMANDÉS
// ============================================

function loadRecommendedProducts() {
    const grid = document.getElementById('recommended-grid');
    if (!grid) return;

    // Sélectionner 4 produits aléatoires qui ne sont pas dans le panier
    const cartIds = cart.map(item => item.id);
    const availableProducts = products.filter(p => !cartIds.includes(p.id));

    // Mélanger et prendre 4 produits
    const recommended = availableProducts
        .sort(() => 0.5 - Math.random())
        .slice(0, 4);

    grid.innerHTML = recommended.map(product => `
        <div class="product-card" data-id="${product.id}" onclick="goToProduct(${product.id})">
            <div class="product-image">
                <img src="${product.image}" alt="${product.name}">
                ${product.discount > 0 ? `<span class="discount-badge">-${product.discount}%</span>` : ''}
            </div>
            <div class="product-info">
                <h4>${product.name}</h4>
                <div class="product-price">
                    <span class="new-price">${formatPrice(product.price)}</span>
                </div>
                <button class="btn-add-cart" onclick="event.stopPropagation(); addToCart(${product.id}); loadCartItems(); showNotification('Produit ajouté au panier');">
                    <i class="fas fa-shopping-cart"></i> Ajouter
                </button>
            </div>
        </div>
    `).join('');
}

function goToProduct(productId) {
    window.location.href = `produit.html?id=${productId}`;
}

// ============================================
// FONCTIONS UTILITAIRES
// ============================================

function formatPrice(price) {
    return new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'EUR'
    }).format(price);
}

function showNotification(message) {
    // Supprimer les notifications existantes
    const existing = document.querySelector('.notification');
    if (existing) existing.remove();

    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.innerHTML = `
        <i class="fas fa-info-circle"></i>
        <span>${message}</span>
    `;

    notification.style.cssText = `
        position: fixed;
        top: 90px;
        right: 20px;
        background: #3b82f6;
        color: white;
        padding: 15px 25px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        z-index: 3000;
        animation: slideIn 0.3s ease;
    `;

    // Add animation keyframes
    if (!document.getElementById('notification-styles')) {
        const style = document.createElement('style');
        style.id = 'notification-styles';
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
        `;
        document.head.appendChild(style);
    }

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'slideIn 0.3s ease reverse';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}
