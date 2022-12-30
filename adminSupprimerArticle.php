<?php
session_start();
$GLOBALS["page"] = "adminArticle.php";
echo $_SESSION["suppr"];
require_once('database/Database.php');
if (isset($_POST['oui'])){
     $_SESSION['oui'] = $_POST['oui'];
     deleteArticle($_SESSION["suppr"]);
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
</head>

<body>
  <main>
    <h1>Voulez-vous supprimer l'article (ceci est irréversible)</h1>
    <form method="post">
        <fieldset>
            <input type="radio" name="oui">Oui
            <input type="radio" name="non">Non
        </fieldset>
        <fieldset>
            <input type="submit" value="Valider">
        </fieldset>
    </form>
    <div class="article">
    </main>
</body>
</html>