<?php
require 'bdd.php';

session_start();

if (isset( $_GET['create_count'])) {
  
$nom = $_GET['nom'];
$prenom = $_GET['prenom'];
$role = $_GET['role'];
$classe = $_GET['classe'];
$filiere = $_GET['filiere'];
$age = $_GET['age'];
$email = $_GET['email'];
$telephone = $_GET['telephone'];
$nom_utilisateur = $_GET['nom_utilisateur'];
$password = $_GET['password'];      
$confirmer_mot_de_passe = isset($_POST['confirmer_mot_de_passe']) ? $_POST['confirmer_mot_de_passe'] : '';

// Hash le mot de passe avant de l'utiliser dans la requête
$mot_de_passe = md5($password);
$sql = "INSERT INTO user (nom, prenom, role, classe, filiere, age, email, telephone, nom_utilisateur, mot_de_passe, confirmer_mot_de_passe) VALUES (:nom, :prenom, :role, :classe, :filiere, :age, :email, :telephone, :nom_utilisateur, :mot_de_passe, :confirmer_mot_de_passe)";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':nom', $nom);
$stmt->bindParam(':prenom', $prenom);
$stmt->bindParam(':role', $role);
$stmt->bindParam(':classe', $classe);
$stmt->bindParam(':filiere', $filiere);
$stmt->bindParam(':age', $age);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':telephone', $telephone);
$stmt->bindParam(':nom_utilisateur', $nom_utilisateur);
$stmt->bindParam(':mot_de_passe', $mot_de_passe);
$stmt->bindParam(':confirmer_mot_de_passe', $confirmer_mot_de_passe);

$stmt->execute();

include 'email.php';
email(null,null,$email);
header('location:Bienvenue.php');
}
if (isset( $_GET['connexion'])) {
    
  
    $nom_utilisateur = $_GET['nom_utilisateur'];
   
    $password = $_GET['password'];
   
    $mot_de_passe = md5($password);

// Connexion à la base de données
$stmt = $pdo->prepare("SELECT * FROM user WHERE nom_utilisateur = '$nom_utilisateur' AND Mot_de_passe = '$mot_de_passe' " );

    $stmt->execute();
    $resultats = $stmt->fetch(PDO::FETCH_ASSOC); 
    $count= $stmt->rowCount();

    if($count==0){
echo "Compte inexitant";
header('location:erreur.php');

    }else{

        $_SESSION['id']=$resultats['id'];
        $_SESSION['nom']=$resultats['nom'];
        $_SESSION['prenom']=$resultats['prenom'];
        $_SESSION['nom_utilisateur']=$resultats['nom_utilisateur'];
        $_SESSION['role']=$resultats['role'];
        $_SESSION['email']=$resultats['email'];
        $_SESSION['telephone']=$resultats['telephone'];
        $_SESSION['classe']=$resultats['classe'];
        $_SESSION['filiere']=$resultats['filiere'];

        echo "Bienvenue sur la page!!";
        header('location:Bienvenue.php');
    }
    
}

if (isset( $_GET['create_count'])) {
    
    $role = $_GET['role'];
    $nom_utilisateur = $_GET['nom_utilisateur'];
    $classe = $_GET['classe'];
    $filiere = $_GET['filiere'];
    $password = $_GET['password'];

// Connexion à la base de données
$stmt = $pdo->prepare("SELECT * FROM user WHERE AND nom_utilisateur = '$nom_utilisateur' AND Mot_de_passe = '$mot_de_passe' " ); 

$stmt->execute([$nom_utilisateur, $password]);

$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC); 
}

// Ajouter un contenu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
    // Récupérer les données depuis le formulaire
    $type = $_POST['type']; // Type de contenu sélectionné
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $classe = $_POST['classe'];
    $filiere = $_POST['filiere'];
    $file = $_FILES['fichier'];

    if (is_uploaded_file($file['tmp_name'])) {
        $fileContent = file_get_contents($file['tmp_name']);

        // Préparation de la requête SQL selon le type sélectionné
        if ($type === 'cours') {
            $sql = "INSERT INTO cours (titre, description, classe, filiere, fichier) 
                    VALUES (:titre, :description, :classe, :filiere, :fichier)";
        } elseif ($type === 'devoir') {
            $sql = "INSERT INTO devoir (titre, description, classe, filiere, fichier) 
                    VALUES (:titre, :description, :classe, :filiere, :fichier)";
        } elseif ($type === 'rdevoir') {
                        $sql = "INSERT INTO rdevoir (titre, description, classe, filiere, fichier) 
                                VALUES (:titre, :description, :classe, :filiere, :fichier)";
        } elseif ($type === 'correction') {
            $sql = "INSERT INTO correct (titre, description, classe, filiere, fichier) 
                    VALUES (:titre, :description, :classe, :filiere, :fichier)";
        } else {
            echo "Type de contenu invalide.";
            exit;
        }

        // Exécution de la requête préparée
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':classe', $classe);
        $stmt->bindParam(':filiere', $filiere);
        $stmt->bindParam(':fichier', $fileContent, PDO::PARAM_LOB);

        if ($stmt->execute()) {
            echo ucfirst($type) . " ajouté avec succès.";
        } else {
            echo "Erreur lors de l'ajout du " . $type . ".";
        }
    } else {
        echo "Erreur lors du téléchargement du fichier.";
    }
}
?>