<?php
session_start();
$GLOBALS["page"] = "compte.php";
require_once('index.php');
require_once('functions.php');
require_once('database/DatabaseFunction.php');
?>

<!DOCTYPE html>
<html LANG="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <title>Informations du compte</title>
</head>

<body>
    <main>
        <h1>Factures</h1>
        <?php
        $idFactures = getIdFacturesFrom($_SESSION["nom"]);
        foreach ($idFactures as $id) {
            $facture = getFacture($id);
            $articles = getArticleFacture($facture['articles']);


            echo "<div class='divFacture'> <table class='facture'>";
            echo "<thead>";
            echo '<b>Facture N°'.$facture['id'].'</b>';
            echo "</thead>";
            echo "<tbody>";
            echo "<tr>";
            echo "<td>ID</td>";
            echo  "<td>";
            echo $facture['id'];
            echo "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>Articles</td>";
            echo  "<td>";
            $affichage = "";
            foreach ($articles as $article){
                $affichage .=  getNameProduct($article[0]);
                $affichage .= "(" ;
                $affichage .= ltrim($article[1]) .") ";
                $affichage .= $article[2] . "€" . ", ";
            }
            echo $affichage;
            echo "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>Date</td>";
            echo  "<td>". $facture['dateFact']."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>Nom</td>";
            echo  "<td>". $facture['nomAcheteur']."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>Prénom</td>";
            echo  "<td>". $facture['prenomAcheteur']."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>Adresse mail</td>";
            echo  "<td>". $facture['emailAcheteur']."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>Montant total</td>";
            echo  "<td>". $facture['prixTotal']."€</td>";
            echo "</tr>";
            
            echo "</tbody>";
            echo "</table></div>";
        }
        ?>

        <p><a id="retourPageArticle" href="compte.php" title="Cliquez ici pour retourner à la vue d'ensemble du compte">Retourner à la vue d'ensemble du compte</a></p>
        <a href="#"title="Cliquez ici pour retourner en haut de la page">
        <div id="haut_page"><img src="img/flecheHaut.png" alt="image fleche haut"></a></div>
    </a>
    </main>
</body>

</html>