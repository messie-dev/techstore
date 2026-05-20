/* ============================================
   TECHSTORE - Page Connexion JavaScript
   ============================================ */

// ============================================
// BASCULE ENTRE LOGIN ET REGISTER
// ============================================

function showRegister() {
    document.getElementById('login-form').classList.add('hidden');
    document.getElementById('register-form').classList.remove('hidden');
}

function showLogin() {
    document.getElementById('register-form').classList.add('hidden');
    document.getElementById('login-form').classList.remove('hidden');
}

// ============================================
// TOGGLE PASSWORD VISIBILITY
// ============================================

function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const button = input.nextElementSibling;
    const icon = button.querySelector('i');

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// ============================================
// LOGIN
// ============================================

function handleLogin(event) {
    event.preventDefault();

    const email = document.getElementById('login-email').value;
    const password = document.getElementById('login-password').value;
    const rememberMe = document.getElementById('remember-me').checked;

    // Simulation de connexion
    // Dans une vraie application, vous feriez un appel API ici

    // Stocker l'utilisateur dans localStorage
    const user = {
        email: email,
        name: email.split('@')[0],
        isLoggedIn: true
    };

    if (rememberMe) {
        localStorage.setItem('techstore_user', JSON.stringify(user));
    } else {
        sessionStorage.setItem('techstore_user', JSON.stringify(user));
    }

    // Afficher une notification
    showNotification('Connexion réussie ! Redirection...');

    // Rediriger vers l'accueil après 1 seconde
    setTimeout(() => {
        window.location.href = '../index.php';
    }, 1000);
}

// ============================================
// NOTIFICATION
// ============================================

function showNotification(message, type = 'success') {
    // Supprimer les notifications existantes
    const existing = document.querySelector('.notification');
    if (existing) existing.remove();

    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
        <span>${message}</span>
    `;

    notification.style.cssText = `
        position: fixed;
        top: 90px;
        right: 20px;
        background: ${type === 'success' ? '#22c55e' : '#ef4444'};
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

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'slideIn 0.3s ease reverse';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// ============================================
// VÉRIFIER SI L'UTILISATEUR EST CONNECTÉ
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    const user = JSON.parse(localStorage.getItem('techstore_user') || sessionStorage.getItem('techstore_user'));

    if (user && user.isLoggedIn) {
        // Mettre à jour le bouton de connexion
        const btnConnexion = document.querySelector('.btn-connexion');
        if (btnConnexion) {
            btnConnexion.textContent = user.firstName || user.name || 'Mon Compte';
            btnConnexion.onclick = () => {
                window.location.href = 'profil.php';
            };
        }
    }
});
