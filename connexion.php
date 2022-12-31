<?php

session_start();
$GLOBALS["page"] = "connexion.php";
$compteCree = 0;

require_once('database/DatabaseFunction.php');

if (!empty($_POST['nom']) and !empty($_POST['prenom'])){
    if(checkClientExistant($_POST['email'], $_POST['nom'], $_POST['prenom'])){
        $_SESSION['nom'] = $_POST['nom'];
        $_SESSION['prenom'] = $_POST['prenom'];
        $_SESSION['email'] = $_POST['email'];
        header('Location: articles.php');
        exit;
    }
    else{
        header('Location: creationCompte.php');
        exit;
    }
   
}
require_once('index.php');



// Souvent on identifie cet objet par la variable $conn ou $db
//$mysqlConnection = new PDO('mysql:host=linserv-info01.campus.unice.fr;port=5432;dbname=alexis.rosset@univ-cotedazur.fr', 'ra103059', 'ra103059');

?>

<!DOCTYPE html>
<html LANG="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <title>Ouvrir une session</title>
</head>
<body>
    <main>
        <h1>Connectez-vous</h1>
        <form method="post">
            <fieldset>
                <label for="nom">Nom</label>
                <input placeholder="Nom" type="text" name="nom" id="nom" required>
            </fieldset>

            <fieldset>
                <label for="prenom">Prénom</label>
                <input placeholder="Prénom" type="text" name="prenom" id="prenom" required>
            </fieldset>

            <fieldset>
                <label for="email">Email</label>
                <input placeholder="Adresse email" type="text" name="email" id="email" required>
            </fieldset>
            <fieldset class="fieldsetResterConnecte">
                <input type="checkbox">
                <label class="resterConnecte">Rester connecté</label>
            </fieldset>
            <fieldset>
                <input type="submit" value="Connexion">
            </fieldset>
        </form>
        
        <div class="createCompte">
            <p>Nouveau chez nomSite ?</p>
            <p><a href="creationCompte.php" title="Cliquez ici pour vous créer un compte">Créez votre compte</a></p>
        </div>
    </main>
    <a href="#"title="Cliquez ici pour retourner en haut de la page">
        <div id="haut_page"><img src="img/flecheHaut.png" alt="image fleche haut"></a></div>
    </a>
</body>
</html>