<?php
session_start();
$GLOBALS["page"] = "compte.php";
require_once(__DIR__ . '/../includes/nav.php');
require_once(__DIR__ . '/../libs/functions.php');
require_once(__DIR__ . '/../libs/database-functions.php');
?>

<!DOCTYPE html>
<html LANG="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <title>Informations du compte</title>
</head>

<body>
    <main>
        <h1>Factures</h1>
        <?php
        $idFactures = getIdFacturesFrom($_SESSION["nom"]);
        foreach ($idFactures as $id) {

            $verify = new Verification();
            $facture = getFacture($id);
            $articles = $verify->getArticleFacture($facture['articles']);


            echo "<div class='divFacture'>";
            echo "<h3>Facture N°".$facture["id"]."</h3>";
            echo "<table class ='clientFacture'>
                    <tbody>
                        <tr>
                            <td>Nom</td>
                            <td>" . $facture['nomAcheteur'] . "</td>
                        </tr>
                        <tr>
                            <td>Prénom</td>
                            <td>" . $facture['prenomAcheteur'] . "</td>
                        </tr>
                        <tr>
                            <td>Adresse mail</td>
                            <td>" . $facture['emailAcheteur'] . "</td>
                        </tr>
                        <tr>
                            <td>Référence de la facture</td>
                            <td>".$facture["id"]."</td>
                        </tr>
                        <tr>
                            <td>Date-heure de la création</td>
                            <td>".$facture["dateFact"]."</td>
                        </tr>
                    </tbody>
                </table>";

            echo "<table class='facture'>";
            echo "<tbody>";

            $totalHT = 0;
            $totalTVA = 0;
            $totalTTC = 0;

            echo "<tr><td>Produit</td><td>Quantité</td><td>Prix unitaire HT</td><td>TVA %</td><td>Total TVA</td><td>Total TTC</td></tr>";
            foreach ($articles as $article) {
                $nomProduit = getNameProduct($article[0]);
                $quantite = ltrim($article[1]);
                $prixHT = $article[2];
                $totalProduitTVA = $prixHT * 0.2;
                $totalProduitTTC = ($prixHT * $quantite) * 1.20;
                $totalTVA += $totalProduitTVA*$quantite;
                echo "<tr>
                        <td>".$nomProduit."</td>
                        <td>".$quantite."</td>
                        <td>".$prixHT." €</td>
                        <td>".$facture["TVA"]." %</td>
                        <td>".$totalProduitTVA." €</td>
                        <td>".$totalProduitTTC." €</td>
                    </tr>";
            }
            echo "</tbody>
            </table>";
            echo "<table class='totalFacture'>
                    <tbody>
                        <tr>
                            <td><b>Total HT</b></td>
                            <td><b>".$facture["prixHT"]." €</b></td>
                        </tr>
                        <tr>
                            <td><b>Total TVA</b></td>
                            <td><b>".$totalTVA." €</b></td>
                        </tr>
                        <tr>
                            <td><b>Total TTC</b></td>
                            <td><b>".$facture["prixTTC"]." €</b></td>
                        </tr>
                    </tbody>
                </table>";
            echo "</div>";
        }
        ?>

        <p><a id="retourPageArticle" href="../others/compte.php" title="Cliquez ici pour retourner à la vue d'ensemble du compte">Retourner à la vue d'ensemble du compte</a></p>
        <a href="#" title="Cliquez ici pour retourner en haut de la page">
            <div id="haut_page"><img src="../img/fleche-haut-page.png" alt="image fleche haut">
        </a></div>
        </a>
    </main>
</body>

</html>