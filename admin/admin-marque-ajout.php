<?php
session_start();
$GLOBALS["page"] = "admin-marque.php";
require_once(__DIR__ . '/../libs/database-functions.php');
require_once(__DIR__ . '/../libs/functions.php');


if (isset($_POST["submit"]) && isset($_POST["nom"])) {
    createMarque($_POST["nom"]);
    header("Location: ../admin/admin-marque.php");
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
    <title>MARQUE</title>
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
        <div class="marque">
            <h1>Informations de la marque</h1>
            <form id="formAjouter" method="post">
                <fieldset>
                    <label for="nom">nom</label>
                    <input placeholder="nom" type="text" name="nom" id="nom" required>
                </fieldset>
                <fieldset>
                    <input type="submit" name="submit" value="Ajouter la marque">
                </fieldset>
            </form>
            <p><a class="retourPage" href="admin-marque.php" title="Cliquez ici pour retourner à la page des marques">←Retourner à la page des marques</a></p>
    </main>
    </a>
</body>

</html>