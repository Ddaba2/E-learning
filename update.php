<?php
session_start();
require 'bdd.php';

// Récupérer les données du formulaire
if (!isset($_SESSION['id'])){
    header('location:Accueil.php');
}
    
    $id=$_SESSION['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $role = $_POST['role'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $filiere = $_POST['filiere'];
    $classe = $_POST['classe'];
    $mot_de_passe = $_POST['mot_de_passe'];
    
    // Mettre à jour les données avec une requête préparée
    $sql = "UPDATE user SET nom = :nom, prenom = :prenom, role = :role, telephone = :telephone, email = :email, classe = :classe, filiere = :filiere, mot_de_passe = :mot_de_passe WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    // Lier les paramètres
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':role', $ro, $telephone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':classe', $classe);
    $stmt->bindParam(':filiere', $filiere);
    $stmt->bindParam(':mot_de_passe', $mot_de_passe);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "Mise à jour effectuée !!";
    } else {
        echo "Erreur de mise à jour: " . implode(":", $stmt->errorInfo());
    }

?>
