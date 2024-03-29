<?php
session_start();
$GLOBALS["page"] = "admin-fournisseur.php";
require_once(__DIR__ . '/../libs/database-functions.php');
require_once(__DIR__ . '/../libs/functions.php');
require_once('../libs/database-functions.php');
require_once(__DIR__ . '/../libs/verifySession.php');
require_once('../libs/database-functions.php');

$verifyAdmin = new VerifSession();
if (!$verifyAdmin->verifConnection() || (!checkAdmin($_SESSION["nom"], $_SESSION["prenom"], $_SESSION["email"]))) {
    header('Location: ../others/connexion.php');
    exit();
}


$verify = new Verification();

if (isset($_POST["submit"]) && isset($_POST["nomEntreprise"]) && isset($_POST["infos"]) && isset($_POST["mail"]) && isset($_POST["mdp"])) {
    if ($verify->verificationMail($_POST["mail"])) {
        createFournisseur($_POST["nomEntreprise"], $_POST["mail"], $_POST["mdp"], $_POST["infos"]);
        header("Location: ../admin/admin-fournisseur.php");
        exit();
    }
    $error = "email non valide";
    header("Location: ../admin/admin-fournisseur-ajout.php?error=" . urlencode($error));
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
    <title>Ajout de fournisseur</title>
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
            <h1>Informations du fournisseur</h1>
            <form id="formAjouter" method="post">
                <fieldset>
                    <label for="nomEntreprise">nom de l'entreprise</label>
                    <input placeholder="nomEntreprise" type="text" name="nomEntreprise" id="nomEntreprise" required>
                </fieldset>


                <fieldset>
                    <label for="mail">Adresse mail</label>
                    <input placeholder="mail" type="text" name="mail" id="mail" required>
                </fieldset>


                <fieldset>
                    <label for="mdp">mot de passe</label>
                    <input placeholder="Mot de passe" type="text" name="mdp" id="mdp" required>
                </fieldset>

                <fieldset>
                    <label for="infos">Informations</label>
                    <input placeholder="infos" type="text" name="infos" id="infos">
                </fieldset>
                <fieldset>
                    <input id="ajouterItem" type="submit" name="submit" value="Ajouter le fournisseur">
                </fieldset>
            </form>
            <p><a class="retourPage" href="admin-fournisseur.php" title="Cliquez ici pour retourner à la page des fournisseurs">←Retourner à la page des clients</a></p>
    </main>
    </a>
</body>

</html>