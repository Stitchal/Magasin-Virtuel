<?php
    if(isset($_GLOBALS['page'])) {
        $page = $_GLOBALS['page'];
    } else {
        //$page = 'nav.php';
    }
    $isMediaQueries = 0;
    require_once(__DIR__.'/../libs/database-functions.php');
?>

<!DOCTYPE html>
<html LANG="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
</head>
<body>  
        <nav>
            <input type="checkbox" id="bouton" />
            <label id = "labelMenu" for="bouton">
                <img src="../img/icone-menu.png" alt="Ouvrir le menu" id="boutonMenu" title="Menu" />
            </label>
            <ul class="menu">
                <?php if(empty($_SESSION['nom']) || empty($_SESSION['prenom'])) :  ?> <!-- Si l'on n'est pas connecté -->
                    <?php if($GLOBALS["page"] == "client-article.php") : ?> <!-- Si on est sur la page articles.php -->
                        <li><a href="../client/client-article.php" class="articles" title="Cliquez ici pour voir les articles">Articles</a></li>
                        <li><a href="../client/client-panier.php" title="Cliquez ici pour consulter votre panier"><img src="../img/panier.png" alt="image panier" id="imgPanier"></a></li>
                        <li><a href="../others/connexion.php" title="Cliquez ici pour vous connecter">Se connecter</a></li>
                    <?php else : ?> <!-- On est pas sur la page article.php -->
                        <li><a href="../client/client-article.php" title="Cliquez ici pour voir les articles">Articles</a></li>
                        <?php if($GLOBALS["page"] == "connexion.php") : ?><!-- Si on est sur la page connexion-->
                            <li><a href="../client/client-panier.php" title="Cliquez ici pour consulter votre panier"><img src="../img/panier.png" alt="image panier" id="imgPanier"></a></li>
                            <li><a href="../others/connexion.php" class="connexion" title="Cliquez ici pour vous connecter">Se connecter</a></li>
                        <?php else : ?><!-- Si on est pas sur la page connexion-->
                            <?php if($GLOBALS["page"] == "client-panier.php") : ?> <!-- Si on est sur la page panier.php -->
                                <li><a href="../client/client-panier.php" class="panier" title="Cliquez ici pour consulter votre panier"><img src="../img/panier.png" alt="image panier" id="imgPanier"></a></li>
                                <li><a href="../others/connexion.php" title="Cliquez ici pour vous connecter">Se connecter</a></li>
                            <?php else : ?>
                                <li><a href="../client/client-panier.php" title="Cliquez ici pour consulter votre panier"><img src="../img/panier.png" alt="image panier" id="imgPanier"></a></li>
                                <li><a href="../others/connexion.php" title="Cliquez ici pour vous connecter">Se connecter</a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                <?php else : ?> <!-- Si on est connecté --> 
                    <?php if(checkAdmin($_SESSION['nom'], $_SESSION['prenom'], $_SESSION['email'])): ?><!-- Si on est admin-->
                        <li><a href="../admin/index-admin.php" title="Cliquez pour voir les articles">Accueil</a></li>
                        <?php if($GLOBALS["page"] == "deconnexion.php") : ?> <!-- Si on est sur la page déconnexion -->
                            <li><a href="../others/connexion.php" title="Cliquez ici pour vous connecter">Se connecter</a></li>
                        <?php elseif($GLOBALS["page"] == "compte.php") : ?> <!-- Si on est sur la page compte-->
                            <li><a href="../others/deconnexion.php" title="Cliquez ici pour vous déconnecter"><img src="../img/icone-deconnexion.png" alt="image deconnexion" id="imgDeconnexion"></a></li>
                            <li> <a href="../others/compte.php" title="Cliquez ici pour accéder à votre compte" class="compte"><img src="../img/icone-compte.png" alt="image compte" id="imgCompte"></a> </li>
                        <?php else : ?> <!-- Si on est pas sur la page déconnexion ou compte -->
                            <li><a href="../others/deconnexion.php" title="Cliquez ici pour vous déconnecter"><img src="../img/icone-deconnexion.png" alt="image deconnexion" id="imgDeconnexion"></a></li>
                            <li><a href="../others/compte.php" title="Cliquez ici pour accéder à votre compte"><img src="../img/icone-compte.png" alt="image compte" id="imgCompte"></a> </li>
                        <?php endif; ?>
                    <?php else : ?> <!-- Si on est pas admin-->
                        <?php if($GLOBALS["page"] == "client-article.php") : ?> <!-- Si on est sur la page articles.php -->
                            <li><a href="../client/client-article.php" class="articles" title="Cliquez ici pour voir les articles">Articles</a></li>
                            <li><a href="../others/deconnexion.php" title="Cliquez ici pour vous déconnecter"><img src="../img/icone-deconnexion.png" alt="image deconnexion" id="imgDeconnexion"></a></li>
                            <li><a href="../client/client-panier.php" title="Cliquez ici pour consulter votre panier"><img src="../img/panier.png" alt="image panier" id="imgPanier"></a></li>
                            <li><a href="../others/compte.php" title="Cliquez ici pour accéder à votre compte"><img src="../img/icone-compte.png" alt="image compte" id="imgCompte"></a> </li>
                        <?php else : ?> <!-- On est pas sur la page article.php -->
                            <li><a href="../client/client-article.php" title="Cliquez ici pour voir les articles">Articles</a></li>
                            <?php if($GLOBALS["page"] == "deconnexion.php") : ?> <!-- Si on est sur la page déconnexion -->
                                <li><a href="../others/connexion.php" title="Cliquez ici pour vous connecter">Se connecter</a></li>
                            <?php elseif($GLOBALS["page"] == "compte.php") : ?> <!-- Si on est sur la page compte-->
                                <li><a href="../others/deconnexion.php" title="Cliquez ici pour vous déconnecter"><img src="../img/icone-deconnexion.png" alt="image deconnexion" id="imgDeconnexion"></a></li>
                                <li><a href="../client/client-panier.php" title="Cliquez ici pour consulter votre panier"><img src="../img/panier.png" alt="image panier" id="imgPanier"></a></li>
                                <li><a href="../others/compte.php" title="Cliquez ici pour accéder à votre compte" class="compte"><img src="../img/icone-compte.png" alt="image compte" id="imgCompte"></a> </li>
                            <?php else : ?> <!-- Si on est pas sur la page déconnexion ou compte -->
                                <?php if($GLOBALS["page"] == "client-panier.php") : ?> <!-- Si on est sur la page panier -->
                                    <li><a href="../deconnexion.php" title="Cliquez ici pour vous déconnecter"><img src="../img/icone-deconnexion.png" alt="image deconnexion" id="imgDeconnexion"></a></li>
                                    <li><a href="../client/client-panier.php" class="panier" title="Cliquez ici pour consulter votre panier"><img src="../img/panier.png" alt="image panier" id="imgPanier"></a></li>
                                    <li><a href="../others/compte.php" title="Cliquez ici pour accéder à votre compte" ><img src="../img/icone-compte.png" alt="image compte" id="imgCompte"></a> </li>
                                <?php else : ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </nav>
</body>


<script>
  // Fonction pour afficher/masquer le sous-menu
  function showMenu() {
    var menu = document.getElementById("sousMenu");
    if (menu.className === "sousMenu") {
      menu.className += " show";
    } else {
      menu.className = "sousMenu";
    }

    var image = document.getElementById("imgFleche");
    if (image.src.match("flecheHaute")) {
      image.src = "img/flecheBasse.png";
    } else {
      image.src = "img/flecheHaute.png";
    }
  }

  function showDiv() {
    document.getElementById("myDiv").style.display = "block";
  }

  function isMediaQueries(){
    if (!(window.matchMedia("(max-width: 1200px)").matches)) {
        <?php
        $isMediaQueries = 1;
        ?>
    }
    else {
        <?php
        $isMediaQueries = 0;
        ?>
    }
  }
</script>

</html>