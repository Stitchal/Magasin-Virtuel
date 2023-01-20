<?php

session_start();
$GLOBALS["page"] = "connexion.php";
$compteCree = 0;

require_once(__DIR__ . '/../libs/database-functions.php');

if (!empty($_POST['email']) and !empty($_POST['mdp'])) {
    if (checkClientExistant($_POST['email'], $_POST['mdp'])) {
        if (isset($_POST['souvenir'])) {
            $timeout = 10000;
            session_abort();
            ini_set("session.gc_maxlifetime", $timeout);
            ini_set("session.cookie_lifetime", $timeout);
            session_start();
            $s_name = session_name();
            setcookie($s_name, $_COOKIE[$s_name], time() + $timeout, '/');
        }
            $infos = getInfoClient($_POST['email'], $_POST["mdp"]);
            $_SESSION['nom'] = $infos["nom"];
            $_SESSION['prenom'] = $infos['prenom'];
            $_SESSION['email'] = $infos['mail'];
        if (checkAdmin($_SESSION['nom'], $_SESSION['prenom'], $_SESSION['email'])) {
            header('Location: ../admin/index-admin.php');
            exit;
        } else {
            header('Location: ../client/client-article.php');
            exit;
        }
    } else {
        header('Location: ../client/client-creation-compte.php');
        exit;
    }
}
require_once(__DIR__ . '/../includes/nav.php');
?>

<!DOCTYPE html>
<html LANG="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <title>Se connecter</title>
</head>

<body>
    <main>
        <form class="connexion_creercompte" method="post">
            <fieldset>
                <label for="email">Email</label>
                <input placeholder="Adresse email" type="mail" name="email" id="email" required>
            </fieldset>
            <fieldset>
                <label for="mdp">Mdp</label>
                <input placeholder="mdp" type="password" name="mdp" id="mdp" required>
            </fieldset>
            <fieldset class="fieldsetResterConnecte">
                <input type="checkbox" name="souvenir[]" value="souvenir">
                <label class="resterConnecte">Rester connecté</label>
            </fieldset>
            <fieldset>
                <input type="submit" value="Se connecter">
            </fieldset>
        </form>

        <div class="createCompte">
            <p>Vous n'avez pas de compte ? <a href="../client/client-creation-compte.php" title="Cliquez ici pour vous créer un compte">Inscrivez-vous</a></p>
        </div>
    </main>
    </a>
</body>

</html>