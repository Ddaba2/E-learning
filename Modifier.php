<!DOCTYPE html>
<html>
<head>
    <title>Afficher les données de la base de données</title>
    <link rel="stylesheet" href="Profil.css">
</head>
<body>

<?php

session_start();
require 'bdd.php';

if (!isset($_SESSION['id'])) {
   
    header('location:Accueil.php');
}
$user_id = $_SESSION['id'];
        $sql = "SELECT nom, prenom, role, email, telephone, classe, filiere, mot_de_passe FROM user WHERE id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $result = $stmt->fetch();

// Supposons que l'ID de l'utilisateur connecté soit stocké dans une variable de session

if ($result) {
    echo "<form action='update.php' method='post'>";
        echo "Nom: <input type='text' name='nom' value='" . $result["nom"] . "'><br>";
        echo "Prénom: <input type='text' name='prenom' value='" . $result["prenom"] . "'><br>";
        echo "Rôle: <input type='text' name='role' value='" . $result["role"] . "'><br>";
        echo "Email: <input type='text' name='email' value='" . $result["email"] . "'><br>";
        echo "Téléphone: <input type='text' name='telephone' value='" . $result["telephone"] . "'><br>";
        echo "Classe: <input type='text' name='classe' value='" . $result["classe"] . "'><br>";
        echo "Filière: <input type='text' name='filiere' value='" . $result["filiere"] . "'><br>";
        echo "Mot de passe: <input type='text' name='mot_de_passe' value='" . $result["mot_de_passe"] . "'><br>";
        echo "<input type='submit' value='Mettre à jour'>";
        echo "</form><br>";
} else {
    echo "<tr><td colspan='9' style='text-align:center'>Utilisateur non trouvé</td></tr>";
}



?>

</body>
</html>
