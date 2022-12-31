<?php
session_start();
$GLOBALS["page"] = "adminArticle.php";
echo $_SESSION["suppr"];
require_once('database/databaseFunction.php');


if (isset($_POST['oui'])){
     $_SESSION['oui'] = $_POST['oui'];
     $nom = $_SESSION["suppr"];
     deleteArticle($nom);
    header('Location: adminArticle.php');
    exit;
}
elseif (isset($_POST['non'])){
    $_SESSION['non'] = $_POST['non'];
    header('Location: adminArticle.php');
    exit;
}
require_once('index.php');


?>

<!DOCTYPE html>
<html LANG="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <title>ADMIN</title>
    <style>
        a#retourPageArticle{
        color: #212529;
        text-decoration: underline;
    }

    a#retourPageArticle:hover{
        text-decoration: none;
    }

    input[type="radio"]{
        width: 10%;
        display: inline-block;
        width: 2vw;
        height: 2vh;
        cursor: pointer;
    }

    fieldset p{
        display: inline-block;
        width: 10%;
    }
    fieldset:first-child{
        padding: 0 37%;
    }

    
    </style>
</head>

<body>
  <main>
    <h1>Voulez-vous supprimer l'article ?</h1>
    <form method="post">
        <fieldset>
            <input type="radio" name="oui"><p>Oui</p>
            <input type="radio" name="non"><p>Non</p>
        </fieldset>
        <fieldset>
            <input type="submit" value="Valider">
        </fieldset>
    </form>
    <div class="article">
    <p><a id="retourPageArticle" href="adminArticle.php" title="Cliquez ici pour retourner à la page des articles">←Retourner à la page des articles</a></p>
    </main>
</body>
</html>