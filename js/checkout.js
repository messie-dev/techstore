/* ============================================
   TECHSTORE - Checkout JavaScript
   ============================================ */

// ============================================
// INITIALISER LA PAGE CHECKOUT
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    loadCartForCheckout();
    loadUserData();
    setupCheckoutListeners();
});

// ============================================
// CHARGER LE PANIER POUR LE CHECKOUT
// ============================================

function loadCartForCheckout() {
    const cart = getCart();
    const cartItemsDiv = document.getElementById('cartItems');
    
    if (cart.items.length === 0) {
        cartItemsDiv.innerHTML = '<p style="text-align: center; color: #6b7280; padding: 2rem;">Votre panier est vide</p>';
        document.querySelector('.btn-validate').disabled = true;
        return;
    }

    let itemsHTML = '';
    cart.items.forEach(item => {
        itemsHTML += `
            <div class="summary-item">
                <img src="${item.image}" alt="${item.name}" class="summary-item-image">
                <div class="summary-item-info">
                    <div class="summary-item-name">${item.name}</div>
                    <div class="summary-item-qty">Quantité: ${item.quantity}</div>
                </div>
                <div class="summary-item-price">${(item.price * item.quantity).toFixed(2)} €</div>
            </div>
        `;
    });

    cartItemsDiv.innerHTML = itemsHTML;
    updateCheckoutTotals();
}

// ============================================
// CHARGER LES DONNÉES UTILISATEUR
// ============================================

function loadUserData() {
    const userDataStr = localStorage.getItem('techstore_user') || sessionStorage.getItem('techstore_user');
    
    if (userDataStr) {
        try {
            const userData = JSON.parse(userDataStr);
            
            if (userData.firstName) {
                document.getElementById('firstName').value = userData.firstName;
            }
            if (userData.lastName) {
                document.getElementById('lastName').value = userData.lastName;
            }
            if (userData.email) {
                document.getElementById('email').value = userData.email;
            }
            if (userData.phone) {
                document.getElementById('phone').value = userData.phone;
            }
        } catch (error) {
            console.error('Erreur chargement données utilisateur:', error);
        }
    }
}

// ============================================
// SETUP EVENT LISTENERS
// ============================================

function setupCheckoutListeners() {
    const form = document.getElementById('checkoutForm');
    
    // Validation en temps réel des champs
    form.querySelectorAll('input, select').forEach(field => {
        field.addEventListener('blur', function() {
            validateField(this);
        });
        
        field.addEventListener('input', function() {
            validateField(this, false);
        });
    });
}

// ============================================
// VALIDER UN CHAMP
// ============================================

function validateField(field, showError = true) {
    const errorSpan = field.parentElement.querySelector('.error-message');
    let isValid = true;
    let errorMessage = '';

    switch(field.id) {
        case 'firstName':
        case 'lastName':
            if (field.value.trim().length < 2) {
                isValid = false;
                errorMessage = 'Le champ doit contenir au moins 2 caractères';
            }
            break;
        
        case 'email':
            if (!isValidEmail(field.value)) {
                isValid = false;
                errorMessage = 'Veuillez entrer une adresse email valide';
            }
            break;
        
        case 'phone':
            if (!isValidPhone(field.value)) {
                isValid = false;
                errorMessage = 'Veuillez entrer un numéro de téléphone valide';
            }
            break;
        
        case 'address':
            if (field.value.trim().length < 5) {
                isValid = false;
                errorMessage = 'Veuillez entrer une adresse valide';
            }
            break;
        
        case 'zipcode':
            if (!isValidZipcode(field.value)) {
                isValid = false;
                errorMessage = 'Code postal invalide';
            }
            break;
        
        case 'city':
            if (field.value.trim().length < 2) {
                isValid = false;
                errorMessage = 'Veuillez entrer une ville';
            }
            break;
        
        case 'cardNumber':
            if (!isValidCardNumber(field.value)) {
                isValid = false;
                errorMessage = 'Numéro de carte invalide';
            }
            break;
        
        case 'cardExpiry':
            if (!isValidExpiry(field.value)) {
                isValid = false;
                errorMessage = 'Format invalide (MM/YY)';
            }
            break;
        
        case 'cardCvc':
            if (!/^\d{3}$/.test(field.value)) {
                isValid = false;
                errorMessage = 'CVV invalide';
            }
            break;
    }

    if (showError) {
        field.classList.toggle('error', !isValid);
        if (errorSpan) {
            errorSpan.textContent = isValid ? '' : errorMessage;
        }
    }

    return isValid;
}

