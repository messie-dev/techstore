


Elle contient :

* Les utilisateurs
* Les catégories de produits
* Les produits
* Les commandes
* Les détails des commandes
* Les paiements
* Les livraisons
* Les avis clients
* Les favoris
* Le panier

Compatible avec MySQL / MariaDB.

---

# Script SQL complet

```sql
CREATE DATABASE IF NOT EXISTS vente_materiel_informatique;
USE vente_materiel_informatique;

-- =========================
-- TABLE DES UTILISATEURS
-- =========================
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    telephone VARCHAR(20),
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('admin', 'client') DEFAULT 'client',
    adresse TEXT,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- TABLE DES CATEGORIES
-- =========================
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT
);

-- =========================
-- TABLE DES PRODUITS
-- =========================
CREATE TABLE produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categorie_id INT,
    nom VARCHAR(150) NOT NULL,
    description TEXT,
    prix DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0,
    image VARCHAR(255),
    marque VARCHAR(100),
    garantie VARCHAR(100),
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (categorie_id)
    REFERENCES categories(id)
    ON DELETE SET NULL
);

-- =========================
-- TABLE DU PANIER
-- =========================
CREATE TABLE panier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    produit_id INT NOT NULL,
    quantite INT DEFAULT 1,
    date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (utilisateur_id)
    REFERENCES utilisateurs(id)
    ON DELETE CASCADE,

    FOREIGN KEY (produit_id)
    REFERENCES produits(id)
    ON DELETE CASCADE
);

-- =========================
-- TABLE DES COMMANDES
-- =========================
CREATE TABLE commandes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    montant_total DECIMAL(10,2) NOT NULL,
    statut ENUM('en attente', 'payée', 'expédiée', 'livrée', 'annulée') DEFAULT 'en attente',
    adresse_livraison TEXT,
    date_commande TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (utilisateur_id)
    REFERENCES utilisateurs(id)
    ON DELETE CASCADE
);

-- =========================
-- DETAILS DES COMMANDES
-- =========================
CREATE TABLE details_commandes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    commande_id INT NOT NULL,
    produit_id INT NOT NULL,
    quantite INT NOT NULL,
    prix_unitaire DECIMAL(10,2) NOT NULL,

    FOREIGN KEY (commande_id)
    REFERENCES commandes(id)
    ON DELETE CASCADE,

    FOREIGN KEY (produit_id)
    REFERENCES produits(id)
    ON DELETE CASCADE
);

-- =========================
-- TABLE DES PAIEMENTS
-- =========================
CREATE TABLE paiements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    commande_id INT NOT NULL,
    methode_paiement ENUM('Flooz', 'TMoney', 'Carte bancaire', 'Espèces') NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    statut ENUM('en attente', 'effectué', 'échoué') DEFAULT 'en attente',
    date_paiement TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (commande_id)
    REFERENCES commandes(id)
    ON DELETE CASCADE
);

-- =========================
-- TABLE DES LIVRAISONS
-- =========================
CREATE TABLE livraisons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    commande_id INT NOT NULL,
    adresse TEXT NOT NULL,
    ville VARCHAR(100),
    pays VARCHAR(100),
    statut ENUM('préparation', 'en cours', 'livré') DEFAULT 'préparation',
    date_livraison DATE,

    FOREIGN KEY (commande_id)
    REFERENCES commandes(id)
    ON DELETE CASCADE
);

-- =========================
-- TABLE DES AVIS
-- =========================
CREATE TABLE avis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    produit_id INT NOT NULL,
    note INT CHECK (note >= 1 AND note <= 5),
    commentaire TEXT,
    date_avis TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (utilisateur_id)
    REFERENCES utilisateurs(id)
    ON DELETE CASCADE,

    FOREIGN KEY (produit_id)
    REFERENCES produits(id)
    ON DELETE CASCADE
);

-- =========================
-- TABLE DES FAVORIS
-- =========================
CREATE TABLE favoris (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    produit_id INT NOT NULL,

    FOREIGN KEY (utilisateur_id)
    REFERENCES utilisateurs(id)
    ON DELETE CASCADE,

    FOREIGN KEY (produit_id)
    REFERENCES produits(id)
    ON DELETE CASCADE
);

-- =========================
-- INSERTION DES CATEGORIES
-- =========================
INSERT INTO categories (nom, description) VALUES
('Ordinateurs', 'PC portables et ordinateurs de bureau'),
('Téléphones', 'Smartphones et accessoires mobiles'),
('Imprimantes', 'Imprimantes et scanners'),
('Accessoires', 'Claviers, souris, casques et autres'),
('Réseaux', 'Routeurs, switchs et équipements réseau');

-- =========================
-- INSERTION DE PRODUITS
-- =========================
INSERT INTO produits (categorie_id, nom, description, prix, stock, image, marque, garantie) VALUES
(1, 'HP EliteBook', 'Ordinateur portable HP Core i5', 450000, 10, 'hp.jpg', 'HP', '12 mois'),
(1, 'Dell Inspiron', 'PC Dell Core i7 16GB RAM', 650000, 5, 'dell.jpg', 'Dell', '12 mois'),
(2, 'Samsung Galaxy A54', 'Smartphone Android 128GB', 210000, 20, 'samsung.jpg', 'Samsung', '6 mois'),
(4, 'Souris Logitech', 'Souris sans fil', 15000, 50, 'souris.jpg', 'Logitech', '3 mois'),
(4, 'Clavier Gamer RGB', 'Clavier mécanique lumineux', 35000, 30, 'clavier.jpg', 'Redragon', '6 mois');

-- =========================
-- INSERTION D'UN ADMIN
-- =========================
INSERT INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe, role, adresse)
VALUES
('Admin', 'Systeme', 'admin@gmail.com', '90000000', 'admin123', 'admin', 'Lomé - Togo');
```

---

# Comment importer la base de données

## Avec phpMyAdmin

1. Ouvrir phpMyAdmin
2. Créer une nouvelle base de données
3. Cliquer sur l’onglet Importer
4. Choisir le fichier SQL
5. Cliquer sur Exécuter

---

# Tables principales

| Table             | Description                         |
| ----------------- | ----------------------------------- |
| utilisateurs      | Gestion des comptes                 |
| categories        | Catégories des produits             |
| produits          | Produits disponibles                |
| panier            | Produits ajoutés au panier          |
| commandes         | Informations des commandes          |
| details_commandes | Produits contenus dans une commande |
| paiements         | Gestion des paiements               |
| livraisons        | Informations de livraison           |
| avis              | Avis des clients                    |
| favoris           | Liste des favoris                   |

---

# Fonctionnalités couvertes

* Authentification
* Gestion des produits
* Gestion des catégories
* Panier
* Commandes
* Paiements
* Livraison
* Avis clients
* Favoris
* Gestion du stock
* Administration
