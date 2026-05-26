<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header('Location: ../connexion.php');
    exit();
}

require_once __DIR__ . '/../../bdd.php';

$search = $_GET['search'] ?? '';

$sql = "SELECT p.*, c.nom as categorie_nom FROM produits p LEFT JOIN categories c ON p.categorie_id = c.id";
$params = [];

if ($search) {
    $sql .= " WHERE p.nom LIKE ? OR p.marque LIKE ?";
    $params[] = '%' . $search . '%';
    $params[] = '%' . $search . '%';
}

$sql .= " ORDER BY p.date_creation DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

$countStmt = $pdo->query("SELECT COUNT(*) FROM produits");
$totalProduits = $countStmt->fetchColumn();

$catStmt = $pdo->query("SELECT COUNT(*) FROM categories");
$totalCategories = $catStmt->fetchColumn();

$stockStmt = $pdo->query("SELECT COUNT(*) FROM produits WHERE stock > 0");
$enStock = $stockStmt->fetchColumn();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Produits - TechStore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }

        body { display: flex; background: #f4f7fc; min-height: 100vh; }

        .sidebar {
            width: 260px; background: linear-gradient(180deg, #0d47d9, #0039cb);
            color: white; padding: 25px; position: fixed; height: 100%;
            display: flex; flex-direction: column; justify-content: space-between;
        }

        .logo { font-size: 34px; font-weight: bold; margin-bottom: 40px; }

        .menu { list-style: none; }

        .menu li {
            padding: 15px 18px; margin-bottom: 12px; border-radius: 14px;
            cursor: pointer; transition: 0.3s; display: flex; align-items: center;
            gap: 15px; font-size: 17px;
        }

        .menu li:hover, .menu .active { background: rgba(255,255,255,0.15); }

        .menu li a { color: white; text-decoration: none; width: 100%; display: flex; align-items: center; gap: 15px; }

        .admin-box {
            background: rgba(255,255,255,0.1); padding: 15px; border-radius: 18px; text-align: center;
        }

        .admin-box h3 { font-size: 16px; }
        .admin-box p { font-size: 13px; opacity: 0.8; }

        .main { margin-left: 260px; width: 100%; padding: 30px; }

        .navbar {
            background: white; border-radius: 22px; padding: 18px 25px;
            display: flex; justify-content: space-between; align-items: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05); margin-bottom: 30px;
        }

        .navbar h2 { color: #222; font-size: 22px; }

        .nav-actions { display: flex; align-items: center; gap: 15px; }

        .btn-ajouter {
            background: #0d47d9; color: white; border: none; padding: 12px 24px;
            border-radius: 12px; cursor: pointer; font-size: 15px; font-weight: 600;
            display: flex; align-items: center; gap: 8px; transition: 0.3s; text-decoration: none;
        }

        .btn-ajouter:hover { background: #0039cb; }

        .search-input {
            padding: 10px 16px; border: 2px solid #e5e7eb; border-radius: 12px;
            font-size: 14px; outline: none; width: 280px; transition: 0.3s;
        }

        .search-input:focus { border-color: #0d47d9; }

        .cards {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px; margin-bottom: 30px;
        }

        .card {
            background: white; padding: 22px; border-radius: 18px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .card h3 { color: #777; font-size: 14px; margin-bottom: 8px; }
        .card h2 { color: #222; font-size: 28px; }

        .table-container {
            background: white; border-radius: 22px; padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05); overflow-x: auto;
        }

        table { width: 100%; border-collapse: collapse; }

        thead th {
            text-align: left; padding: 14px 12px; color: #6b7280;
            font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;
            border-bottom: 2px solid #e5e7eb;
        }

        tbody td {
            padding: 14px 12px; border-bottom: 1px solid #f3f4f6;
            color: #374151; font-size: 14px; vertical-align: middle;
        }

        tbody tr:hover { background: #f9fafb; }

        .prod-img {
            width: 50px; height: 50px; border-radius: 10px; object-fit: cover;
        }

        .stock-badge {
            padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;
        }

        .stock-ok { background: #d1fae5; color: #065f46; }
        .stock-nok { background: #fee2e2; color: #991b1b; }

        .actions { display: flex; gap: 8px; }

        .btn-action {
            padding: 8px 14px; border-radius: 10px; border: none; cursor: pointer;
            font-size: 13px; transition: 0.3s; text-decoration: none; display: inline-flex;
            align-items: center; gap: 5px;
        }

        .btn-edit { background: #dbeafe; color: #1d4ed8; }
        .btn-edit:hover { background: #bfdbfe; }
        .btn-delete { background: #fee2e2; color: #dc2626; }
        .btn-delete:hover { background: #fecaca; }
        .btn-view { background: #f3f4f6; color: #374151; }
        .btn-view:hover { background: #e5e7eb; }

        .no-results {
            text-align: center; padding: 60px 20px; color: #9ca3af;
        }

        .no-results i { font-size: 48px; margin-bottom: 16px; }
        .no-results h3 { color: #6b7280; margin-bottom: 8px; }

        @media(max-width: 900px) {
            .sidebar { width: 100%; height: auto; position: relative; }
            .main { margin-left: 0; }
            body { flex-direction: column; }
        }

        @media(max-width: 768px) {
            .navbar { flex-direction: column; gap: 15px; }
            .search-input { width: 100%; }
            .nav-actions { width: 100%; }
            .btn-ajouter { flex: 1; justify-content: center; }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div>
            <div class="logo">TechStore</div>
            <ul class="menu">
                <li><a href="../../dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
                <li class="active"><a href="produits.php"><i class="fa-solid fa-box"></i> Produits</a></li>
                <li><a href="#"><i class="fa-solid fa-cart-shopping"></i> Commandes</a></li>
                <li><a href="#"><i class="fa-solid fa-users"></i> Clients</a></li>
                <li><a href="#"><i class="fa-solid fa-credit-card"></i> Paiements</a></li>
                <li><a href="#"><i class="fa-solid fa-chart-column"></i> Statistiques</a></li>
                <li><a href="#"><i class="fa-solid fa-gear"></i> Paramètres</a></li>
                <li><a href="../../index.php"><i class="fa-solid fa-arrow-left"></i> Retour au site</a></li>
            </ul>
        </div>
        <div class="admin-box">
            <h3><?= htmlspecialchars($_SESSION['prenom'] . ' ' . $_SESSION['nom']) ?></h3>
            <p><?= htmlspecialchars($_SESSION['email']) ?></p>
        </div>
    </div>

    <div class="main">
        <div class="navbar">
            <h2>Gestion des Produits</h2>
            <div class="nav-actions">
                <form method="GET" style="display:flex; gap:10px;">
                    <input type="text" name="search" class="search-input" placeholder="Rechercher un produit..." value="<?= htmlspecialchars($search) ?>">
                </form>
                <a href="produit_ajouter.php" class="btn-ajouter"><i class="fa-solid fa-plus"></i> Ajouter</a>
            </div>
        </div>

        <div class="cards">
            <div class="card">
                <h3>Total Produits</h3>
                <h2><?= $totalProduits ?></h2>
            </div>
            <div class="card">
                <h3>Catégories</h3>
                <h2><?= $totalCategories ?></h2>
            </div>
            <div class="card">
                <h3>En Stock</h3>
                <h2><?= $enStock ?></h2>
            </div>
            <div class="card">
                <h3>En Rupture</h3>
                <h2><?= $totalProduits - $enStock ?></h2>
            </div>
        </div>

        <div class="table-container">
            <?php if (count($produits) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Marque</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Garantie</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produits as $p): ?>
                    <?php
                        $img = $p['image'] ? $p['image'] : 'https://via.placeholder.com/50?text=N/A';
                        if ($img && strpos($img, 'http') !== 0) {
                            $img = '../../' . $img;
                        }
                    ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($img) ?>" alt="" class="prod-img"></td>
                        <td><strong><?= htmlspecialchars(mb_substr($p['nom'], 0, 40)) ?><?= mb_strlen($p['nom']) > 40 ? '...' : '' ?></strong></td>
                        <td><?= htmlspecialchars($p['categorie_nom'] ?? 'Non catégorisé') ?></td>
                        <td><?= htmlspecialchars($p['marque'] ?? '-') ?></td>
                        <td><?= number_format($p['prix'], 0, ',', ' ') ?> F</td>
                        <td>
                            <?php if ($p['stock'] > 0): ?>
                                <span class="stock-badge stock-ok"><?= $p['stock'] ?> en stock</span>
                            <?php else: ?>
                                <span class="stock-badge stock-nok">Rupture</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($p['garantie'] ?? '-') ?></td>
                        <td>
                            <div class="actions">
                                <a href="produit_details.php?id=<?= $p['id'] ?>" class="btn-action btn-view"><i class="fa-solid fa-eye"></i></a>
                                <a href="produit_modifier.php?id=<?= $p['id'] ?>" class="btn-action btn-edit"><i class="fa-solid fa-pen"></i></a>
                                <a href="produit_supprimer.php?id=<?= $p['id'] ?>" class="btn-action btn-delete" onclick="return confirm('Confirmer la suppression ?')"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="no-results">
                <i class="fa-solid fa-box-open"></i>
                <h3><?= $search ? 'Aucun produit trouvé pour "' . htmlspecialchars($search) . '"' : 'Aucun produit pour le moment' ?></h3>
                <p><?= $search ? 'Essayez un autre terme de recherche.' : 'Commencez par ajouter votre premier produit.' ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
