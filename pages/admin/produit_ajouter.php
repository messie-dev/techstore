<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header('Location: ../connexion.php');
    exit();
}

require_once __DIR__ . '/../../bdd.php';

$categories = $pdo->query("SELECT * FROM categories ORDER BY nom")->fetchAll(PDO::FETCH_ASSOC);

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = trim($_POST['nom'] ?? '');
    $categorie_id = (int)($_POST['categorie_id'] ?? 0);
    $description = trim($_POST['description'] ?? '');
    $prix = (float)($_POST['prix'] ?? 0);
    $stock = (int)($_POST['stock'] ?? 0);
    $marque = trim($_POST['marque'] ?? '');
    $garantie = trim($_POST['garantie'] ?? '');

    if (!$nom || !$prix || !$categorie_id) {
        $error = 'Veuillez remplir tous les champs obligatoires.';
    } else {

        $imagePath = '';

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['image'];
            $tmpName = $file['tmp_name'];

            $allowed = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $tmpName);
            finfo_close($finfo);

            if (in_array($mime, $allowed)) {
                $ext = match ($mime) {
                    'image/jpeg', 'image/jpg' => 'jpg',
                    'image/png' => 'png',
                    'image/webp' => 'webp',
                    default => 'jpg',
                };

                $uploadDir = __DIR__ . '/../../uploads/produits/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $filename = uniqid('prod_') . '.' . $ext;
                if (move_uploaded_file($tmpName, $uploadDir . $filename)) {
                    $imagePath = 'uploads/produits/' . $filename;
                }
            } else {
                $error = 'Format d\'image non supporté (jpg, png, webp seulement).';
            }
        }

        if (!$error) {
            $stmt = $pdo->prepare("INSERT INTO produits (categorie_id, nom, description, prix, stock, image, marque, garantie) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$categorie_id, $nom, $description, $prix, $stock, $imagePath, $marque, $garantie]);

            $success = 'Produit ajouté avec succès !';
            $_POST = [];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Produit - TechStore</title>
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

        .form-container {
            background: white; border-radius: 22px; padding: 35px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05); max-width: 800px; margin: 0 auto;
        }

        .form-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 20px;
        }

        .form-group { margin-bottom: 20px; }
        .form-group.full { grid-column: 1 / -1; }

        .form-group label {
            display: block; font-size: 14px; font-weight: 600;
            color: #374151; margin-bottom: 6px;
        }

        .form-group label .required { color: #dc2626; }

        .form-control {
            width: 100%; padding: 12px 16px; border: 2px solid #e5e7eb;
            border-radius: 12px; font-size: 14px; outline: none; transition: 0.3s;
            background: #f9fafb;
        }

        .form-control:focus { border-color: #0d47d9; background: white; }

        textarea.form-control { resize: vertical; min-height: 100px; }

        select.form-control { cursor: pointer; }

        .file-upload {
            border: 2px dashed #d1d5db; border-radius: 12px; padding: 30px;
            text-align: center; cursor: pointer; transition: 0.3s; background: #f9fafb;
        }

        .file-upload:hover { border-color: #0d47d9; background: #eff6ff; }

        .file-upload i { font-size: 36px; color: #9ca3af; margin-bottom: 10px; }
        .file-upload p { color: #6b7280; font-size: 14px; }
        .file-upload .preview { max-width: 200px; max-height: 200px; margin-top: 15px; border-radius: 10px; display: none; }

        .btn-submit {
            background: #0d47d9; color: white; border: none; padding: 14px 32px;
            border-radius: 12px; cursor: pointer; font-size: 16px; font-weight: 600;
            display: inline-flex; align-items: center; gap: 8px; transition: 0.3s;
        }

        .btn-submit:hover { background: #0039cb; }

        .alert {
            padding: 14px 20px; border-radius: 12px; margin-bottom: 20px;
            font-size: 14px; display: flex; align-items: center; gap: 10px;
        }

        .alert-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

        @media (max-width: 768px) {
            .form-grid { grid-template-columns: 1fr; }
            .sidebar { width: 100%; height: auto; position: relative; }
            .main { margin-left: 0; padding: 20px; }
            body { flex-direction: column; }
            .form-container { padding: 25px; }
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
            <h2>Ajouter un Produit</h2>
            <a href="produits.php" class="btn-retour"><i class="fa-solid fa-arrow-left"></i> Retour à la liste</a>
        </div>

        <div class="form-container">

            <?php if ($success): ?>
                <div class="alert alert-success"><i class="fa-solid fa-check-circle"></i> <?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="alert alert-error"><i class="fa-solid fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nom du produit <span class="required">*</span></label>
                        <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Catégorie <span class="required">*</span></label>
                        <select name="categorie_id" class="form-control" required>
                            <option value="">Sélectionner...</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= (($_POST['categorie_id'] ?? 0) == $cat['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cat['nom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Prix (FCFA) <span class="required">*</span></label>
                        <input type="number" name="prix" class="form-control" step="0.01" min="0" value="<?= htmlspecialchars($_POST['prix'] ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" name="stock" class="form-control" min="0" value="<?= htmlspecialchars($_POST['stock'] ?? 0) ?>">
                    </div>

                    <div class="form-group">
                        <label>Marque</label>
                        <input type="text" name="marque" class="form-control" value="<?= htmlspecialchars($_POST['marque'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label>Garantie</label>
                        <input type="text" name="garantie" class="form-control" value="<?= htmlspecialchars($_POST['garantie'] ?? '') ?>" placeholder="ex: 12 mois">
                    </div>

                    <div class="form-group full">
                        <label>Description</label>
                        <textarea name="description" class="form-control"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                    </div>

                    <div class="form-group full">
                        <label>Image du produit</label>
                        <div class="file-upload" id="file-upload-area" onclick="document.getElementById('image-input').click()">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <p>Cliquez pour uploader une image</p>
                            <p style="font-size: 12px; color: #9ca3af;">JPG, PNG, WebP acceptés</p>
                            <input type="file" name="image" id="image-input" accept="image/jpeg,image/png,image/webp" style="display:none" onchange="previewImage(event)">
                            <img id="image-preview" class="preview" alt="Aperçu">
                        </div>
                    </div>
                </div>

                <div style="text-align: right; margin-top: 10px;">
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-save"></i> Enregistrer le produit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('image-preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    document.querySelector('.file-upload i').style.display = 'none';
                    document.querySelector('.file-upload p').textContent = file.name;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>

</body>
</html>
