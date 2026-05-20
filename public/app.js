/* ===== DONNÉES PRODUITS ===== */
const PRODUITS = [
  {
    id: 1, ref: 'LAP-TITAN-001', categorie: 'laptop',
    nom: 'PC Portable Gamer Titan GT77 - i9...',
    nomComplet: 'PC Portable Gamer Titan GT77 - i9 / RTX 4090',
    prix: 3499.99,
    desc: 'Le Titan GT77 est le summum du gaming mobile. Équipé du dernier processeur i9 et de la puissante RTX 4090, il offre des performances exceptionnelles pour le jeu et la création de contenu.',
    img: 'https://images.unsplash.com/photo-1593640495253-23196b27a87f?w=600&q=80',
    imgs: [
      'https://images.unsplash.com/photo-1593640495253-23196b27a87f?w=600&q=80',
      'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=600&q=80',
      'https://images.unsplash.com/photo-1525547719571-a2d4ac8945e2?w=600&q=80',
    ]
  },
  {
    id: 2, ref: 'LAP-ZEN-002', categorie: 'laptop',
    nom: 'ZenBook Pro Duo 15 OLED - Double Écran...',
    nomComplet: 'ZenBook Pro Duo 15 OLED - Double Écran / i7',
    prix: 2599.50,
    desc: 'Le ZenBook Pro Duo 15 révolutionne la productivité avec son double écran OLED. Idéal pour les créatifs et les professionnels exigeants.',
    img: 'https://images.unsplash.com/photo-1541807084-5c52b6b3adef?w=600&q=80',
    imgs: [
      'https://images.unsplash.com/photo-1541807084-5c52b6b3adef?w=600&q=80',
      'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=600&q=80',
    ]
  },
  {
    id: 3, ref: 'MON-34-001', categorie: 'monitor',
    nom: 'Écran Incurvé 34" WQHD 144Hz',
    nomComplet: 'Écran Incurvé 34" WQHD 144Hz UltraWide',
    prix: 450.00,
    desc: 'Immersion totale avec ce moniteur incurvé 34 pouces WQHD. Taux de rafraîchissement 144Hz pour une fluidité parfaite, idéal gaming et travail.',
    img: 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=600&q=80',
    imgs: [
      'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=600&q=80',
      'https://images.unsplash.com/photo-1547394765-185e1e68f34e?w=600&q=80',
    ]
  },
  {
    id: 4, ref: 'ACC-KEY-001', categorie: 'accessoire',
    nom: 'Clavier Mécanique RGB TKL',
    nomComplet: 'Clavier Mécanique RGB TKL Sans-Fil',
    prix: 129.99,
    desc: 'Clavier mécanique compact TKL avec rétroéclairage RGB personnalisable et connexion sans-fil. Switches Cherry MX Red inclus.',
    img: 'https://images.unsplash.com/photo-1618384887929-16ec33fab9ef?w=600&q=80',
    imgs: ['https://images.unsplash.com/photo-1618384887929-16ec33fab9ef?w=600&q=80']
  },
  {
    id: 5, ref: 'ACC-MSE-001', categorie: 'accessoire',
    nom: 'Souris Gamer Pro 16000 DPI',
    nomComplet: 'Souris Gamer Pro 16000 DPI Optique',
    prix: 79.95,
    desc: 'Souris gamer haute précision avec capteur optique 16000 DPI. Ergonomie optimale pour les longues sessions de jeu.',
    img: 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=600&q=80',
    imgs: ['https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=600&q=80']
  },
  {
    id: 6, ref: 'LAP-DEL-003', categorie: 'laptop',
    nom: 'Dell XPS 15 - i7 OLED Tactile',
    nomComplet: 'Dell XPS 15 - i7 / 32Go RAM / Écran OLED Tactile',
    prix: 1899.00,
    desc: 'L\'excellence Dell avec l\'XPS 15 : écran OLED tactile 4K, processeur Intel Core i7 de 12e génération et 32 Go de RAM pour une expérience premium.',
    img: 'https://images.unsplash.com/photo-1588702547919-26089e690ecc?w=600&q=80',
    imgs: ['https://images.unsplash.com/photo-1588702547919-26089e690ecc?w=600&q=80']
  },
];

