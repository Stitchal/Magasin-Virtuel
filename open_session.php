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
    <title>Ouvrir une session</title>
</head>
<body>

<p>
    <?php  
        if ((isset ($_POST['nom'])) && isset($_POST['prenom'])){

            $_SESSION['nom'] = $_POST['nom'];
            $_SESSION['prenom'] = $_POST['prenom'];

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
                    <p>
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom">
                    </p>

                    <p>
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" id="prenom">
                    </p>

                    <p>
                        <input type="submit" value="Envoyer">
                    </p>
                </form>
            <?php
    ?>
</p>

<p>
    <a href="articles.php?">Retourner au menu principal</a>
</p>

</body>
</html>