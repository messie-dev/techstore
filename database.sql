CREATE DATABASE IF NOT EXISTS TechStore;
USE TechStore;

-- =========================
-- TABLE DES UTILISATEURS
-- =========================
CREATE TABLE IF NOT EXISTS utilisateurs (
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
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT
);

-- =========================
-- TABLE DES PRODUITS
-- =========================
CREATE TABLE IF NOT EXISTS produits (
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
    FOREIGN KEY (categorie_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- =========================
-- TABLE DU PANIER
-- =========================
CREATE TABLE IF NOT EXISTS panier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    produit_id INT NOT NULL,
    quantite INT DEFAULT 1,
    date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (produit_id) REFERENCES produits(id) ON DELETE CASCADE
);

-- =========================
-- TABLE DES COMMANDES
-- =========================
CREATE TABLE IF NOT EXISTS commandes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    montant_total DECIMAL(10,2) NOT NULL,
    statut ENUM('en attente', 'payee', 'expediee', 'livree', 'annulee') DEFAULT 'en attente',
    adresse_livraison TEXT,
    date_commande TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE
);

-- =========================
-- DETAILS DES COMMANDES
-- =========================
CREATE TABLE IF NOT EXISTS details_commandes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    commande_id INT NOT NULL,
    produit_id INT NOT NULL,
    quantite INT NOT NULL,
    prix_unitaire DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (commande_id) REFERENCES commandes(id) ON DELETE CASCADE,
    FOREIGN KEY (produit_id) REFERENCES produits(id) ON DELETE CASCADE
);

-- =========================
-- TABLE DES PAIEMENTS
-- =========================
CREATE TABLE IF NOT EXISTS paiements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    commande_id INT NOT NULL,
    methode_paiement ENUM('Flooz', 'TMoney', 'Carte bancaire', 'Especes') NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    statut ENUM('en attente', 'effectue', 'echoue') DEFAULT 'en attente',
    date_paiement TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (commande_id) REFERENCES commandes(id) ON DELETE CASCADE
);

-- =========================
-- TABLE DES LIVRAISONS
-- =========================
CREATE TABLE IF NOT EXISTS livraisons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    commande_id INT NOT NULL,
    adresse TEXT NOT NULL,
    ville VARCHAR(100),
    pays VARCHAR(100),
    statut ENUM('preparation', 'en cours', 'livre') DEFAULT 'preparation',
    date_livraison DATE,
    FOREIGN KEY (commande_id) REFERENCES commandes(id) ON DELETE CASCADE
);

-- =========================
-- TABLE DES AVIS
-- =========================
CREATE TABLE IF NOT EXISTS avis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    produit_id INT NOT NULL,
    note INT CHECK (note >= 1 AND note <= 5),
    commentaire TEXT,
    date_avis TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (produit_id) REFERENCES produits(id) ON DELETE CASCADE
);

-- =========================
-- TABLE DES FAVORIS
-- =========================
CREATE TABLE IF NOT EXISTS favoris (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    produit_id INT NOT NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (produit_id) REFERENCES produits(id) ON DELETE CASCADE
);

-- =========================
-- INSERTION DES CATEGORIES
-- =========================
INSERT IGNORE INTO categories (nom, description) VALUES
('Ordinateurs', 'PC portables et ordinateurs de bureau'),
('Telephones', 'Smartphones et accessoires mobiles'),
('Imprimantes', 'Imprimantes et scanners'),
('Accessoires', 'Claviers, souris, casques et autres'),
('Reseaux', 'Routeurs, switchs et equipements reseau');

-- =========================
-- INSERTION DE PRODUITS
-- =========================
INSERT IGNORE INTO produits (categorie_id, nom, description, prix, stock, image, marque, garantie) VALUES
(1, 'HP EliteBook', 'Ordinateur portable HP Core i5', 450000, 10, 'hp.jpg', 'HP', '12 mois'),
(1, 'Dell Inspiron', 'PC Dell Core i7 16GB RAM', 650000, 5, 'dell.jpg', 'Dell', '12 mois'),
(2, 'Samsung Galaxy A54', 'Smartphone Android 128GB', 210000, 20, 'samsung.jpg', 'Samsung', '6 mois'),
(4, 'Souris Logitech', 'Souris sans fil', 15000, 50, 'souris.jpg', 'Logitech', '3 mois'),
(4, 'Clavier Gamer RGB', 'Clavier mecanique lumineux', 35000, 30, 'clavier.jpg', 'Redragon', '6 mois');

-- =========================
-- INSERTION DES UTILISATEURS
-- =========================
-- Mot de passe : admin123 (hache avec password_hash)
INSERT IGNORE INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe, role, adresse)
VALUES ('Admin', 'Systeme', 'admin@gmail.com', '90000000', '$2y$12$eSFEvnL8qvgz2D7bWt6Ctu0DfQv0A3CSefYZT2xiXaZ6VlIX.Q392', 'admin', 'Lome - Togo');

-- Mot de passe : client123 (hache avec password_hash)
INSERT IGNORE INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe, role, adresse)
VALUES ('Client', 'Test', 'client@gmail.com', '90000001', '$2y$12$4j/RXSLPCU5hoCrT37KydeGSKMzjuSaJzX5x8v/PsNVAlZKuU4KrK', 'client', 'Lome - Togo');