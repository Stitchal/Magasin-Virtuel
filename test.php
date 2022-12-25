<?php
  session_start();
  //$_SESSION['b'] = 0;

?>

<!DOCTYPE html>
<html LANG="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <title>Magasin Virtuel</title>
</head>
<body>
    <main>
      
        <script> let valeur = 0; </script>
        <p id="valeur">Valeur : <span id="chiffre">0</span></p>
        <button onclick="modifierValeur()">Modifier</button>

<script>
  function modifierValeur() {
    // Incrémentation de la valeur de la variable
    //$_SESSION['b'] += 1;
    valeur += 1;
    // Mise à jour de la valeur dans le document
    document.getElementById('chiffre').innerHTML = valeur;
  }
</script>

        </main>
</body>
</html>