<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajout de Contact</title>
    <link rel="stylesheet" type="text/css" href="Ex1-styles.css">
</head>
<body>
    <h1>Ajout de Contact</h1>
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

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    // Vérifier si le contact existe déjà
    $checkQuery = $linkpdo->prepare('SELECT COUNT(*) AS count FROM carnet WHERE nom = :nom AND prénom = :prenom');
    $checkQuery->execute(array('nom' => $nom, 'prenom' => $prenom));
    $result = $checkQuery->fetchColumn();

    if ($result != 0) {
        echo "<p>Le contact existe déjà dans le carnet.</p>";
    } else {
        // Le contact n'existe pas, ajoutons-le
        $insertQuery = $linkpdo->prepare('INSERT INTO carnet(nom, prénom, adresse, code_postal, ville, téléphone) 
                                            VALUES(:nom, :prenom, :adresse, :code_postal, :ville, :telephone)');
        $insertResult = $insertQuery->execute(array(
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'adresse' => $_POST['adresse'],
            'code_postal' => $_POST['cp'],
            'ville' => $_POST['ville'],
            'telephone' => $_POST['tel']
        ));

        if ($insertResult) {
            echo "<p>Le contact a été ajouté avec succès.</p>";
        } else {
            echo "<p>Erreur lors de l'ajout du contact.</p>";
        }
    }
    ?>
    <p><a href="Ex1-GestionAdresses.html">Vous voulez ajouter un nouveau contact?</a></p>
</body>
</html>
