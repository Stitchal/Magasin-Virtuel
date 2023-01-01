<?php
    require_once('database/DatabaseFunction.php');
    require_once('index.php');

    if(!empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['mdp']) and !empty($_POST['email'])){
        if(!checkClientExistant($_POST['email'], $_POST['nom'], $_POST['prenom'])){
            createClient($_POST['nom'], $_POST['prenom'], $_POST['mdp'], $_POST['email']);
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
?>

<!DOCTYPE html>
<html LANG="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <title>Créer un compte </title>
</head>
<body>
    <main>
        <form class="connexion_creercompte" method="post">
            <fieldset>
                <label for="nom">Nom</label>
                <input placeholder="Nom" type="text" name="nom" id="nom" required>
            </fieldset>

            <fieldset>
                <label for="prenom">Prénom</label>
                <input placeholder="Prénom" type="text" name="prenom" id="prenom" required>
            </fieldset>

            <fieldset>
                <label for="mdp">Mot de passe</label>
                <input placeholder="Mot de passe" type="password" name="mdp" id="mdp" required>
            </fieldset>
            <fieldset>
                <label for="email">Email</label>
                <input placeholder="Adresse email" type="mail" name="email" id="email" required>
            </fieldset>
            <fieldset>
                <input type="submit" value="Créer votre compte">
            </fieldset>
        </form>
        <div class="createCompte">
            <p>Vous avez un compte ? <a href="connexion.php" title="Cliquez ici pour vous créer un compte">Connectez-vous</a></p>
        </div>
    </main>

</body>
</html>