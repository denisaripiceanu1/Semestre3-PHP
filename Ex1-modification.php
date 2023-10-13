<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recherche de Contacts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        h1 {
            background-color: #51555b;
            color: white;
            padding: 10px;
            text-align: center;
        }
        h2 {
            background-color: #51555b;
            color: white;
            padding: 10px;
            margin-top: 20px;
        }
        p {
            font-size: 16px;
        }
        ul {
            list-style-type: disc;
            margin-left: 20px;
        }
        form {
            margin-top: 20px;
            font-size: 14px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
        }
        input[type="reset"], input[type="submit"] {
            background-color:  #51555b;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="reset"]:hover, input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .solution {
            text-decoration: underline;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #51555b;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Recherche de Contacts</h1>

    <form method="POST" action="Ex1-recherche.php">
        <label for="mots_cles">Mots-clés :</label>
        <input type="text" name="mots_cles" id="mots_cles">
        <input type="submit" value="Rechercher">
    </form>

    <?php
    $server = 'localhost';
    $login = 'root';
    $mdp = '';
    $db = 'TP3_carnet';

    try {
        $linkpdo = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $login, $mdp);
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }

    // Traitement du formulaire
    if(isset($_POST['mots_cles'])) {
        $mots_cles = $_POST['mots_cles'];
        $query = $linkpdo->prepare('SELECT * FROM carnet WHERE nom LIKE :mots_cles OR prénom LIKE :mots_cles');
        $query->execute(array('mots_cles' => "%$mots_cles%"));

        if($query->rowCount() > 0) {
            echo '<h2>Résultats de la recherche :</h2>';
            echo '<table>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Adresse</th>
                        <th>Code Postal</th>
                        <th>Ville</th>
                        <th>Téléphone</th>
                        <th>Actions</th>
                    </tr>';

            while($row = $query->fetch()) {
                echo '<tr>
                        <td>'.$row['nom'].'</td>
                        <td>'.$row['prénom'].'</td>
                        <td>'.$row['adresse'].'</td>
                        <td>'.$row['code_postal'].'</td>
                        <td>'.$row['ville'].'</td>
                        <td>'.$row['téléphone'].'</td>
                        <td>
                            <a href="Ex1-modification.php?id='.$row['id_personne'].'">Modifier</a>
                            <p>ou</p>
                            <a href="Ex1-suppression.php?id='.$row['id_personne'].'">Supprimer</a>
                        </td>
                      </tr>';
            }

            echo '</table>';
        } else {
            echo 'Aucun résultat trouvé.';
        }
    }
    // Ajout du lien de retour à la saisie
    echo '<p><a href="Ex1-GestionAdresses.html">Vous voulez ajouter un nouveau contact?</a></p>';
    ?>
</body>
</html>
