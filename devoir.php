<?php
session_start();
require 'bdd.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: accueil.php');
    exit();
}

// Récupérer la classe, la filière et le rôle de l'utilisateur
$classe = $_SESSION['classe'];
$filiere = $_SESSION['filiere'];
$role = $_SESSION['role']; // Ajout de récupération du rôle

// Requête pour récupérer les devoir associés à la classe et à la filière de l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM devoir WHERE classe = :classe AND filiere = :filiere");
$stmt->bindParam(':classe', $classe);
$stmt->bindParam(':filiere', $filiere);
$stmt->execute();
$devoir = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devoirs</title>
    <link rel="stylesheet" href="styles2.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <h1>Devoirs</h1>

    <!-- Bouton Ajouter un devoir pour les professeurs -->
    <?php if ($role === 'prof'): ?>
        <button class="icon-button" onclick="window.location.href='add.php'">
    <i class="fas fa-plus"></i>
</button>
    <?php endif; ?>

    <?php if ($devoir): ?>
        <div class="grid-container">
            <?php foreach ($devoir as $devoir): ?>
            <div class="grid-card">
                <div class="card-content">
                    <h2><?php echo htmlspecialchars($devoir['titre']); ?></h2>
                    <p><?php echo htmlspecialchars($devoir['description']); ?></p>
                </div>
                <a class="download-link" href="download.php?id=<?php echo $devoir['id']; ?>">Télécharger le fichier</a>
            </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucun devoir disponible pour votre classe et filière.</p>
    <?php endif; ?>
</body>
</html>
