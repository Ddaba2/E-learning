<!DOCTYPE html>
<html>
<head>
    <title>Tableau des données</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Tableau des données</h2>

<table>
 <thead>
 <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Age</th>
        <th>Téléphone</th>
        <th>Nom d'utlisateur</th>
    </tr>
 </thead>

    <?php
    require 'bdd.php';

$sql = "SELECT nom, prenom, age, telephone, nom_utilisateur FROM compte1";
$result = $pdo->query($sql);
?>

    <?php
    if ($result->rowCount() > 0) {
        // Afficher les données de chaque ligne
        while($row = $result->fetch()) {
            echo "<tr>";
            echo "<td>" . $row["nom"] . "</td>";
            echo "<td>" . $row["prenom"] . "</td>";
            echo "<td>" . $row["age"] . "</td>";
            echo "<td>" . $row["telephone"] . "</td>";
            echo "<td>" . $row["nom_utilisateur"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'  style='text-align:center'>Aucune donnée disponible</td></tr>";
    }
    ?>

</table>
</body>
</html>