/* ===== STATE MANAGEMENT ===== */
let panier = JSON.parse(localStorage.getItem('ts_panier') || '[]');
let currentPage = 'home';
let currentProduct = null;
let currentQty = 1;
let checkoutStep = 1;
let deliveryPrice = 7.99;
let paymentMethod = 'card';
let faqCatActive = 'all';

/* ===== NAVIGATION ===== */
function showPage(page) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.getElementById('page-' + page).classList.add('active');
  currentPage = page;
  window.scrollTo(0, 0);

  if (page === 'home') renderFeatured();
  if (page === 'catalogue') renderCatalogue();
  if (page === 'panier') renderPanier();
  if (page === 'faq') setTimeout(renderFaq, 50);
}

/* ===== RENDER PRODUCTS ===== */
function productCardHTML(p) {
  return `
    <div class="product-card" onclick="openProduct(${p.id})">
      <img src="${p.img}" alt="${p.nom}" loading="lazy" />
      <div class="card-body">
        <span class="card-ref">${p.ref}</span>
        <p class="card-name">${p.nomComplet}</p>
        <p class="card-desc">${p.desc.substring(0, 80)}...</p>
        <div class="card-footer">
          <span class="card-price">${formatPrice(p.prix)}</span>
          <span class="card-stock">● En stock</span>
        </div>
      </div>
    </div>
  `;
}

function renderFeatured() {
  const grid = document.getElementById('featured-grid');
  if (!grid) return;
  grid.innerHTML = PRODUITS.slice(0, 4).map(productCardHTML).join('');
}

function renderCatalogue() {
  filterProducts();
}

function filterProducts() {
  const cat = document.getElementById('filter-categorie')?.value || '';
  const prix = document.getElementById('filter-prix')?.value || '';
  const q = (document.getElementById('search-input')?.value || '').toLowerCase();

  let list = PRODUITS.filter(p => {
    if (cat && p.categorie !== cat) return false;
    if (prix === '0-500' && p.prix >= 500) return false;
    if (prix === '500-2000' && (p.prix < 500 || p.prix >= 2000)) return false;
    if (prix === '2000+' && p.prix < 2000) return false;
    if (q && !p.nomComplet.toLowerCase().includes(q) && !p.desc.toLowerCase().includes(q)) return false;
    return true;
  });

  const grid = document.getElementById('catalogue-grid');
  if (!grid) return;
  grid.innerHTML = list.length
    ? list.map(productCardHTML).join('')
    : '<p style="color:var(--gray);padding:24px 0;">Aucun produit trouvé.</p>';
}

function openProduct(id) {
  currentProduct = PRODUITS.find(p => p.id === id);
  currentQty = 1;
  if (!currentProduct) return;

  document.getElementById('detail-ref').textContent = currentProduct.ref;
  document.getElementById('detail-nom').textContent = currentProduct.nomComplet;
  document.getElementById('detail-prix').textContent = formatPrice(currentProduct.prix);
  document.getElementById('detail-desc').textContent = currentProduct.desc;
  document.getElementById('detail-qty').textContent = currentQty;

  const mainImg = document.getElementById('detail-main-img');
  mainImg.src = currentProduct.imgs[0];
  mainImg.alt = currentProduct.nomComplet;

  const thumbsEl = document.getElementById('detail-thumbnails');
  thumbsEl.innerHTML = currentProduct.imgs.map((src, i) => `
    <img src="${src}" alt="" class="${i === 0 ? 'active' : ''}" onclick="selectThumb(this, '${src}')" />
  `).join('');

  showPage('produit');
}

function selectThumb(el, src) {
  document.getElementById('detail-main-img').src = src;
  document.querySelectorAll('#detail-thumbnails img').forEach(t => t.classList.remove('active'));
  el.classList.add('active');
}

function changeQty(delta) {
  currentQty = Math.max(1, currentQty + delta);
  document.getElementById('detail-qty').textContent = currentQty;
}

function addToCartFromDetail() {
  if (!currentProduct) return;
  addToCart(currentProduct.id, currentQty);
  showToast('✅ Produit ajouté au panier !');
}

function buyNow() {
  addToCartFromDetail();
  showPage('panier');
}

/* ===== CART MANAGEMENT ===== */
function addToCart(id, qty = 1) {
  const existing = panier.find(i => i.id === id);
  if (existing) existing.qty += qty;
  else panier.push({ id, qty });
  saveCart();
  updateBadge();
}

function saveCart() {
  localStorage.setItem('ts_panier', JSON.stringify(panier));
}

