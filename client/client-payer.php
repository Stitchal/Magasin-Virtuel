<?php
session_start();

require_once(__DIR__ . '/../libs/verifySession.php');
$verifSession = new VerifSession();
if(!$verifSession->verifConnection()){
    header('Location: ../client-article.php');
    exit;
}

if(!$verifSession->verifPaiementClient()){
    header('Location: client-article.php');
    exit;
}





require_once(__DIR__ . '/../libs/database-functions.php');
require_once(__DIR__.'/../libs/functions.php');
require_once(__DIR__.'/../libs/mail.php');

?>

<!DOCTYPE html>
<html LANG="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <title>Paiement</title>
</head>

<body>
    <main>
        <?php
            $date = date('d-m-Y');
            generateFacturation($_SESSION["panier"], $_SESSION["nom"], $_SESSION["prenom"], $_SESSION["email"], $_SESSION["totalPaiement"]);
            updateGestionStock($_SESSION["panier"]);
            if (checkComptabilite()) {
                updateComptabiliteVente($_SESSION["totalPaiement"], $_SESSION["panier"]);
            } else {
                createComptabiliteVente($_SESSION["totalPaiement"], $_SESSION["panier"]);
            }
            ?>
        <p>Votre commande a été effectuée.</p>
        <div id="facturation">
            <table class="divCompte">
                <thead>Facturation</thead>
                <tbody>
                    <tr>
                        <td>id</td>
                        <td><?php
                                getIDFacturation(getDateAjd(), $_SESSION["nom"]);
                                $_SESSION["idFact"] = getIDFacturation(getDateAjd(), $_SESSION["nom"]);


                                sendEmail($_SESSION["email"], "facture-commande@minetazon.com");
                                sendEmail("alexis.rosset06@gmail.com", "facture-commande-effectuee");
                                sendEmail("leo0678q@gmail.com", "facture-commande-effectuee");
                                echo $_SESSION["idFact"]; ?></td>

                    </tr>
                    <tr>
                        <td>articles</td>
                        <td><?php
                            $articlesString = "";
                            foreach ($_SESSION['panier'] as $clef => $valeur) {
                                $articlesString .= $clef . ", ";
                            }
                            echo $articlesString;
                            ?></td>
                    </tr>
                    <tr>
                        <td>dateFact</td>
                        <td><?php echo date('d-m-Y'); ?></td>
                    </tr>
                    <tr>
                        <td>nomAcheteur</td>
                        <td><?php echo $_SESSION['nom']; ?></td>
                    </tr>
                    <tr>
                        <td>prenomAcheteur</td>
                        <td><?php echo $_SESSION['prenom']; ?></td>
                    </tr>
                    <tr>
                        <td>emailAcheteur</td>
                        <td><?php echo $_SESSION['email']; ?></td>
                    </tr>
                    <tr>
                        <td>prixTotal</td>
                        <td><?php echo $_SESSION["totalPaiement"]; ?>€</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p><a id="retourPageArticle" href="../index.php" title="Cliquez ici pour retourner à la page des articles">←Retourner à la page des articles</a></p>
        <?php
        unset($_SESSION['panier']);
        unset($_SESSION["totalPaiement"]);
        unset($_SESSION["nbArticle"]);
        ?>
    </main>
</body>

</html>