<?php
if (!isset($_SESSION)) {
    session_start();
    $_SESSION['nom']='';
    $_SESSION['prenom']='';
    $_SESSION['nb']=0;
  }

require_once('index.html');
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

<p>
    <?php  
        if ((isset ($_POST['nom'])) && isset($_POST['prenom'])){

            $_SESSION['nom'] = $_POST['nom'];
            $_SESSION['prenom'] = $_POST['prenom'];
            $_SESSION['email'] = $_POST['email'];

                if ((isset($_SESSION)) && (($_POST['nom'] != '') || ($_POST['prenom'] != ''))){
                echo "Une session est créée pour <br>".$_SESSION['nom']." ".$_SESSION['prenom'];
                $SID = session_create_id();	
                echo "<br>SID : ".session_id();
                session_commit();
            } 
                else {
                    echo "Le nom est le prenom sont vides <br>";
                    echo "Aucune session n'a été créée.";
            }
        }
            ?>
                <form method="post" action="open_session.php">
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
            <?php
    ?>
</p>

<div class="createCompte">
    <p>Nouveau chez nomSite ?</p>
    <p><a href="open_session.php" title="Cliquez ici pour vous créer un compte">Créez votre compte</a></p>
</div>
    </main>

</body>
</html>