function updateBadge() {
  const badge = document.getElementById('badge-panier');
  if (!badge) return;
  const total = panier.reduce((s, i) => s + i.qty, 0);
  badge.textContent = total;
}

function renderPanier() {
  const list = document.getElementById('cart-items-list');
  if (!list) return;
  
  if (panier.length === 0) {
    list.innerHTML = '<p style="color:var(--gray);padding:32px 0;text-align:center;">Votre panier est vide. <a href="#" onclick="showPage(\'catalogue\')" style="color:var(--blue)">Voir le catalogue</a></p>';
    updateCartSummary();
    return;
  }

  list.innerHTML = panier.map(item => {
    const p = PRODUITS.find(pr => pr.id === item.id);
    if (!p) return '';
    const total = p.prix * item.qty;
    return `
      <div class="cart-item">
        <img src="${p.img}" alt="${p.nom}" />
        <div class="cart-item-info">
          <div class="cart-item-ref">${p.ref}</div>
          <div class="cart-item-name">${p.nomComplet}</div>
          <div class="cart-item-status">● En stock</div>
        </div>
        <div class="cart-item-right">
          <div class="cart-item-total">${formatPrice(total)}</div>
          <div class="cart-item-unit">${formatPrice(p.prix)}</div>
          <div class="qty-ctrl">
            <button onclick="changeCartQty(${p.id}, -1)">−</button>
            <span>${item.qty}</span>
            <button onclick="changeCartQty(${p.id}, 1)">+</button>
          </div>
          <button class="delete-btn" onclick="removeFromCart(${p.id})">🗑</button>
        </div>
      </div>
    `;
  }).join('');

  updateCartSummary();
}

function changeCartQty(id, delta) {
  const item = panier.find(i => i.id === id);
  if (!item) return;
  item.qty = Math.max(1, item.qty + delta);
  saveCart(); updateBadge(); renderPanier();
}

function removeFromCart(id) {
  panier = panier.filter(i => i.id !== id);
  saveCart(); updateBadge(); renderPanier();
  showToast('🗑 Produit retiré du panier');
}

function getCartTotals() {
  const subtotal = panier.reduce((s, item) => {
    const p = PRODUITS.find(pr => pr.id === item.id);
    return s + (p ? p.prix * item.qty : 0);
  }, 0);
  const taxes = subtotal * 0.20;
  const count = panier.reduce((s, i) => s + i.qty, 0);
  return { subtotal, taxes, count };
}

function updateCartSummary() {
  const { subtotal, taxes, count } = getCartTotals();
  const summaryCount = document.getElementById('summary-count');
  const summarySubtotal = document.getElementById('summary-subtotal');
  const summaryTaxes = document.getElementById('summary-taxes');
  const summaryTotal = document.getElementById('summary-total');
  
  if (summaryCount) summaryCount.textContent = `Sous-total (${count} article${count > 1 ? 's' : ''})`;
  if (summarySubtotal) summarySubtotal.textContent = formatPrice(subtotal);
  if (summaryTaxes) summaryTaxes.textContent = formatPrice(taxes);
  if (summaryTotal) summaryTotal.textContent = formatPrice(subtotal);
}

function applyPromo() {
  const input = document.getElementById('promo-input');
  if (!input) return;
  const code = input.value.trim().toUpperCase();
  const validCodes = ['TECH10', 'WELCOME15', 'FLASH20', 'SUMMER25'];
  
  if (validCodes.includes(code)) {
    showToast('🎉 Code promo appliqué !');
  } else {
    showToast('❌ Code promo invalide');
  }
}

/* ===== CHECKOUT VALIDATION UTILITIES ===== */
function isValidEmail(email) {
  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return regex.test(email);
}

function isValidPhone(phone) {
  const cleaned = phone.replace(/\D/g, '');
  return cleaned.length >= 10;
}

function isValidZipcode(zipcode) {
  return /^\d{5}$/.test(zipcode.trim());
}

