<?php
    if(isset($_GLOBALS['page'])) {
        $page = $_GLOBALS['page'];
    } else {
        //$page = 'menu-admin.php';
    }
    require_once(__DIR__ . '/../libs/database-functions.php');
?>

<!DOCTYPE html>
<html LANG="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
</head>
<body>
    <!--<input type="checkbox" id="bouton" />
    <label id = "labelMenu" for="bouton">
        <img src="img/iconeMenu.png" alt="Ouvrir le menu" id="boutonMenu" title="Menu" />
    </label>-->
    <div class='menuAdmin'>
        <ul>
            <?php 
            if ($page == "admin-client.php"){ //si on est sur la page adminClient ?>
                <li><a href="../admin/admin-client.php" class="blue">client</a></li>
            <?php } else{ //si on est pas sur la page adminClient ?>
                <li><a href="../admin/admin-client.php">client</a></li>
            <?php }

            if ($page == "admin-comptabilite.php"){ //si on est sur la page adminComptabilite ?>
                <li><a href="../admin/admin-comptabilite.php" class="blue">comptabilite</a></li>
            <?php } else{ //si on est pas sur la page adminComptabilite ?>
                <li><a href="../admin/admin-comptabilite.php">comptabilite</a></li>
            <?php }
            
            if ($page == "admin-facturation.php"){ //si on est sur la page adminFacturation ?>
                <li><a href="../admin/admin-facturation.php" class="blue">facturation</a></li>
            <?php } else{ //si on est pas sur la page adminFacturation ?>
                <li><a href="../admin/admin-facturation.php">facturation</a></li>
            <?php }

            if ($page == "admin-fournisseur.php"){ //si on est sur la page adminFournisseur ?>
                <li><a href="../admin/admin-fournisseur.php" class="blue">fournisseur</a></li>
            <?php } else{ //si on est pas sur la page adminFournisseur ?>
                <li><a href="../admin/admin-fournisseur.php">fournisseur</a></li>
            <?php }

            if ($page == "admin-gestion_stock.php"){ //si on est sur la page adminGestion_stock ?>
                <li><a href="../admin/admin-gestion_stock.php" class="blue">gestion_stock</a></li>
            <?php } else{ //si on est pas sur la page adminGestion_stock ?>
                <li><a href="../admin/admin-gestion_stock.php">gestion_stock</a></li>
            <?php }

            if ($page == "admin-marque.php"){ //si on est sur la page adminMarque ?>
                <li><a href="../admin/admin-marque.php" class="blue">marque</a></li>
            <?php } else{ //si on est pas sur la page adminMarque ?>
                <li><a href="../admin/admin-marque.php">marque</a></li>
            <?php }

            if ($page == "admin-produit.php"){ //si on est sur la page adminArticle ?>
                <li><a href="../admin/admin-produit.php" class="blue">produit</a></li>
            <?php } else{ //si on est pas sur la page adminArticle ?>
                <li><a href="../admin/admin-produit.php">produit</a></li>
            <?php }
            ?>
        </ul>
    </div>
</body>
<script>
</script>
</html>