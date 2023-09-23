<?php
$nb1 = 0;
$nb2 = 0;
$resultat = '';

if (isset($_POST['operation'])) {
    $nb1 = $_POST['nb1'];
    $nb2 = $_POST['nb2'];

    switch ($_POST['operation']) {
        case 'Additioner':
            $resultat = $nb1 + $nb2;
            break;
        case 'Soustraire':
            $resultat = $nb1 - $nb2;
            break;
        case 'Multiplier':
            $resultat = $nb1 * $nb2;
            break;
        case 'Diviser':
            if ($nb2 != 0) {
                $resultat = $nb1 / $nb2;
            } else {
                $resultat = 'Division par 0 impossible';
            }
            break;
        default:
            $resultat = 'Opération non supportée';
            break;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>La calculatrice</title>
</head>
<body>
<h1>Exercice : la calculatrice</h1>

<p>Créer une calculatrice en ligne proposant les opérations d’addition, de soustraction, de division et de puissance. Les contraintes sont les suivantes : </p>
<ul>
    <li>La calculatrice n’est constituée que d’un seul formulaire.</li>
    <li>A chaque opération est associé un bouton submit.</li>
    <li>Les zones de saisie de texte permettant de rentrer les deux opérandes doivent rester visibles (ainsi que les valeurs associées) lors de l’affichage du résultat.</li>
</ul>

<form action="Ex2-calculatrice.php" method="post">
    <b>Calculatrice en ligne</b> <br />
    <b>Nombre 1</b> <input type="text" name="nb1" value="<?php echo $nb1; ?>" required><br />
    <b>Nombre 2</b> <input type="text" name="nb2" value="<?php echo $nb2; ?>" required><br />
    <b>Résultat</b> <input type="text" name="resultat" value="<?php echo $resultat; ?>" readonly><br />
    <b>Opérateurs</b>
    <input type="submit" name="operation" value="Additioner">
    <input type="submit" name="operation" value="Soustraire">
    <input type="submit" name="operation" value="Multiplier">
    <input type="submit" name="operation" value="Diviser">
</form>
</body>
</html>