/* ===== CHECKOUT FORM STATE MANAGEMENT ===== */
function getCheckoutFormData() {
  return {
    firstName: document.querySelector('input[placeholder="Jean"]')?.value || '',
    lastName: document.querySelector('input[placeholder="Dupont"]')?.value || '',
    address: document.querySelector('input[placeholder="123 Rue de la Paix"]')?.value || '',
    city: document.querySelector('input[placeholder="Paris"]')?.value || '',
    zipcode: document.querySelector('input[placeholder="75001"]')?.value || '',
    country: document.querySelector('input[placeholder="France"]')?.value || 'France',
    cardName: document.getElementById('card-name')?.value || '',
    cardNumber: document.getElementById('card-number')?.value || '',
    cardExp: document.getElementById('card-exp')?.value || '',
    cardCVC: document.getElementById('card-cvc')?.value || ''
  };
}

function validateAddressStep() {
  const errors = [];
  const data = getCheckoutFormData();
  
  if (!data.firstName?.trim()) errors.push('Prénom requis');
  if (!data.lastName?.trim()) errors.push('Nom requis');
  if (!data.address?.trim()) errors.push('Adresse requise');
  if (!data.city?.trim()) errors.push('Ville requise');
  if (!isValidZipcode(data.zipcode)) errors.push('Code postal invalide (5 chiffres)');
  
  if (errors.length > 0) {
    showToast('❌ ' + errors[0]);
    return false;
  }
  return true;
}

function validatePaymentStep() {
  // Payment validation - simple check for card method
  if (paymentMethod === 'card') {
    const cardName = document.getElementById('card-name')?.value.trim();
    const cardNumber = document.getElementById('card-number')?.value.trim();
    const cardExp = document.getElementById('card-exp')?.value.trim();
    const cardCVC = document.getElementById('card-cvc')?.value.trim();
    
    if (!cardName) {
      showToast('❌ Nom sur la carte requis');
      return false;
    }
    if (!cardNumber || cardNumber.replace(/\s/g, '').length < 16) {
      showToast('❌ Numéro de carte invalide');
      return false;
    }
    if (!cardExp || !/^\d{2}\/\d{2}$/.test(cardExp)) {
      showToast('❌ Format de date invalide (MM/YY)');
      return false;
    }
    if (!cardCVC || cardCVC.length < 3) {
      showToast('❌ CVC invalide');
      return false;
    }
  }
  return true;
}

/* ===== CHECKOUT ORDER MANAGEMENT ===== */
function createOrder() {
  const formData = getCheckoutFormData();
  const { subtotal, taxes } = getCartTotals();
  const total = subtotal + deliveryPrice;
  
  const order = {
    id: 'ORD-' + Date.now(),
    date: new Date().toLocaleDateString('fr-FR'),
    status: 'En attente',
    customer: {
      firstName: formData.firstName,
      lastName: formData.lastName,
      email: formData.email || 'non-fourni@example.fr',
      phone: formData.phone || 'N/A',
      address: formData.address,
      city: formData.city,
      zipcode: formData.zipcode,
      country: formData.country || 'France'
    },
    payment: {
      method: paymentMethod,
      cardLast4: paymentMethod === 'card' ? formData.cardNumber.replace(/\s/g, '').slice(-4) : 'N/A'
    },
    items: panier.map(item => {
      const p = PRODUITS.find(pr => pr.id === item.id);
      return {
        id: item.id,
        name: p?.nomComplet || 'Produit inconnu',
        price: p?.prix || 0,
        quantity: item.qty,
        total: (p?.prix || 0) * item.qty
      };
    }),
    totals: {
      subtotal: subtotal,
      discount: 0,
      shipping: deliveryPrice,
      taxes: taxes,
      total: total
    },
    delivery: {
      method: document.querySelector('input[name="livraison"]:checked')?.parentElement?.textContent?.split('(')[0]?.trim() || 'Standard',
      price: deliveryPrice
    }
  };
  
  return order;
}

function saveOrder(order) {
  const orders = JSON.parse(localStorage.getItem('techstore_orders') || '[]');
  orders.push(order);
  localStorage.setItem('techstore_orders', JSON.stringify(orders));
  localStorage.setItem('lastOrderId', order.id);
}

function getLastOrder() {
  const orderId = localStorage.getItem('lastOrderId');
  if (!orderId) return null;
  const orders = JSON.parse(localStorage.getItem('techstore_orders') || '[]');
  return orders.find(o => o.id === orderId);
}

/* ===== CHECKOUT STEP NAVIGATION ===== */
function initCheckout() {
  checkoutStep = 1;
  deliveryPrice = 7.99;
  paymentMethod = 'card';
  renderCheckoutSummary();
  updateStepper();
  showCheckoutStep(1);
  updateButtonLabels();
}

