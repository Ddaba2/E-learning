<!DOCTYPE html>
<html>
<head>
<style>
    body {
        margin: 0;
        padding: 0;
    }

    /* Positionner les boutons en haut à droite */
    .buttons {
        position: absolute;
        top: 20px;
        right: 20px;
    }

    .buttons button {
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        margin: 5px 0;
    }

    .buttons button:hover {
        background-color: #218838;
    }

    /* Style pour le bouton de déconnexion en rouge */
    .logout-button {
        background-color: #FF0000 !important;
    }

    .logout-button:hover {
        background-color: #CC0000 !important;
    }

    /* Image de fond */
    img {
        width: 100%;
        height: 100vh; 
        object-fit: cover; 
    }

    /* Style pour le bouton "commentaire" en bas à gauche */
    .comment-button {
        position: fixed; /* Permet de fixer le bouton à la fenêtre */
        bottom: 10px; /* Distance du bas de la page */
        left: 10px; /* Distance du côté gauche */
        background-color: transparent;
        border: none;
        cursor: pointer;
        animation: idle-animation 3s infinite; /* Animation au repos */
    }

    .comment-button img {
        width: 40px; /* Ajuste la taille de l'image */
        height: auto; /* Maintient les proportions */
        transition: transform 0.3s ease-in-out; /* Animation lors du survol */
    }

    /* Effet de mouvement lors du survol */
    .comment-button:hover img {
        transform: rotate(15deg) scale(1.2); /* Rotation et agrandissement */
    }

    /* Animation au repos (petit saut répétitif) */
    @keyframes idle-animation {
        0%, 100% {
            transform: translateY(0); /* Position initiale */
        }
        50% {
            transform: translateY(-5px); /* Légère élévation */
        }
    }
</style>
</head>
<body>

<img src="14.jpg" alt="Image de bienvenue">

<div class="buttons">
    <button onclick="window.location.href='Profil.php'">Voir profil</button><br>
    <button onclick="window.location.href='cours.php'">Cours</button>
    <button onclick="window.location.href='devoir.php'">Devoirs</button><br>
    <button onclick="window.location.href='rdevoir.php'">Devoirs rendus</button>
    <button onclick="window.location.href='correction.php'">Corrections</button><br>

    <form action="deconnexion.php" method="post" style="display: inline;">
        <button type="submit" class="logout-button">Déconnexion</button>
    </form>
</div>

<!-- Bouton commentaire en bas à gauche -->
<button type="submit" onclick="window.location.href='commentaire.php'" name="commentaire" class="comment-button">
    <img id="logo" src="c.png" alt="Commentaire">
</button>

</body>
</html>