<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header('Location: ../connexion.php');
    exit();
}

require_once __DIR__ . '/../../bdd.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM produits WHERE id = ?");
$stmt->execute([$id]);
$produit = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produit) {
    header('Location: produits.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {

        if ($produit['image'] && strpos($produit['image'], 'uploads/') === 0) {
            $filePath = __DIR__ . '/../../' . $produit['image'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $stmt = $pdo->prepare("DELETE FROM produits WHERE id = ?");
        $stmt->execute([$id]);

        header('Location: produits.php?deleted=1');
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un Produit - TechStore</title>
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

        .btn-retour {
            background: #f3f4f6; color: #374151; padding: 10px 20px;
            border-radius: 12px; text-decoration: none; font-size: 14px;
            display: flex; align-items: center; gap: 8px; transition: 0.3s;
        }

        .btn-retour:hover { background: #e5e7eb; }

        .confirm-card {
            background: white; border-radius: 22px; padding: 40px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05); max-width: 500px; margin: 40px auto;
            text-align: center;
        }

        .confirm-card .icon {
            font-size: 60px; color: #dc2626; margin-bottom: 20px;
        }

        .confirm-card h3 {
            font-size: 22px; color: #111827; margin-bottom: 10px;
        }

        .confirm-card p {
            color: #6b7280; margin-bottom: 8px; font-size: 15px;
        }

        .confirm-card .product-name {
            font-weight: 700; color: #111827; font-size: 18px;
            margin: 15px 0;
            padding: 12px; background: #f9fafb; border-radius: 12px;
        }

        .confirm-actions {
            display: flex; gap: 15px; justify-content: center; margin-top: 25px;
        }

        .btn-cancel {
            background: #f3f4f6; color: #374151; border: none; padding: 12px 28px;
            border-radius: 12px; cursor: pointer; font-size: 15px; font-weight: 600;
            text-decoration: none; transition: 0.3s;
        }

        .btn-cancel:hover { background: #e5e7eb; }

        .btn-delete-confirm {
            background: #dc2626; color: white; border: none; padding: 12px 28px;
            border-radius: 12px; cursor: pointer; font-size: 15px; font-weight: 600;
            transition: 0.3s;
        }

        .btn-delete-confirm:hover { background: #b91c1c; }

        @media (max-width: 768px) {
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
            <h2>Supprimer un Produit</h2>
            <a href="produits.php" class="btn-retour"><i class="fa-solid fa-arrow-left"></i> Retour à la liste</a>
        </div>

        <div class="confirm-card">
            <div class="icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <h3>Êtes-vous sûr ?</h3>
            <p>Vous êtes sur le point de supprimer le produit suivant :</p>
            <div class="product-name">
                <?= htmlspecialchars($produit['nom']) ?>
            </div>
            <p style="color: #dc2626; font-size: 13px;">
                <i class="fa-solid fa-info-circle"></i>
                Cette action est irréversible.
            </p>

            <form method="POST">
                <input type="hidden" name="confirm" value="yes">
                <div class="confirm-actions">
                    <a href="produits.php" class="btn-cancel"><i class="fa-solid fa-times"></i> Annuler</a>
                    <button type="submit" class="btn-delete-confirm"><i class="fa-solid fa-trash"></i> Confirmer la suppression</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