function checkoutNext() {
  // Validate current step before moving forward
  if (checkoutStep === 1 && !validateAddressStep()) return;
  if (checkoutStep === 3 && !validatePaymentStep()) return;

  if (checkoutStep < 3) {
    markStepDone(checkoutStep);
    checkoutStep++;
    showCheckoutStep(checkoutStep);
    updateStepper();
    updateButtonLabels();
  } else {
    // Final step: Confirm order
    const order = createOrder();
    saveOrder(order);
    renderConfirmation();
    panier = [];
    saveCart();
    updateBadge();
    showPage('confirmation');
    showToast('🎉 Commande confirmée !');
  }
}

function checkoutBack() {
  if (checkoutStep > 1) {
    checkoutStep--;
    showCheckoutStep(checkoutStep);
    updateStepper();
    updateButtonLabels();
  }
}

function updateButtonLabels() {
  const nextBtn = document.getElementById('co-next-btn');
  const backBtn = document.getElementById('co-back-btn');
  
  if (!nextBtn || !backBtn) return;
  
  backBtn.style.display = checkoutStep === 1 ? 'none' : 'block';
  
  if (checkoutStep === 1) nextBtn.textContent = 'Continuer vers la livraison →';
  else if (checkoutStep === 2) nextBtn.textContent = 'Continuer vers le paiement →';
  else nextBtn.textContent = 'Confirmer et Payer 💳';
}

/* ===== CHECKOUT UI MANAGEMENT ===== */
function showCheckoutStep(n) {
  document.querySelectorAll('.checkout-step').forEach(s => s.classList.remove('active'));
  document.getElementById('checkout-step-' + n)?.classList.add('active');
}

function updateStepper() {
  for (let i = 1; i <= 3; i++) {
    const stepEl = document.getElementById('step-' + i);
    const circleEl = document.getElementById('sc-' + i);
    if (!stepEl || !circleEl) continue;
    
    stepEl.className = 'step';
    
    if (i < checkoutStep) {
      stepEl.classList.add('done');
      circleEl.textContent = '✓';
    } else if (i === checkoutStep) {
      stepEl.classList.add('active');
      circleEl.textContent = i;
    } else {
      circleEl.textContent = i;
    }
    
    if (i < 3) {
      const line = document.getElementById('line-' + i);
      if (line) line.className = 'step-line' + (i < checkoutStep ? ' done' : '');
    }
  }
}

function markStepDone(n) {
  const stepEl = document.getElementById('step-' + n);
  const circleEl = document.getElementById('sc-' + n);
  if (!stepEl || !circleEl) return;
  
  stepEl.className = 'step done';
  circleEl.textContent = '✓';
}

/* ===== CHECKOUT SUMMARY & TOTALS ===== */
function renderCheckoutSummary() {
  const list = document.getElementById('co-items-list');
  if (!list) return;
  
  const { subtotal, count } = getCartTotals();

  const countLabel = document.getElementById('co-count');
  if (countLabel) countLabel.textContent = `${count} article${count > 1 ? 's' : ''} dans votre panier`;

  list.innerHTML = panier.map(item => {
    const p = PRODUITS.find(pr => pr.id === item.id);
    if (!p) return '';
    return `
      <div class="co-item">
        <div class="co-item-img">
          <img src="${p.img}" alt="${p.nom}" />
          <span class="co-item-qty-badge">x${item.qty}</span>
        </div>
        <span class="co-item-name">${p.nomComplet}</span>
        <span class="co-item-price">${formatPrice(p.prix * item.qty)}</span>
      </div>
    `;
  }).join('');

  updateCheckoutTotals();
}

function updateCheckoutTotals() {
  const { subtotal } = getCartTotals();
  const subtotalEl = document.getElementById('co-subtotal');
  const livraisonEl = document.getElementById('co-livraison');
  const taxesEl = document.getElementById('co-taxes');
  const totalEl = document.getElementById('co-total');
  
  if (subtotalEl) subtotalEl.textContent = formatPrice(subtotal);
  if (livraisonEl) livraisonEl.textContent = formatPrice(deliveryPrice);
  if (taxesEl) taxesEl.textContent = '0,00 €';
  if (totalEl) totalEl.textContent = formatPrice(subtotal + deliveryPrice);
}

