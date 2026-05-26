<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../bdd.php';

$action = $_GET['action'] ?? 'list';

switch ($action) {

    case 'list':
        $categorie = $_GET['categorie'] ?? '';
        $marque = $_GET['marque'] ?? '';
        $search = $_GET['search'] ?? '';
        $min_price = $_GET['min_price'] ?? 0;
        $max_price = $_GET['max_price'] ?? 999999;
        $sort = $_GET['sort'] ?? 'date_desc';

        $where = [];
        $params = [];

        if ($categorie) {
            $where[] = "LOWER(c.nom) = ?";
            $params[] = strtolower($categorie);
        }

        if ($marque) {
            $where[] = "LOWER(p.marque) LIKE ?";
            $params[] = '%' . strtolower($marque) . '%';
        }

        if ($search) {
            $where[] = "(LOWER(p.nom) LIKE ? OR LOWER(p.description) LIKE ? OR LOWER(p.marque) LIKE ?)";
            $s = '%' . strtolower($search) . '%';
            $params[] = $s;
            $params[] = $s;
            $params[] = $s;
        }

        if ($min_price > 0) {
            $where[] = "p.prix >= ?";
            $params[] = $min_price;
        }

        if ($max_price < 999999) {
            $where[] = "p.prix <= ?";
            $params[] = $max_price;
        }

        $sql = "SELECT p.*, c.nom as categorie_nom
                FROM produits p
                LEFT JOIN categories c ON p.categorie_id = c.id";

        if ($where) {
            $sql .= " WHERE " . implode(" AND ", $where);
        }

        switch ($sort) {
            case 'price_asc': $sql .= " ORDER BY p.prix ASC"; break;
            case 'price_desc': $sql .= " ORDER BY p.prix DESC"; break;
            case 'nom_asc': $sql .= " ORDER BY p.nom ASC"; break;
            case 'nom_desc': $sql .= " ORDER BY p.nom DESC"; break;
            default: $sql .= " ORDER BY p.date_creation DESC";
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = array_map(function ($p) {
            $image = $p['image'] ?? '';
            if ($image && strpos($image, 'http') !== 0) {
                $image = '../' . $image;
            }
            if (!$image) {
                $image = 'https://via.placeholder.com/400x300?text=TechStore';
            }

            return [
                'id' => (int)$p['id'],
                'name' => $p['nom'],
                'category' => strtolower($p['categorie_nom'] ?? ''),
                'brand' => strtolower($p['marque'] ?? ''),
                'price' => (float)$p['prix'],
                'oldPrice' => null,
                'discount' => 0,
                'image' => $image,
                'rating' => 4.5,
                'reviews' => 0,
                'stock' => (int)$p['stock'] > 0,
                'description' => $p['description'] ?? '',
                'garantie' => $p['garantie'] ?? '',
                'date_creation' => $p['date_creation'] ?? '',
            ];
        }, $produits);

        echo json_encode($result);
        break;

    case 'detail':
        $id = (int)($_GET['id'] ?? 0);
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'ID produit requis']);
            exit;
        }

        $stmt = $pdo->prepare("SELECT p.*, c.nom as categorie_nom FROM produits p LEFT JOIN categories c ON p.categorie_id = c.id WHERE p.id = ?");
        $stmt->execute([$id]);
        $p = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$p) {
            http_response_code(404);
            echo json_encode(['error' => 'Produit introuvable']);
            exit;
        }

        $image = $p['image'] ?? '';
        if ($image && strpos($image, 'http') !== 0) {
            $image = '../' . $image;
        }
        if (!$image) {
            $image = 'https://via.placeholder.com/400x300?text=TechStore';
        }

        echo json_encode([
            'id' => (int)$p['id'],
            'name' => $p['nom'],
            'category' => strtolower($p['categorie_nom'] ?? ''),
            'brand' => strtolower($p['marque'] ?? ''),
            'price' => (float)$p['prix'],
            'oldPrice' => null,
            'discount' => 0,
            'image' => $image,
            'rating' => 4.5,
            'reviews' => 0,
            'stock' => (int)$p['stock'] > 0,
            'description' => $p['description'] ?? '',
            'garantie' => $p['garantie'] ?? '',
            'date_creation' => $p['date_creation'] ?? '',
        ]);
        break;

    case 'categories':
        $stmt = $pdo->query("SELECT * FROM categories ORDER BY nom");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;

    default:
        http_response_code(400);
        echo json_encode(['error' => 'Action inconnue']);
}
