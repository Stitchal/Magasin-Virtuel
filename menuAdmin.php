<?php
    if(isset($_GLOBALS['page'])) {
        $page = $_GLOBALS['page'];
    } else {
        //$page = 'menuAdmin.php';
    }
    require_once('database/DatabaseFunction.php');
?>

<!DOCTYPE html>
<html LANG="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body>
    <!--<input type="checkbox" id="bouton" />
    <label id = "labelMenu" for="bouton">
        <img src="img/iconeMenu.png" alt="Ouvrir le menu" id="boutonMenu" title="Menu" />
    </label>-->
    <div class='menuAdmin'>
        <ul>
            <?php 
            if ($page == "adminClient.php"){ //si on est sur la page adminClient ?>
                <li><a href="adminClient.php" class="blue">client</a></li>
            <?php } else{ //si on est pas sur la page adminClient ?>
                <li><a href="adminClient.php">client</a></li>
            <?php }

            if ($page == "adminComptabilite.php"){ //si on est sur la page adminComptabilite ?>
                <li><a href="adminComptabilite.php" class="blue">comptabilite</a></li>
            <?php } else{ //si on est pas sur la page adminComptabilite ?>
                <li><a href="adminComptabilite.php">comptabilite</a></li>
            <?php }
            
            if ($page == "adminFacturation.php"){ //si on est sur la page adminFacturation ?>
                <li><a href="adminFacturation.php" class="blue">facturation</a></li>
            <?php } else{ //si on est pas sur la page adminFacturation ?>
                <li><a href="adminFacturation.php">facturation</a></li>
            <?php }

            if ($page == "adminFournisseur.php"){ //si on est sur la page adminFournisseur ?>
                <li><a href="adminFournisseur.php" class="blue">fournisseur</a></li>
            <?php } else{ //si on est pas sur la page adminFournisseur ?>
                <li><a href="adminFournisseur.php">fournisseur</a></li>
            <?php }

            if ($page == "adminGestion_stock.php"){ //si on est sur la page adminGestion_stock ?>
                <li><a href="adminGestion_stock.php" class="blue">gestion_stock</a></li>
            <?php } else{ //si on est pas sur la page adminGestion_stock ?>
                <li><a href="adminGestion_stock.php">gestion_stock</a></li>
            <?php }

            if ($page == "adminMarque.php"){ //si on est sur la page adminMarque ?>
                <li><a href="adminMarque.php" class="blue">marque</a></li>
            <?php } else{ //si on est pas sur la page adminMarque ?>
                <li><a href="adminMarque.php">marque</a></li>
            <?php }

            if ($page == "adminArticle.php"){ //si on est sur la page adminArticle ?>
                <li><a href="adminArticle.php" class="blue">produit</a></li>
            <?php } else{ //si on est pas sur la page adminArticle ?>
                <li><a href="adminArticle.php">produit</a></li>
            <?php }
            ?>
        </ul>
    </div>
</body>
<script>
</script>
</html>