/* ===== CHECKOUT FORM INPUT HANDLING ===== */
function selectDelivery(el, price) {
  document.querySelectorAll('.delivery-option').forEach(o => o.classList.remove('selected'));
  el.classList.add('selected');
  const radio = el.querySelector('input');
  if (radio) radio.checked = true;
  deliveryPrice = price;
  updateCheckoutTotals();
}

function selectPayment(el, method) {
  document.querySelectorAll('.pay-option').forEach(o => o.classList.remove('selected'));
  el.classList.add('selected');
  paymentMethod = method;
  const cardForm = document.getElementById('card-form');
  const paypalForm = document.getElementById('paypal-form');
  if (cardForm) cardForm.style.display = method === 'card' ? 'block' : 'none';
  if (paypalForm) paypalForm.style.display = method === 'paypal' ? 'block' : 'none';
}

function formatCard(input) {
  let v = input.value.replace(/\D/g, '').substring(0, 16);
  input.value = v.replace(/(.{4})/g, '$1 ').trim();
}

function formatExp(input) {
  let v = input.value.replace(/\D/g, '').substring(0, 4);
  if (v.length >= 3) v = v.substring(0, 2) + '/' + v.substring(2);
  input.value = v;
}

/* ===== CONFIRMATION PAGE ===== */
function renderConfirmation() {
  const order = getLastOrder();
  if (!order) {
    showToast('❌ Erreur lors de la récupération de la commande');
    return;
  }

  const items = order.items;
  const confList = document.getElementById('conf-items-list');
  if (!confList) return;
  
  confList.innerHTML = items.map(item => `
    <div class="conf-item">
      <img src="${PRODUITS.find(p => p.id === item.id)?.img || ''}" alt="${item.name}" />
      <div class="conf-item-info">
        <span class="ref">REF: ${PRODUITS.find(p => p.id === item.id)?.ref || 'N/A'}</span>
        <strong>${item.name}</strong>
      </div>
      <div>
        <div class="conf-item-price">${formatPrice(item.total)}</div>
        <div class="conf-item-qty">Qté: ${item.quantity}</div>
      </div>
    </div>
  `).join('');

  const subtotalEl = document.getElementById('conf-subtotal');
  const taxesEl = document.getElementById('conf-taxes');
  const totalEl = document.getElementById('conf-total');
  
  if (subtotalEl) subtotalEl.textContent = formatPrice(order.totals.subtotal);
  if (taxesEl) taxesEl.textContent = formatPrice(order.totals.taxes);
  if (totalEl) totalEl.textContent = formatPrice(order.totals.total);
}

function restartShopping() {
  showPage('catalogue');
}

/* ===== MODAL ADRESSE ===== */
function openAddressModal() {
  const modal = document.getElementById('modal-adresse');
  if (modal) modal.classList.add('open');
}

function closeAddressModal() {
  const modal = document.getElementById('modal-adresse');
  if (modal) modal.classList.remove('open');
}

function closeModalOnOverlay(e) {
  if (e.target === e.currentTarget) closeAddressModal();
}

function saveAddress() {
  const prenom = document.getElementById('m-prenom')?.value.trim();
  const nom = document.getElementById('m-nom')?.value.trim();
  if (!prenom || !nom) { 
    showToast('❌ Veuillez remplir tous les champs');
    return;
  }
  showToast('✅ Adresse enregistrée !');
  closeAddressModal();
}

/* ===== ACCOUNT ===== */
function switchTab(tab, el) {
  document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
  el.classList.add('active');
  const tabContent = document.getElementById('tab-' + tab);
  if (tabContent) tabContent.classList.add('active');
}

