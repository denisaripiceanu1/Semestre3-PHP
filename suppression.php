<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suppression de Contact</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            background-color: #51555b;
            color: white;
            padding: 10px;
            text-align: center;
        }
        p {
            margin: 10px;
        }
        form {
            margin-top: 20px;
            font-size: 14px;
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
        input[type="submit"] {
            background-color:  #51555b;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
    // Votre configuration de connexion à la base de données
    $server = 'localhost';
    $login = 'root';
    $mdp = '';
    $db = 'TP3_carnet';

    try {
        // Établir la connexion à la base de données
        $linkpdo = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $login, $mdp);
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }

    if (isset($_GET['id'])) {
        // Récupérer l'identifiant du contact depuis l'URL
        $id = $_GET['id'];

        // Sélectionner les informations du contact correspondant dans la base de données
        $query = $linkpdo->prepare('SELECT * FROM carnet WHERE id_personne = :id');
        $query->execute(array('id' => $id));
        $contact = $query->fetch();

        if ($contact) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmation']) && ($_POST['confirmation'] === 'oui' || $_POST['confirmation'] === 'Oui')) {
                // Supprimer le contact de la base de données
                $deleteQuery = $linkpdo->prepare('DELETE FROM carnet WHERE id_personne = :id');
                $deleteQuery->execute(array('id' => $id));

                // Rediriger vers la page recherche.php
                header('Location: recherche.php');
                exit();
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmation']) && ($_POST['confirmation'] === 'non'|| $_POST['confirmation'] === 'Non')) {
                // Rediriger vers la page recherche.php sans supprimer le contact
                header('Location: recherche.php');
                exit();
            }

            // Afficher un message de confirmation
            echo '<h1>Confirmation de suppression</h1>';
            echo '<p>Êtes-vous sûr de vouloir supprimer le contact suivant ?</p>';
            echo '<p>Nom : ' . $contact['nom'] . '</p>';
            echo '<p>Prénom : ' . $contact['prénom'] . '</p>';
            echo '<form method="POST" action="suppression.php?id=' . $id . '">';
            echo '<label for="confirmation">Confirmez la suppression (oui/non) :</label>';
            echo '<input type="text" name="confirmation" id="confirmation" required>';
            echo '<input type="submit" value="Valider">';
            echo '</form>';
        } else {
            echo '<h1>Contact introuvable</h1>';
            echo '<p>Le contact spécifié n\'existe pas.</p>';
        }
    } else {
        echo '<h1>Identifiant non spécifié</h1>';
        echo '<p>Aucun identifiant de contact spécifié.</p>';
    }
    ?>
</body>
</html>
