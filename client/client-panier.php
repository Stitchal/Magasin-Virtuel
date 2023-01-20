<?php
session_start();
$GLOBALS["page"] = "client-panier.php";
require_once(__DIR__ . '/../libs/database-functions.php');

if (isset($_POST["suppr"])) {
    $_SESSION['nbArticle'] = $_SESSION['nbArticle'] - $_POST['supprQuantite'];
    unset($_SESSION['panier'][$_POST["supprimer"]]);

}

if (isset($_POST["modifier"])) {
    if (checkStockProduct(getIDProduct($_POST["modify"]), $_POST['quantite'])) {
        $_SESSION['nbArticle'] = $_SESSION['nbArticle'] - $_SESSION['panier'][$_POST["modify"]] + $_POST['quantite'];
        $_SESSION['panier'][$_POST["modify"]] = $_POST['quantite'];
    }
    
}

require_once(__DIR__.'/../includes/nav.php');
?>


<!DOCTYPE html>
<html LANG="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <title>Magasin Virtuel</title>
</head>

<body>
    <main>
        <?php
        if (!empty($_SESSION['nom'])) {
            if (!empty($_SESSION['panier'])) {
                $sous_total = 0;
                echo '<h1>Votre panier</h1>';
                $nbTotalArticle = 0;
                ConnexionDB::getInstance();
                $sql = "SELECT * FROM produit";
                $result = ConnexionDB::getInstance()->querySelect($sql);
                $i = 1;
                echo '<table id ="tableauPanier">';
                foreach ($_SESSION['panier'] as $clef => $valeur) {
                    $nbTotalArticle += $valeur;
                    echo "<tr>";
                    echo '<td>';
                    $maxProduit = getStockProduct(getIDProduct($clef));
                    $prixProd = getPrixArticle($clef);
                    $sous_total += $prixProd * $valeur;
                    $img = "SELECT image FROM produit WHERE nom = '$clef'";
                    $res2 = ConnexionDB::getInstance()->querySelect($img);
                    $link = "../img/" . $res2[0]['image'];
                    echo "<img src=$link>";
                    echo '</td>';
                    echo '<td>';
                    echo "<div class='panierNomProduit'><h2>" . $clef . "</h2></div>";
                    echo '<div class="panierPrix"<p><b>'.$prixProd.'€</b></p></div>';
                    echo "<div class='panierQuantite'>";
                    echo '<form id="modifierQuantitePanier" method = "post">';
                    echo '<label for="quantite">Quantité : </label>';
                    echo '<input placeholder="' . $valeur . '" type="number" inputmode="decimal" id="quantite" value="'.$valeur.'" name="quantite" min="1" max="' . $maxProduit . '">';
                    echo "<input type='hidden' name='modify' value=$clef>";
                    echo '<input name="modifier" type="submit" value="Modifier la quantité">';
                    echo '</form></div>';
                    echo "<div class='panierSupprimer'>";
                    echo '<form method = "post">';
                    echo '<fieldset>';
                    echo "<input type='hidden' name='supprQuantite' value=$valeur>";
                    echo "<input type='hidden' name='supprimer' value=$clef>";
                    echo "<input name='suppr' class='supprimerProduit' type='submit' value = 'Supprimer' >";
                    echo '</fieldset>';
                    echo '</form></div>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '<div class="infosCommande">';
                echo '<p id="montantTotal">Sous-total ('.$nbTotalArticle.' articles) : <b>'.$sous_total.'€</b></p>';
                $_SESSION["totalPaiement"] = $sous_total;
            } else {
                echo 'Votre panier est vide :(';
                echo '</br>';
                echo '<img id="gifPanierVide" src="../img/gif-panier-vide.gif">';
            }
        } else {
            echo '<div class="createCompte">';
            echo "<p>Veuillez vous <a href='../others/connexion.php' title='Cliquez ici pour vous créer un compte'>connecter</a> afin d'utiliser le panier.</p>";
            echo '</div>';
        }

        if (!empty($_SESSION['panier'])){
            echo '<a href="client-passer-commande.php" id="passerCommande" title="Cliquez ici passer la commande">Passer la commande</a>';
            echo '</div>';
        }
        ?>
    </main></div>
    </a>
</body>

</html>