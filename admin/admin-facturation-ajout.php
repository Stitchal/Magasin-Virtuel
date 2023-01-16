<?php
session_start();
$GLOBALS["page"] = "admin-facturation.php";
require_once(__DIR__ . '/../libs/database-functions.php');
require_once(__DIR__.'/../libs/functions.php');


$verify = new Verification();

if (isset($_POST["submit"]) && isset($_POST["articles"]) && isset($_POST["nom"]) && isset($_POST["email"]) && isset($_POST["prenom"]) && isset($_POST["prixHT"]) && isset($_POST["TVA"])) {
    if ($verify->verifieListeArticles($_POST["articles"]) && $verify->verificationMail($_POST["email"])) {
        createFacturation($_POST["articles"], $_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["prixHT"], $_POST["TVA"]);
        header("Location: ../admin/admin-facturation.php");
        exit();
    }
    else if($verify->verificationMail($_POST["email"])){
        $error = "erreur mail";
    }
    else {
        $error = "erreur format liste article,  ex : 1_1_1, 2_2_2, ";
    }
    header("Location: ../admin/admin-facturation-ajout.php?error=" . urlencode($error));
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
    <title>FACTURATION</title>
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
            <h1>Informations de la facture</h1>
            <form id="formAjouter" method="post">
                <fieldset>
                    <label for="articles">articles de la facturation format (id_Nb_prix, id_Nb_prix)</label>
                    <input placeholder="articles" type="text" name="articles" id="articles" required>
                </fieldset>
                <fieldset>
                    <label for="nom">nom acheteur</label>
                    <input placeholder="nom" type="text" name="nom" id="nom" required>
                </fieldset>
                <fieldset>
                    <label for="prenom">prenom acheteur</label>
                    <input placeholder="prenom" type="text" name="prenom" id="prenom" required>
                </fieldset>

                <fieldset>
                    <label for="email">email acheteur</label>
                    <input placeholder="email" type="text" name="email" id="email">
                </fieldset>
                <fieldset>
                    <label for="prixHT">prixHT</label>
                    <input placeholder="prixHT" type="text" name="prixHT" id="prixHT">
                </fieldset>
                <fieldset>
                    <label for="TVA">TVA</label>
                    <input placeholder="TVA" type="text" name="TVA" id="TVA">
                </fieldset>
                <fieldset>
                    <input id="ajouterItem" type="submit" name="submit" value="Ajouter le fournisseur">
                </fieldset>
            </form>
            <p><a class="retourPage" href="admin-facturation.php" title="Cliquez ici pour retourner à la page des factures">←Retourner à la page des factures</a></p>
    </main>
    </a>
</body>

</html>