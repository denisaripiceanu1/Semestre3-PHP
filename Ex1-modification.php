<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modification de Contact</title>
    <link rel="stylesheet" type="text/css" href="Ex1-styles.css">
</head>
<body>
    <h1>Modification de Contact</h1>

    <?php
    // Configuration de connexion à la base de données
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

    $message = ''; // Initialiser le message

    if (isset($_GET['id'])) {
        // Récupérer l'identifiant du contact depuis l'URL
        $id = $_GET['id'];

        // Sélectionner les informations du contact correspondant dans la base de données
        $query = $linkpdo->prepare('SELECT * FROM carnet WHERE id_personne = :id');
        $query->execute(array('id' => $id));
        $contact = $query->fetch();

        if ($contact) {
            // Traitement du formulaire de modification lorsqu'il est soumis
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $newNom = $_POST['nom'];
                $newPrenom = $_POST['prenom'];
                $newAdresse = $_POST['adresse'];
                $newCP = $_POST['cp'];
                $newVille = $_POST['ville'];
                $newTel = $_POST['tel'];

                // Utilisation de l'instruction SQL UPDATE pour mettre à jour le contact
                $updateQuery = $linkpdo->prepare('UPDATE carnet SET nom = ?, prénom = ?, adresse = ?, code_postal = ?, ville = ?, téléphone = ? WHERE id_personne = ?');
                $updateQuery->execute([$newNom, $newPrenom, $newAdresse, $newCP, $newVille, $newTel, $id]);

                // Réexécutez la requête pour obtenir les informations mises à jour
                $query->execute(array('id' => $id));
                $contact = $query->fetch();

                $message = 'Le contact a été mis à jour avec succès.';
            }

            // Afficher le formulaire de modification avec les données mises à jour
            echo '<form method="POST" action="Ex1-modification.php?id=' . $id . '">
                    <input type="hidden" name="id" value="' . $id . '">
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom" value="' . $contact['nom'] . '">
                    <label for="prenom">Prénom :</label>
                    <input type="text" name="prenom" id="prenom" value="' . $contact['prénom'] . '">
                    <label for="adresse">Adresse :</label>
                    <input type="text" name="adresse" id="adresse" value="' . $contact['adresse'] . '">
                    <label for="cp">Code Postal :</label>
                    <input type="text" name="cp" id="cp" value="' . $contact['code_postal'] . '">
                    <label for="ville">Ville :</label>
                    <input type="text" name="ville" id="ville" value="' . $contact['ville'] . '">
                    <label for="tel">Téléphone :</label>
                    <input type="text" name="tel" id="tel" value="' . $contact['téléphone'] . '">
                    <input type="submit" value="Modifier">
                </form>';
        } else {
            echo '<p>Le contact spécifié n\'existe pas.</p>';
        }
    } else {
        echo '<p>Aucun identifiant de contact spécifié.</p>';
    }

    // Afficher le message de succès ici
    echo '<p>' . $message . '</p>';
    // Ajout du lien de retour à la saisie
    echo '<p><a href="Ex1-GestionAdresses.html">Vous voulez ajouter un nouveau contact?</a></p>';
    ?>
</body>
</html>
