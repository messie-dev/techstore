<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header('Location: ../connexion.php');
    exit();
}

require_once __DIR__ . '/../../bdd.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT p.*, c.nom as categorie_nom FROM produits p LEFT JOIN categories c ON p.categorie_id = c.id WHERE p.id = ?");
$stmt->execute([$id]);
$produit = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produit) {
    header('Location: produits.php');
    exit();
}

$imgSrc = $produit['image'] ? $produit['image'] : 'https://via.placeholder.com/400x300?text=TechStore';
if ($imgSrc && strpos($imgSrc, 'http') !== 0) {
    $imgSrc = '../../' . $imgSrc;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Produit - TechStore</title>
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

        .nav-actions { display: flex; gap: 10px; }

        .btn-action {
            padding: 10px 20px; border-radius: 12px; text-decoration: none;
            font-size: 14px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; transition: 0.3s;
        }

        .btn-edit { background: #dbeafe; color: #1d4ed8; }
        .btn-edit:hover { background: #bfdbfe; }
        .btn-delete { background: #fee2e2; color: #dc2626; }
        .btn-delete:hover { background: #fecaca; }
        .btn-back { background: #f3f4f6; color: #374151; }
        .btn-back:hover { background: #e5e7eb; }

        .detail-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 30px;
        }

        .detail-card {
            background: white; border-radius: 22px; padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .detail-card.full { grid-column: 1 / -1; }

        .product-image-large {
            width: 100%; max-height: 400px; object-fit: contain; border-radius: 16px;
            background: #f9fafb;
        }

        .info-table { width: 100%; }

        .info-table tr { border-bottom: 1px solid #f3f4f6; }

        .info-table td { padding: 14px 0; font-size: 15px; }

        .info-table .label { color: #6b7280; font-weight: 500; width: 160px; }
        .info-table .value { color: #111827; font-weight: 600; }

        .stock-badge {
            padding: 4px 12px; border-radius: 20px; font-size: 13px; font-weight: 600;
        }

        .stock-ok { background: #d1fae5; color: #065f46; }
        .stock-nok { background: #fee2e2; color: #991b1b; }

        .description-text {
            color: #374151; font-size: 15px; line-height: 1.7;
        }

        @media (max-width: 900px) {
            .detail-grid { grid-template-columns: 1fr; }
            .sidebar { width: 100%; height: auto; position: relative; }
            .main { margin-left: 0; }
            body { flex-direction: column; }
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
            <h2>Détails du Produit</h2>
            <div class="nav-actions">
                <a href="produits.php" class="btn-action btn-back"><i class="fa-solid fa-arrow-left"></i> Retour</a>
                <a href="produit_modifier.php?id=<?= $produit['id'] ?>" class="btn-action btn-edit"><i class="fa-solid fa-pen"></i> Modifier</a>
                <a href="produit_supprimer.php?id=<?= $produit['id'] ?>" class="btn-action btn-delete"><i class="fa-solid fa-trash"></i> Supprimer</a>
            </div>
        </div>

        <div class="detail-grid">
            <div class="detail-card">
                <img src="<?= htmlspecialchars($imgSrc) ?>" alt="<?= htmlspecialchars($produit['nom']) ?>" class="product-image-large">
            </div>

            <div class="detail-card">
                <table class="info-table">
                    <tr>
                        <td class="label">Nom</td>
                        <td class="value"><?= htmlspecialchars($produit['nom']) ?></td>
                    </tr>
                    <tr>
                        <td class="label">Catégorie</td>
                        <td class="value"><?= htmlspecialchars($produit['categorie_nom'] ?? 'Non catégorisé') ?></td>
                    </tr>
                    <tr>
                        <td class="label">Marque</td>
                        <td class="value"><?= htmlspecialchars($produit['marque'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <td class="label">Prix</td>
                        <td class="value" style="font-size: 22px; color: #0d47d9;"><?= number_format($produit['prix'], 0, ',', ' ') ?> FCFA</td>
                    </tr>
                    <tr>
                        <td class="label">Stock</td>
                        <td class="value">
                            <?php if ($produit['stock'] > 0): ?>
                                <span class="stock-badge stock-ok"><?= $produit['stock'] ?> en stock</span>
                            <?php else: ?>
                                <span class="stock-badge stock-nok">Rupture de stock</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Garantie</td>
                        <td class="value"><?= htmlspecialchars($produit['garantie'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <td class="label">Date d'ajout</td>
                        <td class="value"><?= date('d/m/Y H:i', strtotime($produit['date_creation'])) ?></td>
                    </tr>
                    <tr>
                        <td class="label">ID Produit</td>
                        <td class="value">#<?= $produit['id'] ?></td>
                    </tr>
                </table>
            </div>

            <div class="detail-card full">
                <h3 style="margin-bottom: 15px; color: #111827;">Description</h3>
                <div class="description-text">
                    <?= nl2br(htmlspecialchars($produit['description'] ?? 'Aucune description fournie.')) ?>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
