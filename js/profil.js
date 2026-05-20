/* ============================================
   TECHSTORE - Profil Utilisateur JavaScript
   ============================================ */

// ============================================
// INITIALISER L'AFFICHAGE DU PROFIL
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    initUserProfile();
});

function initUserProfile() {
    // Récupérer les données utilisateur du stockage local
    const userDataStr = localStorage.getItem('techstore_user') || sessionStorage.getItem('techstore_user');
    
    if (userDataStr) {
        try {
            const userData = JSON.parse(userDataStr);
            if (userData.isLoggedIn) {
                displayUserProfile(userData);
            }
        } catch (error) {
            console.error('Erreur parsing utilisateur:', error);
        }
    }
    
    // Ajouter les event listeners
    const userProfileBtn = document.getElementById('user-profile-btn');
    const userDropdown = document.getElementById('user-dropdown');
    const logoutLink = document.getElementById('logout-link');
    const profileLink = document.getElementById('profile-link');
    
    if (userProfileBtn && userDropdown) {
        userProfileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.classList.toggle('active');
        });
    }
    
    if (logoutLink) {
        logoutLink.addEventListener('click', function(e) {
            e.preventDefault();
            handleLogout();
        });
    }
    
    if (profileLink) {
        profileLink.addEventListener('click', function(e) {
            e.preventDefault();
            goToProfile();
        });
    }
    
    // Fermer le dropdown quand on clique ailleurs
    document.addEventListener('click', function() {
        if (userDropdown && userDropdown.classList.contains('active')) {
            userDropdown.classList.remove('active');
        }
    });
}

// ============================================
// AFFICHER LE PROFIL UTILISATEUR
// ============================================

function displayUserProfile(userData) {
    const btnConnexion = document.getElementById('btn-connexion');
    const userProfileContainer = document.getElementById('user-profile-container');
    const userName = document.getElementById('user-name');
    const userAvatar = document.getElementById('user-avatar');
    
    if (btnConnexion) {
        btnConnexion.style.display = 'none';
    }
    
    if (userProfileContainer) {
        userProfileContainer.style.display = 'block';
    }
    
    if (userName) {
        userName.textContent = userData.name || userData.email.split('@')[0];
    }
    
    // Définir l'image de profil
    if (userAvatar) {
        // Utiliser une photo de profil par défaut ou une image uploadée
        userAvatar.src = userData.profileImage || getDefaultAvatar(userData.name);
    }
}

// ============================================
// OBTENIR UN AVATAR PAR DÉFAUT
// ============================================

function getDefaultAvatar(name) {
    // Retourner une URL d'avatar par défaut avec les initiales
    const initials = name.charAt(0).toUpperCase();
    return `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&background=3b82f6&color=fff&size=36`;
}

// ============================================
// DÉCONNEXION
// ============================================

function handleLogout() {
    // Confirmer la déconnexion
    if (confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
        // Supprimer les données utilisateur
        localStorage.removeItem('techstore_user');
        sessionStorage.removeItem('techstore_user');
        
        // Afficher une notification
        showNotification('Vous avez été déconnecté avec succès');
        
        // Rediriger vers l'accueil après 1 seconde
        setTimeout(() => {
            window.location.href = window.location.pathname.includes('pages/') 
                ? '../index.html' 
                : 'index.html';
        }, 1000);
    }
}

// ============================================
// ALLER AU PROFIL UTILISATEUR
// ============================================

function goToProfile() {
    // Rediriger vers la page profil (vous pouvez créer une page dédiée)
    const pagePath = window.location.pathname.includes('pages/') 
        ? './profil.html' 
        : './pages/profil.html';
    window.location.href = pagePath;
}

// ============================================
// AFFICHER UNE NOTIFICATION
// ============================================

function showNotification(message, type = 'success') {
    // Vérifier si une notification existe déjà
    let notificationDiv = document.getElementById('notification');
    
    if (notificationDiv) {
        notificationDiv.remove();
    }
    
    // Créer la notification
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
    
    // Ajouter l'animation CSS
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
    
    // Supprimer la notification après 3 secondes
    setTimeout(() => {
        notificationDiv.remove();
    }, 3000);
}
