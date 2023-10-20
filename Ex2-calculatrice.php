<?php
 #2. la calculatrice
 $nb1 = 0;
 $nb2 = 0;
 $resultat = 0;

 if(isset($_POST['operation'])){
     //Récupération des paramètres du formulaire
      $nb1 = $_POST['nb1'];
      $nb2 = $_POST['nb2'];

      switch($_POST['operation']){
         case 'Additionner':
             $resultat = $nb1 + $nb2;
             break;
         case 'Soustraire':
             $resultat = $nb1 - $nb2;
             break;
         case 'Diviser':
             if($nb2 != 0){
                 $resultat = $nb1 / $nb2;
             } else {
                 $resultat = "Division par zéro impossible.";
             }
             break;
         case 'Multiplier':
             $resultat = $nb1 * $nb2;
             break;
         default:
             $resultat = "Opération non supportée.";
             break;
         }
 }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Calculatrice en ligne</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        h1 {
            background-color: #51555b;
            color: white;
            padding: 20px;
        }
        p {
            font-size: 18px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        form {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            width: 300px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
        }
        .btn-container input[type="submit"] {
            flex: 1;
            margin: 5px;
            background-color: #51555b;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Calculatrice en ligne</h1>
    <form action="traitementEx2.php" method="post">
        <ul>
            <li>
                <label for="nb1">Nombre 1</label>
                <input type="text" name="nb1" value="<?php echo $nb1; ?>" required>
            </li>
            <li>
                <label for="nb2">Nombre 2</label>
                <input type="text" name="nb2" value="<?php echo $nb2; ?>" required>
            </li>
            <li>
                <label for="resultat">Résultat</label>
                <input type="text" name="resultat" value="<?php echo $resultat; ?>" readonly>
            </li>
            <li class="btn-container">
                <input type="submit" name="operation" value="Additionner">
                <input type="submit" name="operation" value="Soustraire">
            </li>
            <li class="btn-container">
                <input type="submit" name="operation" value="Multiplier">
                <input type="submit" name="operation" value="Diviser">
            </li>
        </ul>
    </form>
</body>
</html>
