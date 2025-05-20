<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue </title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Page d'accueil</h2>
        <img src="ca.png" alt="Image">
        <form methode="POST" action='traitement.php'>
            

            <label for="nom">Nom d'utilisateur :</label>
            <input type="text" id="nom_utilisateur" name="nom_utilisateur" required><br><br>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required><br><br>

            <button type="submit" name='connexion' value='create_count'>Se connecter</button>
        </form>

        <div class="buttons">
    <p>Mot de passe oublié ? 
        <a href="recuperation.php">Cliquez ici pour récupérer</a>
    </p>
</div>
       
        <div class="buttons">
        Vous avez déjà un compte?  
        <button onclick="window.location.href='Création de compte.php'">Créer un compte</button>
        
    </div>
        </div>  

    
</body>
</html>
