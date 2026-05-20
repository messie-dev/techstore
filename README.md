# TechStore - Site de Vente de Matériel Informatique

## Structure du Projet

```
techstore/
├── index.html                 # Page d'accueil
├── css/
│   └── style.css             # Styles principaux (responsive)
├── js/
│   ├── main.js               # JavaScript principal + données produits
│   ├── catalogue.js          # Filtres et tri du catalogue
│   ├── produit.js            # Page détail produit
│   ├── panier.js             # Gestion du panier
│   └── connexion.js          # Connexion/Inscription
├── pages/
│   ├── catalogue.html        # Page catalogue avec filtres sidebar
│   ├── produit.html          # Page détail produit avec galerie
│   ├── panier.html           # Page panier
│   └── connexion.html        # Page connexion/inscription
└── README.md                 # Documentation
```

## Pages

### 1. Accueil (index.html)
- Header avec navigation
- Section Hero avec carrousel de promotions
- Barre de recherche fonctionnelle
- Tags populaires cliquables
- Section catégories (Ordinateurs, Composants, Périphériques)
- Section Offres Flash & Promotions
- Section Suggestions personnalisées
- Footer avec liens et informations de contact

### 2. Catalogue (pages/catalogue.html)
- Sidebar avec filtres :
  - Recherche textuelle
  - Catégories (checkboxes)
  - Prix (slider)
  - Marques (checkboxes)
  - En stock uniquement
- Options de vue (grille/liste)
- Tri (popularité, prix, nouveautés)
- Grille de produits
- Footer

### 3. Détail Produit (pages/produit.html)
- Breadcrumb navigation
- Galerie d'images avec thumbnails
- SKU du produit
- Notation avec étoiles
- Prix
- Description
- Caractéristiques (garantie, paiement, livraison)
- Sélecteur de quantité
- Boutons "Ajouter au panier" et "Acheter maintenant"
- Onglets Description / Spécifications
- Section "Pourquoi choisir ce produit ?"
- Produits similaires

### 4. Panier (pages/panier.html)
- État vide avec design moderne
- Liste des articles avec images
- Contrôle de quantité (+/-)
- Suppression d'articles
- Vider le panier
- Récapitulatif avec calcul des prix
- Code promo (TECH10, WELCOME15, FLASH20)
- Total avec TVA
- Produits recommandés
- Modal de confirmation de commande

### 5. Connexion (pages/connexion.html)
- Formulaire de connexion
- Formulaire d'inscription
- Connexion sociale (Google, Facebook)
- Affichage/masquage du mot de passe
- Avantages du compte

## Fonctionnalités

### Navigation
- Menu responsive
- Liens actifs selon la page
- Compteur d'articles dans le panier
- Breadcrumb sur les pages internes

### Produits
- Affichage avec images, prix, réductions
- Système de notation avec étoiles
- Badges "En Stock" et "-X%"
- SKU unique par produit
- Click sur produit = page détail

### Panier
- Stockage dans localStorage
- Persistance des données
- Modification des quantités
- Suppression d'articles
- Calcul automatique des totaux
- Codes promo

### Filtres Catalogue
- Par catégorie (checkboxes)
- Par plage de prix (slider)
- Par marque (checkboxes)
- Par recherche textuelle
- En stock uniquement
- Tri multiple

### Notifications
- Toast notification quand on ajoute au panier
- Messages de confirmation
- Alertes d'erreur

## Codes Promo
- `TECH10` : -10%
- `WELCOME15` : -15%
- `FLASH20` : -20%

## Technologies Utilisées
- HTML5
- CSS3 (Flexbox, Grid, Variables CSS)
- JavaScript (ES6+)
- Font Awesome (icônes)
- LocalStorage (persistance du panier et utilisateur)

## Responsive Design
- Desktop (> 1024px)
- Tablette (768px - 1024px)
- Mobile (< 768px)
- Petit mobile (< 480px)

## Installation

1. Télécharger ou cloner le projet
2. Ouvrir `index.html` dans un navigateur
3. Pas besoin de serveur - fonctionne en local

## Navigation Rapide

- **Accueil** : `index.html`
- **Catalogue** : `pages/catalogue.html`
- **Produit** : `pages/produit.html?id=1`
- **Panier** : `pages/panier.html`
- **Connexion** : `pages/connexion.html`

## Auteur
TechStore - 2025
