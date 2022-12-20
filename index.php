<?php
    //if (!isset($_SESSION['nom']) && !isset($_SESSION['prenom'])) {
      //  $_SESSION['nom'] = '';
        //$_SESSION['prenom'] = '';
        //$_SESSION['nb'] = 0;
    //}

    if(isset($_GLOBALS['page'])) {
        $page = $_GLOBALS['page'];
    } else {
        $page = 'index.php';
    }
    $isMediaQueries = 0;
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
            <input type="checkbox" id="bouton" />
            <label id = "labelMenu" for="bouton">
                <img src="img/iconeMenu.png" alt="Ouvrir le menu" id="boutonMenu" title="Menu" />
            </label>
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
                        <li> <a href="compte.php" title="Cliquez ici pour accéder à votre compte" class="compte"><img src="img/compte.png" alt="image compte" id="imgCompte"></a> </li> 
                    <?php else : ?> <!-- Si on est pas sur la page déconnexion ou compte -->
                        <li><a href="deconnexion.php" title="Cliquez ici pour vous déconnecter"><img src="img/deconnexion.png" alt="image deconnexion" id="imgDeconnexion"></a></li>
                        <!-- Bouton pour afficher/masquer le sous-menu -->
                        
                        <script>
                            isMediaQueries();
                        </script>
                            <?php if ($isMediaQueries == 0):  ?>
                                <li><button class="buttonMenu" onclick="showMenu()" title = "fleche"> <img src="img/flecheHaute.png" alt="image fleche" id="imgFleche"> Mon profil</button>
                                <!-- Sous-menu -->
                                    <div class="sousMenu" id="sousMenu">
                                        <a href="compte.php">Mon compte</a>
                                        <a href="deconnexion.php">Se déconnecter <img src="img/deconnexion.png" alt="image deconnexion" id="imgDeconnexion"></a>
                                    </div>
                                </li>
                                <li> <a href="compte.php" title="Cliquez ici pour accéder à votre compte"><img src="img/compte.png" alt="image compte" id="imgCompte"></a> </li> 
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


