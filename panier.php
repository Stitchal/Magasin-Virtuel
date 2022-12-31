<?php
    session_start();

    if(empty($_POST['nom'])){
        header('Location: connexion.php');
        exit;
    }

    $GLOBALS["page"] = "panier.php";
    require_once('index.php');


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
    
        <h1>Panier</h1>
    </main>
    <a href="#"title="Cliquez ici pour retourner en haut de la page">
        <div id="haut_page"><img src="img/flecheHaut.png" alt="image fleche haut"></a></div>
    </a>
</body>
</html>