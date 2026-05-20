<?php
session_start();

// Simuler un utilisateur connecté
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = "user1";
}

$user = $_SESSION['user'];
$profileImage = "uploads/" . $user . ".png";

// Vérifier si image existe
if (!file_exists($profileImage)) {
    $profileImage = "uploads/default.png";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
            text-align: center;
        }

        .container {
            margin-top: 50px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            display: inline-block;
        }

        img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #007bff;
        }

        input {
            margin-top: 15px;
        }

        button {
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Mon Profil</h2>

    <img src="<?php echo $profileImage; ?>" alt="Photo de profil">

    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="profile" required><br><br>
        <button type="submit">Changer la photo</button>
    </form>

    <h3><?php echo $user; ?></h3>
</div>

</body>
</html>