/* ===== FAQ DATA & LOGIC ===== */
const FAQ_DATA = [
  { cat: 'commande', q: 'Comment passer une commande ?', a: 'Ajoutez les produits souhaités à votre panier, puis cliquez sur "Valider mon panier". Suivez les étapes : adresse de livraison, mode de livraison, puis paiement. Un email de confirmation vous sera envoyé.' },
  { cat: 'commande', q: 'Puis-je modifier ou annuler ma commande ?', a: 'Vous pouvez annuler ou modifier votre commande dans les 2 heures suivant sa validation, en contactant notre service client. Passé ce délai, la commande est déjà en préparation.' },
  { cat: 'commande', q: 'Comment obtenir une facture ?', a: 'Votre facture est disponible dans l\'espace "Mon Compte" → "Mes Commandes". Vous pouvez la télécharger au format PDF à tout moment.' },
  { cat: 'livraison', q: 'Quels sont les délais de livraison ?', a: 'Standard (Colissimo) : 3 à 5 jours ouvrés. Express (Chronopost) : lendemain avant 13h. Point Relais (Mondial Relay) : 4 à 7 jours. Les délais sont indicatifs et peuvent varier selon la disponibilité.' },
  { cat: 'livraison', q: 'La livraison est-elle gratuite ?', a: 'La livraison est offerte pour toute commande supérieure à 100 €. En dessous, les frais varient selon le mode choisi : Standard 7,99 €, Express 14,99 €, Point Relais 4,50 €.' },
  { cat: 'livraison', q: 'Puis-je me faire livrer à l\'étranger ?', a: 'Nous livrons actuellement en France métropolitaine, en Belgique, en Suisse et au Luxembourg. Pour toute autre destination, contactez notre service client.' },
  { cat: 'retour', q: 'Comment retourner un produit ?', a: 'Vous disposez de 30 jours pour retourner un produit. Connectez-vous à votre compte, accédez à vos commandes, puis cliquez sur "Retourner un article". Un bon de retour vous sera envoyé par email.' },
  { cat: 'retour', q: 'Quand serai-je remboursé ?', a: 'Le remboursement est effectué sous 5 à 10 jours ouvrés après réception et vérification du produit retourné. Il est crédité sur le moyen de paiement utilisé lors de la commande.' },
  { cat: 'retour', q: 'Le produit reçu est défectueux, que faire ?', a: 'Contactez notre service client dans les 48h avec des photos du produit défectueux. Nous prendrons en charge les frais de retour et vous enverrons un produit de remplacement sans frais.' },
  { cat: 'paiement', q: 'Quels moyens de paiement acceptez-vous ?', a: 'Nous acceptons les cartes bancaires (Visa, Mastercard, American Express) et PayPal. Toutes les transactions sont sécurisées par protocole SSL 3D-Secure.' },
  { cat: 'paiement', q: 'Le paiement en plusieurs fois est-il disponible ?', a: 'Oui, nous proposons le paiement en 3 ou 4 fois sans frais pour les commandes supérieures à 300 € via notre partenaire Alma. Cette option est disponible à l\'étape de paiement.' },
  { cat: 'paiement', q: 'Mon paiement a été refusé, que faire ?', a: 'Vérifiez les informations saisies (numéro, date d\'expiration, CVC). Assurez-vous que votre carte n\'est pas bloquée ou en limite de plafond. Vous pouvez aussi essayer un autre moyen de paiement.' },
  { cat: 'produit', q: 'Les produits sont-ils garantis ?', a: 'Oui, tous nos produits bénéficient d\'une garantie constructeur de 2 ans ainsi que de la garantie légale de conformité. Les détails de garantie sont précisés sur chaque fiche produit.' },
  { cat: 'produit', q: 'Comment vérifier la compatibilité d\'un produit ?', a: 'La fiche technique de chaque produit indique les configurations compatibles. En cas de doute, notre équipe technique est disponible par chat ou par email pour vous conseiller.' },
  { cat: 'produit', q: 'Les stocks sont-ils mis à jour en temps réel ?', a: 'Oui, notre stock est mis à jour en temps réel. Si un produit est affiché "En stock", il est bien disponible. En cas de rupture subite, vous serez informé par email avec un délai de réapprovisionnement.' },
];

function renderFaq() {
  const q = (document.getElementById('faq-search')?.value || '').toLowerCase();
  const list = FAQ_DATA.filter(f => {
    if (faqCatActive !== 'all' && f.cat !== faqCatActive) return false;
    if (q && !f.q.toLowerCase().includes(q) && !f.a.toLowerCase().includes(q)) return false;
    return true;
  });
  const container = document.getElementById('faq-list');
  if (!container) return;
  container.innerHTML = list.length ? list.map((f, i) => `
    <div class="faq-item" data-cat="${f.cat}">
      <div class="faq-question" onclick="toggleFaq(this)">
        <span>${f.q}</span>
        <span class="faq-arrow">▾</span>
      </div>
      <div class="faq-answer">${f.a}</div>
    </div>
  `).join('') : '<p style="color:var(--gray);padding:20px 0;">Aucune question trouvée.</p>';
}

