<?php

session_start();
$GLOBALS["page"] = "connexion.php";
$compteCree = 0;

require_once(__DIR__ . '/../libs/database-functions.php');

if (!empty($_POST['nom']) and !empty($_POST['prenom'])) {
    if (checkClientExistant($_POST['email'], $_POST['nom'], $_POST['prenom'])) {
        $_SESSION['nom'] = $_POST['nom'];
        $_SESSION['prenom'] = $_POST['prenom'];
        $_SESSION['email'] = $_POST['email'];
        if (isset($_POST['souvenir'])) {
            $timeout = 180;
            ini_set("session.gc_maxlifetime", $timeout);
            ini_set("session.cookie_lifetime", $timeout);
            $s_name = session_name();
            setcookie($s_name, $_COOKIE[$s_name], time() + $timeout, '/');
            session_start();
        }
        session_start();
        if (checkAdmin($_SESSION['nom'])) : {
                header('Location: ../admin/index-admin.php');
                exit;
            }
        else : {
                header('Location: ../index.php');
                exit;
            }
        endif;
    } else {
        header('Location: ../client/client-creation-compte.php');
        exit;
    }
}
require_once(__DIR__.'/../includes/nav.php');
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
                <label for="nom">Nom</label>
                <input placeholder="Nom" type="text" name="nom" id="nom" required>
            </fieldset>

            <fieldset>
                <label for="prenom">Prénom</label>
                <input placeholder="Prénom" type="text" name="prenom" id="prenom" required>
            </fieldset>

            <fieldset>
                <label for="email">Email</label>
                <input placeholder="Adresse email" type="mail" name="email" id="email" required>
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