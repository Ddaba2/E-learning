<?php
require 'bdd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['mot_de_passe'], $_POST['confirmer_mot_de_passe'], $_POST['token'])) {
        $mot_de_passe = trim($_POST['mot_de_passe']);
        $confirmer_mot_de_passe = trim($_POST['confirmer_mot_de_passe']);
        $token = trim($_POST['token']);

        if ($mot_de_passe === $confirmer_mot_de_passe) {
            try {
                // Vérifier si le token est valide
                $stmt = $pdo->prepare("SELECT id FROM user WHERE reset_token = :token AND reset_expiry > NOW()");
                $stmt->bindParam(':token', $token, PDO::PARAM_STR);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Hacher le mot de passe et mettre à jour
                    $mot_de_passe = md5($mot_de_passe);
                    $Stmt = $pdo->prepare("UPDATE user SET mot_de_passe = :mot_de_passe, reset_token = NULL, reset_expiry = NULL WHERE id = :id");
                    $Stmt->bindParam(':mot_de_passe', $mot_de_passe, PDO::PARAM_STR);
                    $Stmt->bindParam(':id', $user['id'], PDO::PARAM_INT);
                    $Stmt->execute();

                    echo "Mot de passe réinitialisé avec succès.";

                    // Redirection après succès
                    header('Location: Accueil.php');
                    exit();
                } else {
                    echo "Token invalide ou expiré.";
                }
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
        } else {
            echo "Les mots de passe ne correspondent pas.";
        }
    } else {
        echo "Tous les champs sont requis.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Réinitialisation de mot de passe</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Réinitialisation de mot de passe</h2>
        <form method="POST">
            <label for="mot_de_passe">Nouveau mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>

            <label for="confirmer_mot_de_passe">Confirmer mot de passe :</label>
            <input type="password" id="confirmer_mot_de_passe" name="confirmer_mot_de_passe" required><br><br>

            <!-- Champ caché pour le token -->
            <input type="hidden" name="token" value="<?php echo(htmlspecialchars($_GET['token'])); ?>">

            <button type="submit">Réinitialiser</button>
        </form>
    </div>
</body>
</html>