function toggleFaq(el) {
  const answer = el.nextElementSibling;
  const isOpen = answer.classList.contains('open');
  document.querySelectorAll('.faq-answer.open').forEach(a => a.classList.remove('open'));
  document.querySelectorAll('.faq-question.open').forEach(q => q.classList.remove('open'));
  if (!isOpen) {
    answer.classList.add('open');
    el.classList.add('open');
  }
}

function filterFaq() { renderFaq(); }

function setFaqCat(cat, el) {
  faqCatActive = cat;
  document.querySelectorAll('.faq-cat').forEach(b => b.classList.remove('active'));
  el.classList.add('active');
  renderFaq();
}

/* ===== CONTACT LOGIC ===== */
function sendContact() {
  const prenom = document.getElementById('c-prenom')?.value.trim();
  const email = document.getElementById('c-email')?.value.trim();
  const sujet = document.getElementById('c-sujet')?.value;
  const message = document.getElementById('c-message')?.value.trim();
  
  if (!prenom || !email || !sujet || !message) {
    showToast('❌ Veuillez remplir tous les champs obligatoires');
    return;
  }
  
  const success = document.getElementById('contact-success');
  if (success) success.style.display = 'block';
  showToast('✅ Message envoyé avec succès !');
  
  // Reset
  ['c-prenom','c-nom','c-email','c-message','c-commande'].forEach(id => { 
    const el = document.getElementById(id); 
    if(el) el.value=''; 
  });
  const sujetEl = document.getElementById('c-sujet');
  if (sujetEl) sujetEl.value = '';
}

/* ===== SUIVI LOGIC ===== */
function rechercherCommande() {
  const num = document.getElementById('suivi-num')?.value.trim();
  const email = document.getElementById('suivi-email')?.value.trim();
  
  if (!num || !email) {
    showToast('❌ Veuillez renseigner le numéro et l\'email de commande');
    return;
  }
  
  const result = document.getElementById('suivi-result');
  if (!result) return;
  
  result.style.display = 'block';
  const idEl = document.getElementById('suivi-id');
  if (idEl) idEl.textContent = num || 'CMD-2025-00123';

  const now = new Date();
  const fmt = d => d.toLocaleDateString('fr-FR', { day:'2-digit', month:'long', year:'numeric' });
  const addDays = (d, n) => { const r = new Date(d); r.setDate(r.getDate()+n); return r; };

  const dateEl = document.getElementById('suivi-date');
  if (dateEl) dateEl.textContent = fmt(addDays(now, -4));
  
  const dates = ['tl-date-1', 'tl-date-2', 'tl-date-3', 'tl-date-4', 'tl-date-5'];
  const times = [' à 14:32', ' à 14:35', ' à 09:12', ' à 07:45', ''];
  const dayOffsets = [-4, -4, -3, -1, 1];
  
  dates.forEach((id, idx) => {
    const el = document.getElementById(id);
    if (el) el.textContent = fmt(addDays(now, dayOffsets[idx])) + times[idx];
  });

  const articles = panier.length ? panier : [{ id: 1, qty: 1 }, { id: 3, qty: 1 }];
  const articlesEl = document.getElementById('suivi-articles');
  if (articlesEl) {
    articlesEl.innerHTML = articles.map(item => {
      const p = PRODUITS.find(pr => pr.id === item.id);
      if (!p) return '';
      return `
        <div class="suivi-article">
          <img src="${p.img}" alt="${p.nom}" />
          <div class="sa-info"><strong>${p.nomComplet}</strong><br/><span style="font-size:.8rem;color:var(--gray)">Réf: ${p.ref}</span></div>
          <span>Qté: ${item.qty}</span>
          <span class="sa-price">${formatPrice(p.prix * item.qty)}</span>
        </div>
      `;
    }).join('');
  }

  result.scrollIntoView({ behavior: 'smooth', block: 'start' });
  showToast('✅ Commande trouvée !');
}

/* ===== UTILITIES ===== */
function formatPrice(n) {
  return n.toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' €';
}

let toastTimeout;
function showToast(msg) {
  const t = document.getElementById('toast');
  if (!t) return;
  t.textContent = msg;
  t.classList.add('show');
  clearTimeout(toastTimeout);
  toastTimeout = setTimeout(() => t.classList.remove('show'), 3000);
}

/* ===== INITIALIZATION ===== */
document.addEventListener('DOMContentLoaded', () => {
  updateBadge();
  renderFeatured();
});