// ============================================
// VALIDATIONS UTILITAIRES
// ============================================

function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function isValidPhone(phone) {
    return /^[\d\s\-\+\(\)]{10,}$/.test(phone.replace(/\s/g, ''));
}

function isValidZipcode(zipcode) {
    return /^\d{5}$/.test(zipcode);
}

function isValidCardNumber(cardNumber) {
    const cleaned = cardNumber.replace(/\s/g, '');
    return /^\d{16}$/.test(cleaned);
}

function isValidExpiry(expiry) {
    return /^\d{2}\/\d{2}$/.test(expiry);
}

// ============================================
// SÉLECTIONNER LE MODE DE PAIEMENT
// ============================================

function selectPayment(method) {
    // Désactiver tous les options
    document.querySelectorAll('.payment-option').forEach(option => {
        option.classList.remove('active');
    });

    // Activer l'option sélectionnée
    event.target.closest('.payment-option').classList.add('active');
    document.getElementById('paymentMethod').value = method;

    // Afficher/masquer les détails de la carte
    const cardDetails = document.getElementById('cardDetails');
    if (method === 'card') {
        cardDetails.style.display = 'block';
    } else {
        cardDetails.style.display = 'none';
    }
}

// ============================================
// APPLIQUER UN CODE PROMO
// ============================================

function applyPromo() {
    const promoCode = document.getElementById('promoCode').value.toUpperCase();
    const promoMessage = document.getElementById('promoMessage');

    if (!promoCode) {
        promoMessage.textContent = 'Veuillez entrer un code promo';
        promoMessage.style.color = '#ef4444';
        return;
    }

    // Codes promo valides
    const validCodes = {
        'TECH10': 10,
        'WELCOME15': 15,
        'FLASH20': 20,
        'SUMMER25': 25
    };

    if (validCodes[promoCode]) {
        localStorage.setItem('techstore_promo', promoCode);
        promoMessage.textContent = `✓ Code promo appliqué: ${validCodes[promoCode]}% de réduction`;
        promoMessage.style.color = '#22c55e';
        updateCheckoutTotals();
    } else {
        promoMessage.textContent = 'Code promo invalide';
        promoMessage.style.color = '#ef4444';
    }
}

// ============================================
// METTRE À JOUR LES TOTAUX
// ============================================

function updateCheckoutTotals() {
    const cart = getCart();
    
    // Calculer le sous-total
    let subtotal = 0;
    cart.items.forEach(item => {
        subtotal += item.price * item.quantity;
    });

    // Obtenir la réduction
    const promo = localStorage.getItem('techstore_promo');
    const promoCodes = {
        'TECH10': 10,
        'WELCOME15': 15,
        'FLASH20': 20,
        'SUMMER25': 25
    };
    
    const discountPercent = promo && promoCodes[promo] ? promoCodes[promo] : 0;
    const discount = (subtotal * discountPercent) / 100;

    // Frais de livraison (gratuit si > 100€)
    const shipping = subtotal - discount >= 100 ? 0 : 9.99;

    // Total
    const total = subtotal - discount + shipping;

    // Afficher les totaux
    document.getElementById('subtotal').textContent = subtotal.toFixed(2) + ' €';
    document.getElementById('discount').textContent = (discount > 0 ? '-' : '') + discount.toFixed(2) + ' €';
    document.getElementById('shipping').textContent = shipping === 0 ? 'OFFERTE' : shipping.toFixed(2) + ' €';
    document.getElementById('totalPrice').textContent = total.toFixed(2) + ' €';
}

