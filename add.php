<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un contenu</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <h1>Ajouter un contenu</h1>
    <form method="POST" action='traitement.php' enctype="multipart/form-data">

    <label for="type">Type :</label>
        <select id="type" name="type">
            <option value="cours">Cours</option>
            <option value="devoir">Devoirs</option>
            <option value="rdevoir">Devoirs rendus</option>
            <option value="correction">Corrections</option>
        </select><br><br>

        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" required><br>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required></textarea><br>

        <label for="classe">Classe :</label>
        <textarea id="classe" name="classe" required></textarea><br>

        <label for="filiere">Filière :</label>
        <textarea id="filiere" name="filiere" required></textarea><br>

        <label for="fichier">Ajouter un fichier (Vidéo, PDF ou Image) :</label>
        <input type="file" id="fichier" name="fichier" accept=".pdf,.mp4,.jpg,.jpeg,.png" required><br>

        <button type="submit" name='ajouter' value='ajouter'>Ajouter</button>
    </form>
</body>
</html>
