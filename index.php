<?php

    //if (!isset($_SESSION['nom']) && !isset($_SESSION['prenom'])) {
      //  $_SESSION['nom'] = '';
        //$_SESSION['prenom'] = '';
        //$_SESSION['nb'] = 0;
    //}
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
        <nav>
            <ul class="menu">
                <li><a href="articles.php" title="Cliquez ici pour voir les articles">Articles</a></li>
                <!--<li><a href="open_session.php" action="open_session.php">Créer un compte</a></li>-->
                <li><a href="panier.php" title="Cliquez ici pour consulter votre panier">Panier</a></li>
                <?php if(empty($_SESSION['nom']) || empty($_SESSION['prenom'])) :  ?>
                <p> session : <?php $_SESSION['nom'] ?> </p>
                <li><a href="connexion.php" class="connexion" title="Cliquez ici pour vous connecter">Se connecter</a></li>
                <?php else : ?>
                <li><a href="connexion.php" class="connexion" title="Cliquez ici pour vous connecter">Se déconnecter</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </main>
</body>
</html>