// ============================================
// VALIDER ET CONFIRMER LA COMMANDE
// ============================================

function validateCheckout() {
    const form = document.getElementById('checkoutForm');
    const requiredFields = form.querySelectorAll('[required]');
    
    let isValid = true;
    requiredFields.forEach(field => {
        if (!validateField(field, true)) {
            isValid = false;
        }
    });

    if (!isValid) {
        showNotification('Veuillez corriger les erreurs du formulaire', 'error');
        return;
    }

    // Créer la commande
    createOrder();
}

// ============================================
// CRÉER LA COMMANDE
// ============================================

function createOrder() {
    const form = document.getElementById('checkoutForm');
    const cart = getCart();

    // Données de la commande
    const order = {
        id: 'ORD-' + Date.now(),
        date: new Date().toLocaleDateString('fr-FR'),
        status: 'En attente',
        customer: {
            firstName: document.getElementById('firstName').value,
            lastName: document.getElementById('lastName').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            address: document.getElementById('address').value,
            zipcode: document.getElementById('zipcode').value,
            city: document.getElementById('city').value,
            country: document.getElementById('country').value
        },
        payment: {
            method: document.getElementById('paymentMethod').value,
            cardLast4: document.getElementById('paymentMethod').value === 'card' 
                ? document.getElementById('cardNumber').value.slice(-4) 
                : null
        },
        items: cart.items,
        totals: {
            subtotal: parseFloat(document.getElementById('subtotal').textContent),
            discount: parseFloat(document.getElementById('discount').textContent),
            shipping: document.getElementById('shipping').textContent === 'OFFERTE' ? 0 : parseFloat(document.getElementById('shipping').textContent),
            total: parseFloat(document.getElementById('totalPrice').textContent)
        },
        promo: localStorage.getItem('techstore_promo') || null
    };

    // Sauvegarder la commande
    saveOrder(order);

    // Vider le panier
    localStorage.removeItem('techstore_cart');
    localStorage.removeItem('techstore_promo');

    // Afficher une notification de succès
    showNotification('Commande confirmée avec succès!', 'success');

    // Rediriger vers la page de confirmation
    setTimeout(() => {
        window.location.href = 'confirmation.html?orderId=' + order.id;
    }, 1500);
}

// ============================================
// SAUVEGARDER LA COMMANDE
// ============================================

function saveOrder(order) {
    let orders = JSON.parse(localStorage.getItem('techstore_orders')) || [];
    orders.push(order);
    localStorage.setItem('techstore_orders', JSON.stringify(orders));
}

// ============================================
// RÉCUPÉRER LE PANIER
// ============================================

function getCart() {
    const cart = localStorage.getItem('techstore_cart');
    if (!cart) {
        return { items: [] };
    }
    
    try {
        const parsed = JSON.parse(cart);
        // Si c'est un tableau (ancien format), convertir en objet
        if (Array.isArray(parsed)) {
            return { items: parsed };
        }
        return parsed;
    } catch (error) {
        return { items: [] };
    }
}

// ============================================
// AFFICHER UNE NOTIFICATION
// ============================================

function showNotification(message, type = 'success') {
    let notificationDiv = document.getElementById('notification');
    
    if (notificationDiv) {
        notificationDiv.remove();
    }
    
    notificationDiv = document.createElement('div');
    notificationDiv.id = 'notification';
    notificationDiv.className = `notification notification-${type}`;
    notificationDiv.textContent = message;
    notificationDiv.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        background: ${type === 'success' ? '#22c55e' : type === 'error' ? '#ef4444' : '#3b82f6'};
        color: white;
        border-radius: 6px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 9999;
        animation: slideIn 0.3s ease-out;
    `;
    
    if (!document.querySelector('style[data-notification]')) {
        const style = document.createElement('style');
        style.setAttribute('data-notification', 'true');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
        `;
        document.head.appendChild(style);
    }
    
    document.body.appendChild(notificationDiv);
    
    setTimeout(() => {
        notificationDiv.remove();
    }, 3000);
}
