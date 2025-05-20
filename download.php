<?php
session_start();
require 'bdd.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: accueil.php');
    exit();
}

// Vérifiez si un ID de cours est passé dans l'URL
if (!isset($_GET['id'])) {
    die("Aucun fichier sélectionné pour le téléchargement.");
}

$courseId = $_GET['id'];

// Requête pour récupérer le fichier basé sur l'ID du cours
$stmt = $pdo->prepare("SELECT fichier, titre FROM cours WHERE id = :id");
$stmt->bindParam(':id', $courseId);
$stmt->execute();
$course = $stmt->fetch(PDO::FETCH_ASSOC);

if ($course) {
    // Paramètres pour le téléchargement du fichier
    $fileContent = $course['fichier'];
    $fileName = $course['titre'] . ".pdf"; // Remplacez par l'extension réelle si nécessaire
    
    // En-têtes pour forcer le téléchargement
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . strlen($fileContent));

    // Envoyez le fichier
    echo $fileContent;
    exit();
} else {
    echo "Fichier introuvable.";
}
?>
