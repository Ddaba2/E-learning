<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte </title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        
        <h2>Créer un compte</h2>
        <img src="s.jpeg" alt="Image" width="190" height="150">
        <form methode="POST" action='traitement.php'>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required><br><br>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required><br><br>

            <label for="role">Choisissez votre rôle :</label>
        <select id="role" name="role">
            <option value="etudiant">Etudiant</option>
            <option value="prof">Prof</option>
        </select><br><br>

            <label for="age">Classe :</label>
            <input type="text" id="classe" name="classe" required><br><br>

            <label for="age">Filière :</label>
            <input type="text" id="filiere" name="filiere" required><br><br>

            <label for="age">Age :</label>
            <input type="text" id="age" name="age" required><br><br>

            <label for="age">Email :</label>
            <input type="text" id="email" name="email" required><br><br>


            <label for="telephone">Téléphone :</label>
            <input type="text" id="telephone" name="telephone" required><br><br>

            <label for="nom_utilisateur">Nom d'utilisateur :</label>
            <input type="text" id="nom_utilisateur" name="nom_utilisateur" required><br><br>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required><br><br>

            <label for="password">Confirmer mot de passe :</label>
            <input type="password" id="password" name="password" required><br><br>

            <button type="submit" name='create_count'>Créer</button>
        </form>
        <div class="buttons">
             
            <button onclick="window.location.href='Accueil.php'">Annuler</button>
            
        </div>
    </div>
</body>
</html>