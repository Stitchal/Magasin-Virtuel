<?php
session_start();
$GLOBALS["page"] = "adminClient.php";
require_once('database/DatabaseFunction.php');
require_once('functions.php');

if (isset($_POST["submit"]) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["mail"]) && isset($_POST["mdp"])) {
    if (verificationMail($_POST["mail"])) {
        echo "|" . $_POST["nom"] . "|  |" . $_POST["prenom"] . "|  |" . $_POST["mail"] . "|  |" . $_POST["mdp"] . "|";
        if (isset($_POST["estAdmin"])) {
            createClient($_POST["nom"], $_POST["prenom"], $_POST["mail"], $_POST["mdp"], 1);
        } else {
            createClient($_POST["nom"], $_POST["prenom"], $_POST["mail"], $_POST["mdp"]);
        }
        header("Location: adminClient.php");
        exit();
    }
    $error = "email non valide";
    header("Location: adminClientAjouter.php?error=" . urlencode($error));
    exit();
}
require_once('nav.php');
?>

<!DOCTYPE html>
<html LANG="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <title>ADMIN</title>
    <style>
        input[type=submit] {
            background-color: rgb(1, 71, 1);
        }

        input[type=submit]:hover {
            background-color: green;
        }

        a#retourPageArticle {
            color: #212529;
            text-decoration: underline;
        }

        a#retourPageArticle:hover {
            text-decoration: none;
        }

        #divGauche {
            display: inline-block;
            width: 49%;
        }

        #divGauche input {
            height: 1vh;
            width: 50%;
        }

        #divDroite input {
            height: 1vh;
            width: 50%;
        }

        #divDroite {
            display: inline-block;
            width: 49%;
        }

        #divDroite input[type="color"] {
            height: 3vw;
            cursor: pointer;
        }

        #divInformations {
            border-radius: 1em;
            padding: 5%;
            background-color: #F7F7F7;
        }
    </style>
</head>

<body>
    <main>
        <?php if (!empty($_GET) || !empty($_GET['error'])) : ?>
            <p style="color:#FF0000" ;> Erreur : <?= $_GET['error'] ?> </p>
        <?php endif ?>
        <div class="client">
            <h1>Informations du client</h1>
            <form id="formAjouter" method="post">
                <fieldset>
                    <label for="prenom">prenom</label>
                    <input placeholder="prenom" type="text" name="prenom" id="prenom" required>
                </fieldset>

                <fieldset>
                    <label for="nom">nom</label>
                    <input placeholder="nom" type="text" name="nom" id="nom" required>
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
                    <label for="isAdmin">est admin</label>
                    <input placeholder="estAdmin" type="checkbox" name="estAdmin" id="estAdmin">
                </fieldset>
                <fieldset>
                    <input type="submit" name="submit" value="Ajouter le client">
                </fieldset>
            </form>
            <p><a class="retourPage" href="adminClient.php" title="Cliquez ici pour retourner à la page des clients">←Retourner à la page des clients</a></p>
    </main>
    </a>
</body>

</html>