<?php
session_start();

require_once(__DIR__ . '/../libs/verifySession.php');
require_once(__DIR__ . '/../libs/functions.php');
require_once('../libs/database-functions.php');

$verifSession = new VerifSession();
if (!$verifSession->verifConnection()) {
    header('Location: ../index.php');
    exit;
}

if (!$verifSession->verifPaiementAdmin()) {
    header('Location: index-admin.php');
    exit;
}




?>

<!DOCTYPE html>
<html LANG="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <title>Paiement admin</title>
</head>

<body>
    <main>
        <?php
        if (checkComptabilite()) {
            updateComptabiliteAchat($_SESSION["montantPayer"]);
        } else {
            createComptabiliteAchat($_SESSION["montantPayer"]);
        }
        augmenteStock($_SESSION["idProdReappro"], $_SESSION["quantitePayer"]);

        ?>
        <p>Votre commande a été effectuée.</p>
        <div id="facturation">
            <table class="divCompte">
                <thead>Facturation</thead>
                <tbody>
                    <tr>
                        <td>articles</td>
                        <td><?php
                            $articlesString = $_SESSION['idProdReappro'];
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
                        <td><?php echo $_SESSION["montantPayer"]; ?>€</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p><a id="retourPageArticle" href="index-admin.php" title="Cliquez ici pour retourner à la page des articles">←Retourner à l'accueil</a></p>
        <?php
        unset($_SESSION["montantPayer"]);
        unset($_SESSION["idProdReappro"]);
        unset($_SESSION["quantitePayer"]);
        ?>
    </main>
</body>

</html>