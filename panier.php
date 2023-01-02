<?php
session_start();
require_once('database/DatabaseFunction.php');
$GLOBALS["page"] = "panier.php";
if(isset($_POST["suppr"])){
    unset($_SESSION['panier'][$_POST["supprimer"]]);
}

if(isset($_POST["modifier"])){
    if(checkStockProduct(getIDProduct($_POST["modify"]), $_POST['quantite'])){
        $_SESSION['panier'][$_POST["modify"]] = $_POST['quantite'];
    }
}
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
        <?php
        if (!empty($_SESSION['nom'])) {
            if (!empty($_SESSION['panier'])) {
                echo '<h1>Votre panier</h1>';
                ConnexionDB::getInstance();
                $sql = "SELECT * FROM produit";
                $result = ConnexionDB::getInstance()->querySelect($sql);
                $i = 1;
                echo '<table id ="tableauPanier">';
                foreach ($_SESSION['panier'] as $clef => $valeur) {
                    echo "<tr>";
                    echo '<td>';
                    $maxProduit = getStockProduct(getIDProduct($clef));
                    $img = "SELECT image FROM produit WHERE nom = '$clef'";
                    $res2 = ConnexionDB::getInstance()->querySelect($img);
                    $link = "img/" . $res2[0]['image'];
                    echo "<img src=$link>";
                    echo '</td>';
                    echo '<td>';
                    echo '<h2>' . $clef . '</h2>';
                    echo '<form id="modifierQuantitePanier" method = "post">';
                    echo '<label for="quantite">Quantité : </label>';
                    echo '<input placeholder="' . $valeur . '" type="number" inputmode="decimal" id="quantite" name="quantite" min="' . $valeur . '" max="' . $maxProduit . '">';
                    echo "<input type='hidden' name='modify' value=$clef>";
                    echo '<input name="modifier" type="submit" value="Modifier la quantité">';
                    echo '</form>';
                    echo '<form method = "post">';
                    echo '<fieldset>';
                    echo "<input type='hidden' name='supprimer' value=$clef>";
                    echo"<input name='suppr' class='supprimerProduit' type='submit' value = 'Supprimer' >";
                    echo '<fieldset>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo 'Votre panier est vide :(';
                echo '</br>';
                echo '<img id="gifPanierVide" src="img/gifPanierVide.gif">';
            }
        } else {
            echo '<div class="createCompte">';
            echo "<p>Veuillez vous <a href='connexion.php' title='Cliquez ici pour vous créer un compte'>connecter</a> afin d'utiliser le panier.</p>";
            echo '</div>';
        }


        ?>
    </main>
    <a href="#" title="Cliquez ici pour retourner en haut de la page">
        <div id="haut_page"><img src="img/flecheHaut.png" alt="image fleche haut">
    </a></div>
    </a>
</body>

</html>