<?php
session_start();
$GLOBALS["page"] = "admin-gestion_stock.php";
require_once(__DIR__ . '/../libs/database-functions.php');
require_once(__DIR__ . '/../libs/functions.php');

if (isset($_POST["submit"]) && isset($_POST["refProduit"]) && isset($_POST["refFournisseur"]) && isset($_POST["quantite"])) {
    createGestionStock($_POST["refProduit"], $_POST["refFournisseur"], $_POST["quantite"]);
    header("Location: ../admin/admin-gestion_stock.php");
    exit();
}

require_once(__DIR__ . '/../includes/nav.php');
?>

<!DOCTYPE html>
<html LANG="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <title>FOURNISSEUR</title>
    <style>
        input[type=submit]#ajouterItem {
            background-color: rgb(1, 71, 1);
        }

        input[type=submit]#ajouterItem:hover {
            background-color: green;
        }
    </style>
</head>

<body>
    <main>
        <?php if (!empty($_GET) || !empty($_GET['error'])) : ?>
            <p style="color:#FF0000" ;> Erreur : <?= $_GET['error'] ?> </p>
        <?php endif ?>
        <div class="client">
            <h1>Informations gestion_stock</h1>
            <form id="formAjouter" method="post">
                <fieldset>
                    <label for="refProduit">référence du produit</label>
                    <input placeholder="refProduit" type="text" name="refProduit" id="refProduit" required>
                </fieldset>
                <fieldset>
                    <label for="refFournisseur">référence du fournisseur</label>
                    <input placeholder="refFournisseur" type="text" name="refFournisseur" id="refFournisseur" required>
                </fieldset>
                <fieldset>
                    <label for="quantite">quantite</label>
                    <input placeholder="quantite" type="text" name="quantite" id="quantite" required>
                </fieldset>
                <fieldset>
                    <input type="submit" name="submit" value="Ajouter la gestion du stock">
                </fieldset>
            </form>
            <p><a class="retourPage" href="admin-gestion_stock.php" title="Cliquez ici pour retourner à la page des gestions stock">←Retourner à la page de gestion stock</a></p>
    </main>
    </a>
</body>

</html>