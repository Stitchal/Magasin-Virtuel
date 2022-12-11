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
        <nav>
            <ul class="menu">
                <?php if($GLOBALS["page"] == "articles.php") : ?> <!-- Si on est sur la page articles.php -->
                    <li><a href="articles.php"  class="articles" title="Cliquez ici pour voir les articles">Articles</a></li>
                <?php else : ?> <!-- On est pas sur la page article.php -->
                    <li><a href="articles.php"  title="Cliquez ici pour voir les articles">Articles</a></li>
                <?php endif ?>

                <?php if($GLOBALS["page"] == "panier.php") : ?> <!-- Si on est sur la page panier.php -->
                    <li><a href="panier.php" class="panier" title="Cliquez ici pour consulter votre panier"><img src="img/panier.png" alt="image panier" id="imgPanier"></a></li>
                <?php else : ?> <!-- Si on est pas sur la page panier.php -->
                    <li><a href="panier.php" title="Cliquez ici pour consulter votre panier"><img src="img/panier.png" alt="image panier" id="imgPanier"></a></li>
                <?php endif ?>

                <?php if(empty($_SESSION['nom']) || empty($_SESSION['prenom'])) :  ?> <!-- Si l'on n'est pas connecté -->
                    <?php if($GLOBALS["page"] == "connexion.php") : ?><!-- Si on est sur la page connexion-->
                        <li><a href="connexion.php" class="connexion" title="Cliquez ici pour vous connecter">Se connecter</a></li>
                    <?php else : ?><!-- Si on est pas sur la page connexion-->
                        <li><a href="connexion.php" title="Cliquez ici pour vous connecter">Se connecter</a></li>
                    <?php endif ?>

                <?php else : ?> <!-- Si on est connecté --> 

                    <?php if($GLOBALS["page"] == "deconnexion.php") : ?> <!-- Si on est sur la page déconnexion -->
                        <li><a href="connexion.php" title="Cliquez ici pour vous connecter">Se connecter</a></li>
                    <?php elseif($GLOBALS["page"] == "compte.php") : ?> <!-- Si on est sur la page compte-->
                        <li><a href="deconnexion.php" title="Cliquez ici pour vous déconnecter"><img src="img/deconnexion.png" alt="image deconnexion" id="imgDeconnexion"></a></li>
                        <li><a href="compte.php" class="compte" title="Cliquez ici pour accéder à votre compte"><img src="img/compte.png" alt="image compte" id="imgCompte"></a> </li>

                    <?php else : ?> <!-- Si on est pas sur la page déconnexion ou compte -->
                        <li><a href="deconnexion.php" title="Cliquez ici pour vous déconnecter"><img src="img/deconnexion.png" alt="image deconnexion" id="imgDeconnexion"></a></li>
                        <li> <a href="compte.php" title="Cliquez ici pour accéder à votre compte"><img src="img/compte.png" alt="image compte" id="imgCompte"></a> </li> 
                        

                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </nav>
</body>

</html>


