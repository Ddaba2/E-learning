<?php
require 'bdd.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recuperer'])) {
    $email = $_POST['email'];

    // Vérifiez si l'email existe dans la base de données
    $stmt = $pdo->prepare("SELECT id FROM user WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user) {
        // Génération d'un token unique
        $token = mt_rand(1000, 9999);
        $stmt = $pdo->prepare("UPDATE user SET reset_token = :token, reset_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = :email");
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Envoi de l'email de récupération
        
      
        $subject = "Réinitialisation de votre mot de passe";
        $message = "Voici votr code de rénitialisation : $token";
        $headers = "From: no-reply@votre-site.com";
        include 'email.php';
        email($subject,$message,$email);
        header('location:vmd.php');

        // if (email($email, $subject, $message, $headers)) {
        //     echo "Un email de récupération a été envoyé.";
        // } else {
        //     echo "Erreur lors de l'envoi de l'email.";
        // }
    } else {
        echo "Adresse e-mail introuvable.";
    }
}
?>